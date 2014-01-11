<?php

class ManagerController extends BaseController {
    public function doDashboard() {
        return View::make('manager.dashboard');
    }
    
    public function accountSettings(){
        return View::make('manager.account');
    }
}
