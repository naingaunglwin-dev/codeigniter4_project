<?php

    namespace App\Controllers;
    //use App\Models\My_model;
    class JobPostList extends BaseController {

        public function index() {

            return view('header')
                  .view('footer');
            
        }

        public function hello() {

            echo "Hello User";

        }

    }