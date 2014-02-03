<?php

class SiteController extends BaseController {

    public function home() {
        return View::make('site.home');
    }

    public function tos() {
        return View::make('site.tos');
    }

    public function dmca() {
        return View::make('site.dmca');
    }

    public function doViewer($imageid) {
        $imgid = Helper::ImageID($imageid, 'decode');
        $image = DB::table('user_images')->where('imageid', $imgid)->get();
        if (count($image)) {
            return View::make('site.viewer', array('imageid' => $imageid, 'image' => $image));
        } else
            App::abort(404);
    }

    public function doGallery($galerieid) {
        // TODO - Make galaries visible to the public
    }

    public function doThumbnail($filename) {
        $thumb_width = 350;
        $thumb_height = 300;

        /* Set Filenames */
        $image_path = storage_path('images/raw') . '/' . $filename;
        $target_path = storage_path('images/thumbs') . '/' . $filename;

        if (File::exists($image_path)) {
            $new = false;
            if (!File::exists($target_path)) {
                $new = true;
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
                $source_x = 0;
                $source_y = 0;

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

            $moddate = date('D, d M Y H:i:s', filemtime($target_path) - date('Z')) . ' GMT';

            $imginfo = getimagesize($target_path);
            if (strtotime(Request::server('HTTP_IF_MODIFIED_SINCE')) == strtotime($moddate) && !$new)
                $response = Response::make(file_get_contents($target_path), 304);
            else
                $response = Response::make(file_get_contents($target_path), 200);

            $response->header('Content-Type', $imginfo['mime']);
            $response->header('Cache-Control', 'max-age=86400');
            $response->header('Last-Modified', $moddate);

            return $response;
        } else
            App::abort(404);
    }

    public function doImage($filename) {
        $target_path = storage_path('images/raw/') . $filename;

        if (File::exists($target_path)) {
            if (Input::get('dl')) {
                return Response::download($target_path);
            } else {
                $imginfo = getimagesize($target_path);
                $moddate = date('D, d M Y H:i:s', filemtime($target_path) - date('Z')) . ' GMT';
                if (strtotime(Request::server('HTTP_IF_MODIFIED_SINCE')) == strtotime($moddate))
                    $response = Response::make(file_get_contents($target_path), 304);
                else
                    $response = Response::make(file_get_contents($target_path), 200);

                $response->header('Cache-Control', 'max-age=86400');
                $response->header('Last-Modified', $moddate);
                $response->header('Content-Type', $imginfo['mime']);

                $fid = explode('.', $filename);
                
                DB::table('user_images_views')->insert(
                        array('imageid' => Helper::ImageID($fid[0], 'decode'), 
                              'useraddress' => ip2long(Request::server("REMOTE_ADDR")), 
                              'processed' => 0)
                );
                
                return $response;
            }
        } else {
            App::abort(404);
        }
    }

}
