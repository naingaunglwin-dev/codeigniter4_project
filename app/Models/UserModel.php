<?php
    
    namespace App\Models;

    use App\Models\MyTable;
    use App\Models\MyModel;

    class UserModel {

        protected $my_table;
        protected $session;
        protected $my_model;

        public function __construct() {

            $this->my_table =   MyTable::User;
            $this->session  =   \Config\Services::session();
            $this->my_model =   new MyModel;

        }

        public function user_data() {

            $session_id = $this->session->get('user_id');

            $user = $this->my_model->select_data_object($this->my_table, array('id' => $session_id));

            return $user;

        }

    }