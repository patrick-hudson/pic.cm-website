<?php

/*
 * Api controller
 * all $return codes must be RFC2616 compliant
 */

class ApiController extends Controller {

    public static function doUploadApi() {
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

}
