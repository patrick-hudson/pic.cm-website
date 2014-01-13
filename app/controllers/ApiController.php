<?php

/*
 * Api controller
 * all $return codes must be RFC2616 compliant
 */

class ApiController extends Controller {

    public static function doApiRequest() {
        $return = array();
        if (Input::get('key') && Input::get('action')) {
            if ($userid = Api::checkApiKey(Input::get('key'))) {
                if (Input::get('action') == 'upload') {
                    if (Input::get('data')) {
                        $tmpfname = tempnam(sys_get_temp_dir(), 'piccm_'); // good

                        $fsock = fopen($tmpfname, "rw+");
                        fwrite($fsock, base64_decode(Input::get('data')));
                        fclose($fsock);

                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mimetype = finfo_file($finfo, $tmpfname);
                        finfo_close($finfo);


                        $return['image']['size'] = filesize($tmpfname);
                        $return['image']['type'] = Helper::mimeToExt($mimetype);
                        $return['code'] = 200;

                        $id = DB::table('user_images')->insertGetId(
                                array(
                                    'imagesize' => $return['image']['size'],
                                    'userid' => $userid,
                                    'mimetype' => $return['image']['type'],
                                    'uploaddate' => date("Y-m-d H:i:s")
                                )
                        );

                        $return['image']['name'] = Helper::ImageID($id);

                        //unlink($tmpfname);
                        File::move($tmpfname, public_path() . '/i/' . $return['image']['name'] . '.' . $return['image']['type']);
                    } else {
                        $return['code'] = 400;
                        $return['message'] = "Missing data from request";
                    }
                }
            } else {
                $return['code'] = 401;
                $return['message'] = "Api key does not exist";
            }
        } else {
            $return['code'] = 400;
            $return['message'] = "Missing data from request";
        }
        $headers['Content-Type'] = 'application/xml';
        if (Input::get('responsecode') === true)
            return Response::make(Helper::arrayToXml($return), $return['code'], $headers);
        else
            return Response::make(Helper::arrayToXml($return), 200, $headers);
    }

    public static function doKeyGeneration() {
        $apikey = str_random(32);

        DB::statement('INSERT INTO `user_keys` (`userid`, `apikey`) VALUES (' . Auth::user()->id . ',\'' . $apikey . '\') ON DUPLICATE KEY UPDATE `apikey` = \'' . $apikey . '\'');

        return Redirect::to('/m/account');
    }

    public static function doImageResize($filename) {

        $thumb_width = 380;
        $thumb_height = 380;

        /* Set Filenames */
        $image_path = public_path() . '/i/' . $filename;
        $target_path = public_path() . '/i/t/' . $filename;

        if (!File::exists($target_path)) {
            if (!(is_integer($thumb_width) && $thumb_width > 0) && !($thumb_width === "*")) {
                echo "The width is invalid";
                exit(1);
            }

            if (!(is_integer($thumb_height) && $thumb_height > 0) && !($thumb_height === "*")) {
                echo "The height is invalid";
                exit(1);
            }

            $extension = pathinfo($image_path, PATHINFO_EXTENSION);
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $source_image = imagecreatefromjpeg($image_path);
                    break;
                case "gif":
                    $source_image = imagecreatefromgif($image_path);
                    break;
                case "png":
                    $source_image = imagecreatefrompng($image_path);
                    break;
                default:
                    exit(1);
                    break;
            }

            $source_width = imageSX($source_image);
            $source_height = imageSY($source_image);

            if (($source_width / $source_height) == ($thumb_width / $thumb_height)) {
                $source_x = 0;
                $source_y = 0;
            }

            if (($source_width / $source_height) > ($thumb_width / $thumb_height)) {
                $source_y = 0;
                $temp_width = $source_height * $thumb_width / $thumb_height;
                $source_x = ($source_width - $temp_width) / 2;
                $source_width = $temp_width;
            }

            if (($source_width / $source_height) < ($thumb_width / $thumb_height)) {
                $source_x = 0;
                $temp_height = $source_width * $thumb_height / $thumb_width;
                $source_y = ($source_height - $temp_height) / 2;
                $source_height = $temp_height;
            }

            $target_image = ImageCreateTrueColor($thumb_width, $thumb_height);

            imagecopyresampled($target_image, $source_image, 0, 0, $source_x, $source_y, $thumb_width, $thumb_height, $source_width, $source_height);

            switch ($extension) {
                case "jpg":
                case "jpeg":
                    imagejpeg($target_image, $target_path);
                    break;
                case "gif":
                    imagegif($target_image, $target_path);
                    break;
                case "png":
                    imagepng($target_image, $target_path);
                    break;
                default:
                    exit(1);
                    break;
            }

            imagedestroy($target_image);
            imagedestroy($source_image);
        }
        header('content-type: image/png;');
        echo file_get_contents($target_path);
    }

    public static function doAjaxRequest() {
        if (Input::get('action')) {
            if (Input::get('action') == 'deleteupload' && Input::get('fileid') != null) {
                $return = Api::doDeleteFile(Input::get('fileid'));
            } else {
                $return['code'] = 400;
                $return['message'] = "Missing file id from request";
            }
        } else {
            $return['code'] = 400;
            $return['message'] = "Missing data from request";
        }

        if (Input::get('format')) {
            switch (Input::get('format')) {
                case 'json':
                    $return = json_encode($return);
                    $headers['Content-Type'] = 'application/json';
                    break;
                case 'xml':
                    $return = Helper::arrayToXml($return);
                    $headers['Content-Type'] = 'application/xml';
                    break;
                case 'serialize':
                    $return = serialize($return);
                    $headers['Content-Type'] = 'application/json';
                    break;
                default:
                    $return = json_encode($return);
                    $headers['Content-Type'] = 'application/json';
                    break;
            }
        } else {
            $return = json_encode($return);
            $headers['Content-Type'] = 'application/json';
        }

        return Response::make($return, 200, $headers);
    }

}
