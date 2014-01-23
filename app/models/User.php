<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Entrust\HasRole;

class User extends ConfideUser {

    use HasRole; // Add this trait to your user model

    protected $table = 'users';
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

    public static function getImages($userid = 0, $limit = 30) {
        if ($userid == 0)
            $userid = Auth::user()->id;

        $users = DB::table('user_images')
                ->where('userid', $userid)
                ->orderBy('imageid', 'desc')
                ->paginate($limit);

        return $users;
    }

    public static function userStats($userid = 0) {
        $userstats = array();
        if ($userid > 0) {
            $userstats = DB::select('SELECT COUNT(`imageid`) as totalimg, SUM(`imagesize`) as totalsize, SUM(`full_views`) as totalimgviews, SUM(`thumb_views`) as totalthmbviews FROM `user_images` WHERE `userid` = ?', array($userid));
        } else {
            $userstats = DB::select('SELECT COUNT(`imageid`) as totalimg, SUM(`imagesize`) as totalsize, SUM(`full_views`) as totalimgviews, SUM(`thumb_views`) as totalthmbviews FROM `user_images`');
        }

        return $userstats;
    }

}
