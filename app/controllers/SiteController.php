<?php

class SiteController extends BaseController {

    protected $layout = 'layouts.site';

    public function home() {
        $this->layout->content = View::make('site.home');
    }

}
