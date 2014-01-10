<?php

class SiteController extends BaseController {
    public function home() {
        return View::make('site.home');
    }
    public function tos() {
        return View::make('site.tos');
    }
    public function dmca() {
        return View::make('site.dmca');
    }

}
