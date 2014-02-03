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

    /**
     * Returns an array of image data based on input paramaters
     * 
     * @param int    $userid    The id of the user to get images from
     * @param int    $limit     The number of images per page
     * @param string $order     The order of images to be retreived in (DESCending, ASCending)
     * @param string $sort      The row to be sorted by (imageid, filesize, full_views, thumb_views)
     *
     * @return array            The mysql result array
     */
    public static function getImages($userid = 0, $limit = 30, $order = 'desc', $sort = 'imageid') {

        if ($userid == 0) {
            $images = DB::table('user_images')
                    ->orderBy($sort, $order)
                    ->where('userid', Auth::user()->id)
                    ->paginate($limit);
        } elseif ($userid > 0) {
            $images = DB::table('user_images')
                    ->orderBy($sort, $order)
                    ->where('userid', $userid)
                    ->paginate($limit);
        } else {
            $images = DB::table('user_images')
                    ->orderBy($sort, $order)
                    ->paginate($limit);
        }


        return $images;
    }

    public static function userStats($userid = 0) {
        $userstats = array();
        if ($userid > 0) {
            $userstats = DB::select('SELECT COUNT(`imageid`) as totalimg, SUM(`imagesize`) as totalsize, SUM(`full_views`) as totalimgviews FROM `user_images` WHERE `userid` = ?', array($userid));
        } else {
            $userstats = DB::select('SELECT COUNT(`imageid`) as totalimg, SUM(`imagesize`) as totalsize, SUM(`full_views`) as totalimgviews FROM `user_images`');
        }

        return $userstats;
    }

}
