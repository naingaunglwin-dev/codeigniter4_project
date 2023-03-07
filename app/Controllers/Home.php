<?php

    namespace App\Controllers;

    use App\Models\MyModel;
    use App\Models\MyTable;
    use App\Models\UserModel;
    use App\Models\JobSearchModel;
    use App\Models\JobPostDetailModel;

    class Home extends BaseController
    {

        protected $helpers = ['url', 'form'];
        public $my_model;
        public $session;
        public $user;
        public $job_search;
        public $job_detail;
        public $db;

        public function __construct() {

            $this->my_model     = new MyModel;
            $this->user         = new UserModel;
            $this->session      = \Config\Services::session();
            $this->job_search   = new JobSearchModel;
            $this->job_detail   = new JobPostDetailModel;
            $this->db           = \Config\Database::connect();
        }

        public function index()
        {
            $data['user_id']        =   $this->session->get('user_id');
            $data['user']           =   $this->user->user_data();
            $data['industry']       =   $this->my_model->select_all(MyTable::Industry);
            $data['job_function']   =   $this->my_model->select_all(MyTable::Job_Function);
            $data['location']       =   $this->my_model->select_all(MyTable::Location);

            return view('header', $data)
                  .view('home', $data)
                  .view('footer');

        }

        public function search() {

            $search_data['search_job_title']    =   $this->request->getVar('search_job_title');
            $search_data['industry']            =   $this->request->getVar('industry');
            $search_data['job_function']        =   $this->request->getVar('job_function');
            $search_data['location']            =   $this->request->getVar('location');

            $data = $this->job_search->search_data($search_data);

            if (!empty($data)) {
                $result_data = '';

                foreach ($data as $row) {
                    $result_data .= '<tr>';
                    $result_data .= '<td class="w-50">'. $row['title'] . '</td>';
                    $result_data .= '<td>'. $row['name'] . '</td>';
                    $result_data .= '<td>'. $row['update_date'] . '</td>';
                    $result_data .= '<td><a href="' . base_url('post/detail'). '/' .$row['id'] .'">View Detail</a></td>';
                    $result_data .= '</tr>';
                }

                $result = array('status' => 'success', 'data' => $result_data);

            } else {

                $result = array('status' => 'error');

            }


            echo json_encode($result);
        }

        public function post_detail($id = 0) {

            $data['user_id']        =   $this->session->get('user_id');
            $data['user']           =   $this->user->user_data();
            $data['detail']         =   $this->job_detail->post_detail($id);

            return view('header', $data)
                  .view('job_post_detail', $data)
                  .view('footer');

        }

    }
