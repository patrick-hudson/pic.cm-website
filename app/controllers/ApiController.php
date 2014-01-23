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
                $user = User::find(1);
                if (!$user->hasRole('Suspended')) {
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

                            $clientip = ip2long($_SERVER['REMOTE_ADDR']);
                            DB::insert('INSERT INTO `user_upload_addresses`(`address`, `created_at`, `updated_at`) ' .
                                            'VALUES (?, NOW(), NOW()) ' .
                                            'ON DUPLICATE KEY UPDATE updated_at=NOW();', array($clientip));
                            
                            $addressid = DB::table('user_upload_addresses')
                                    ->select('addressid')
                                    ->where('address', $clientip)
                                    ->first();
                            
                            $id = DB::table('user_images')->insertGetId(
                                    array(
                                        'imagesize' => $return['image']['size'],
                                        'userid' => $userid,
                                        'addressid' => $addressid->addressid,
                                        'mimetype' => $return['image']['type'],
                                        'uploaddate' => date("Y-m-d H:i:s")
                                    )
                            );

                            $return['image']['name'] = Helper::ImageID($id);

                            //unlink($tmpfname);
                            File::move($tmpfname, storage_path('images/raw') . '/' . $return['image']['name'] . '.' . $return['image']['type']);
                        } else {
                            $return['code'] = 400;
                            $return['message'] = "Missing data from request";
                        }
                    }                    
                } else {
                    $return['code'] = 403;
                    $return['message'] = "Account suspended";
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

        return Redirect::to(Confide::checkAction('UserController@accountSettings'));
    }

    public static function doAjaxRequest() {
        $return = array();
        if (Input::get('action')) {
            if (Input::get('action') == 'deleteupload' && Input::get('fileid') != null) {
                foreach (Input::get('fileid') as $file) {
                    array_push($return, Api::doDeleteFile($file));
                }
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
