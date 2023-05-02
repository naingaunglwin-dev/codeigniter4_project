<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class JobPostDetailModel extends Model{

        protected $db;
        protected $post_detail;

        public function __construct() {

            $this->db           = \Config\Database::connect();
            $this->post_detail  = $this->db->table(MyTable::Job_Post); 

        }

        public function post_detail($id) {

            $this->post_detail->select('job_post.*, location.name As location_name, industry.name As industry_name, users.description As user_desc')
                              ->join('location', 'job_post.location = location.id', 'left')
                              ->join('industry', 'job_post.industry = industry.id', 'left')
                              ->join('users', 'job_post.user_id = users.id', 'left')
                              ->where('job_post.id', $id);
            
            return $this->post_detail->get()->getRow();

        }

    }