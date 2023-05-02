<?php

    namespace App\Models;

    use App\Models\MyTable;
    use App\Models\MyModel;

    class PostModel {

        protected $my_table;
        protected $my_model;
        protected $session;

        public function __construct() {
            $this->my_model = new MyModel;
            $this->session  = \Config\Services::session();

        }

        public function all_post_data() {

            $session_id = $this->session->get('user_id');

            return $this->my_model->select_data_array(MyTable::Job_Post, array('user_id' => $session_id));

        }

        public function post_data($id) {

            return $this->my_model->select_data_object(MyTable::Job_Post, array('id' => $id));

        }

    }