<?php
    
    namespace App\Models;

    use App\Models\MyTable;
    use App\Models\MyModel;

    class UserModel {

        protected $my_table;
        protected $session;
        protected $my_model;

        public function __construct() {
            $this->session  =   \Config\Services::session();
            $this->my_model =   new MyModel;
        }

        public function user_data() {

            $session_id = $this->session->get('user_id');

            return $this->my_model->select_data_object(MyTable::User, array('id' => $session_id));

        }

    }