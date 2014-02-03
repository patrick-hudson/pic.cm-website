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
                $user = User::find($userid);
                if (!$user->hasRole('Suspended')) {
                    if (Input::get('action') == 'upload') {
                        if (Input::get('data')) {

                            $tmpfname = tempnam(sys_get_temp_dir(), 'piccm_'); // good

                            $fsock = fopen($tmpfname, "rw+");
                            fwrite($fsock, base64_decode(Input::get('data')));
                            fclose($fsock);
                            $return = Helper::saveFile($tmpfname, $userid);
                        } else {
                            $return['code'] = 400;
                            $return['message'] = "Missing data from request";
                        }
                    }

                    if (Input::get('action') == 'myaccount') {
                        Auth::loginUsingId($userid);
                        return Redirect::to('user');
                    }

                    if (Input::get('action') == 'accountstats') {
                        $stats = DB::table('users')
                                ->select('users.username', DB::raw('COUNT(user_images.imageid) as totalimages'), DB::raw('SUM(user_images.imagesize) as spaceused'))
                                ->join('user_images', function($join) {
                                    $join->on('users.id', '=', 'user_images.userid')
                                    ->where('users.id', '=', Api::checkApiKey(Input::get('key')));
                                })
                                ->get();
                        $return['code'] = 200;
                        foreach($stats[0] as $key => $value){
                            $return['data'][$key] = $value;
                        }
                        $return['data']['spacetotal'] = 200 * 1024 * 1024;
                    }
                    
                    if(Input::get('action') == 'remoteupload'){
                        $return['code'] = 501;
                        $return['message'] = "This feature is currently unavailable";
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

        if (Auth::check()) {
            if (Input::get('action')) {
                if (Input::get('action') == 'deleteupload') {
                    if (Input::get('fileid') != null) {
                        foreach (Input::get('fileid') as $file) {
                            array_push($return, Api::doDeleteFile($file));
                        }
                    } else {
                        $return['code'] = 400;
                        $return['message'] = "Missing file id from request";
                    }
                }

                if (Input::get('action') == 'webupload') {
                    if (Input::hasFile('file') != null) {
                        $microtime = microtime(true);
                        Input::file('file')->move(sys_get_temp_dir(), 'piccm_' . $microtime . '.tmp');
                        $return = Helper::saveFile(sys_get_temp_dir() . '/piccm_' . $microtime . '.tmp', Auth::user()->id);
                        if (!Input::get('aj')) {
                            return Redirect::to('v/' . $return['image']['name']);
                        }
                    } else {
                        $return['code'] = 400;
                        $return['message'] = "Missing data from request";
                    }
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
        } else {
            $return['code'] = 403;
            $return['message'] = "Auth required";
        }

        $httpcode = 200;

        return Response::make($return, $httpcode, $headers);
    }

}
