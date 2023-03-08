<?php

    namespace App\Models;

    use App\Models\MyTable;
    use App\Models\MyModel;

    class PostModel {

        protected $my_table;
        protected $my_model;
        protected $session;

        public function __construct() {

            $this->my_table = MyTable::Job_Post;
            $this->my_model = new MyModel;
            $this->session  = \Config\Services::session();

        }

        public function all_post_data() {

            $session_id = $this->session->get('user_id');

            $post = $this->my_model->select_data_array($this->my_table, array('user_id' => $session_id));

            return $post;

        }

        public function post_data($id) {

            $post = $this->my_model->select_data_object($this->my_table, array('id' => $id));

            return $post;

        }

    }