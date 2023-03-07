<?php

    namespace App\Models;

    use CodeIgniter\Model;
    use App\Models\MyTable;

    class JobSearchModel extends Model {

        protected $db;
        protected $search;

        public function __construct() {

            $this->db       = \Config\Database::connect();
            $this->search   = $this->db->table(MyTable::Job_Post);
            $this->pager    = \Config\Services::pager();

        }

        public function search_data($search_data) {

            $this->search->select('job_post.*, industry.name')
                         ->join('industry', 'job_post.industry = industry.id', 'left');

            if ($search_data['search_job_title'] != '') {

                $this->search->like('title', $search_data['search_job_title'], 'both');

            }

            if ($search_data['industry'] != 0) {

                $this->search->where('industry.id', $search_data['industry']);

            }

            if ($search_data['job_function'] != 0) {

                $this->search->where('job_function', $search_data['job_function']);

            }

            if ($search_data['location'] != 0) {

                $this->search->where('location', $search_data['location']);

            }

            $query = $this->search->get();

            return $query->getResultArray();

        }

    }