<?php

class AdminController extends Controller {

    public function doDashboard() {

        $images = DB::table('user_images')
                        ->join('users', 'users.id', '=', 'user_images.userid')
                        ->join('user_upload_addresses', 'user_upload_addresses.addressid', '=', 'user_images.addressid')
                        ->select('user_images.imageid', 'user_images.mimetype', 'user_images.imagesize', 'users.username', 'user_upload_addresses.address')
                        ->orderBy('user_images.imageid', 'desc')
                        ->skip(0)->take(5)->get();

        return View::make('admin.dashboard')
                        ->with(
                                array(
                                    'images' => $images,
                                )
        );
    }

    public function doUsers() {
        $users = DB::table('users')->paginate(50);
        return View::make('admin.users')->with(array('users' => $users));
    }

    public function doUserDash() {
        return View::make('admin.user');
    }

    public function editUser() {
        $user = User::find(Input::get('userid'));
        $global_roles = DB::table('roles')->get();

        $roles = array();
        
        foreach($global_roles as $grole){
            $roles[$grole->id]['id'] = $grole->id;
            $roles[$grole->id]['name'] = $grole->name;
            $roles[$grole->id]['assigned'] = ($user->hasRole($grole->name) ? true : false);
        }

        return View::make('admin.edit_user')->with(
                        array(
                            'user' => $user,
                            'roles' => $roles
        ));
    }

}
