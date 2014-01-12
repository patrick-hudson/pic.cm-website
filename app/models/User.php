<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    protected $table = 'user';
    protected $hidden = array('password');
    
    public function getAuthIdentifier() {
        return $this->getKey();
    }
    
    public function getAuthPassword() {
        return $this->password;
    }
    
    public function getReminderEmail() {
        return $this->email;
    }
    
    public function getGroup() {
        return $this->group;
    }
    
    public static function getImages($startpos = 0, $limit = 100){
        
        return $users = DB::table('user_images')->where('userid', Auth::user()->id)->skip($startpos)->take($limit)->get();
    }
}