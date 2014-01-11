<?php

/*
 * Api controller
 * all $return codes must be RFC2616 compliant
 */

class ApiController extends Controller {

    public static function doUploadApi() {
        $return = array();
        if (Input::get('key') && Input::get('action')) {
            if (Api::checkApiKey(Input::get('key')) || Config::get('app.debug')) {
                if (Input::get('action') == 'upload') {
                    if (Input::get('data')) {
                        $tmpfname = tempnam(sys_get_temp_dir(), 'piccm_'); // good 
                        $return['code'] = 200;
                        $return['message'] = "$tmpfname";
                        $fsock = fopen($tmpfname, "rw+");
                        fwrite($fsock, base64_decode(Input::get('data')));
                        fclose($fsock);

                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mimetype = finfo_file($finfo, $tmpfname);
                        finfo_close($finfo);
                        
                        $return['code'] = 200;
                        $return['image']['name'] = Helper::alphaID(rand(0, 10000), false, 0, Input::get('key'));
                        $return['image']['type'] = Helper::mimeToExt($mimetype); 

                        unlink($tmpfname);
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
        return Response::make(Helper::arrayToXml($return), $return['code'], $headers);
    }

}
