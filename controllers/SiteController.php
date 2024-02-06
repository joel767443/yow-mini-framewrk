<?php

namespace app\controllers;


use app\core\Request;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function store(Request $request): string
    {
        return $this->view('contact');
    }

    /**
     * @return string
     */
    public function contact(): string
    {
       return $this->view('contact');
    }

}