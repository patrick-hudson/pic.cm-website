<?php

class Api {

    public static function checkApiKey($key) {
        $results = DB::select('SELECT `userid` FROM `user_keys` WHERE `apikey` = ?', array($key));
        
        if($results){
            return $results[0]->userid;
        }
    }

    public static function getUserApiKey() {
        $results = DB::select('SELECT `apikey` FROM `user_keys` WHERE `userid` = ?', array(Auth::User()->id));
        
        if($results){
            return $results[0]->apikey;
        }
    }

}
