<?php

    namespace App\Traits;

    trait BaseControllerTrait
    {

        public function view($view, $headerData = null, $viewData = null)
        {

            if (!empty($headerData) && !empty($viewData)) {
                return view('header', $headerData)
                    .view($view, $viewData)
                    .view('footer');
            } elseif (!empty($headerData) && empty($viewData)) {
                return view('header', $headerData)
                    .view($view)
                    .view('footer');
            } elseif (empty($headerData) && !empty($viewData)) {
                return view('header')
                    .view($view, $viewData)
                    .view('footer');
            } else {
                return view('header')
                    .view($view)
                    .view('footer');
            }

        }
    }
