<?php

class Api {

    public static function checkApiKey($key) {
        $results = DB::select('SELECT `userid` FROM `user_keys` WHERE `apikey` = ?', array($key));

        if ($results) {
            return $results[0]->userid;
        }
    }

    public static function getUserApiKey() {
        $results = DB::select('SELECT `apikey` FROM `user_keys` WHERE `userid` = ?', array(Auth::User()->id));

        if ($results) {
            return $results[0]->apikey;
        }
    }

    public static function doDeleteFile($imageid) {
        $return = array(
            'filename' => $imageid,
            'code' => 404,
            'message' => 'File does not exist'
        );

        if (Auth::guest()) {
            $return = array(
                'code' => 401,
                'message' => 'You must be logged in to perform this action'
            );
        } else {
            $dbid = Helper::ImageID($imageid, 'decode');
            $userfiles = DB::table('user_images')
                    ->select(DB::raw('mimetype'))
                    ->where('imageid', $dbid)
                    ->where('userid', Auth::user()->id)
                    ->get();

            if ($userfiles) {
                $delete_files = array();

                if (File::exists(storage_path('images/raw/') . $imageid . '.' . $userfiles[0]->mimetype))
                    array_push($delete_files, storage_path('images/raw/') . $imageid . '.' . $userfiles[0]->mimetype);

                if (File::exists(storage_path('images/thumbs/') . $imageid . '.' . $userfiles[0]->mimetype))
                    array_push($delete_files, storage_path('images/thumbs/') . $imageid . '.' . $userfiles[0]->mimetype);

                File::delete($delete_files);
                DB::table('user_images')->where('imageid', $dbid)->delete();


                $return = array(
                    'filename' => $imageid,
                    'code' => 200,
                    'message' => 'The requested file has been sent to the NSA for processing'
                );
            }
        }
        return $return;
    }

}
