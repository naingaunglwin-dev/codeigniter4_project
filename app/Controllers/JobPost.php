<?php

    namespace App\Controllers;

    use App\Models\MyTable;    
    use App\Models\MyModel;
    use App\Models\UserModel;
    use App\Models\PostModel;
    use CodeIgniter\I18n\Time;
    use Config\Services;

    class JobPost extends BaseController {

        protected $helpers = ['url','form'];
        protected $my_table;
        protected $my_model;
        protected $user;
        protected $post;
        protected $validation;
        protected $time;

        public function __construct() {

            $this->my_table     = MyTable::Job_Post;            
            $this->my_model     = new MyModel;
            $this->user         = new UserModel;
            $this->post         = new PostModel;
            $this->validation   = Services::validation();
            $this->time         = new Time();

        }

        public function job_post($id = 0) {

            $data['user_id']        =   $this->session->get('user_id');
            $data['user']           =   $this->user->user_data();
            $data['industry']       =   $this->my_model->find_for_dropdown(MyTable::Industry);
            $data['job_function']   =   $this->my_model->find_for_dropdown(MyTable::Job_Function);
            $data['location']       =   $this->my_model->find_for_dropdown(MyTable::Location);
            $data['current_url']    =   current_url();

            if (empty($this->session->get('user_id'))) {

                $this->session->setFlashdata('login_alert', 'Please Login First To Create Job Post!');
                $data['login_alert'] = $this->session->getFlashdata('login_alert');
                return redirect()->to(base_url())->with('login_alert', $data['login_alert']);

            }

            if (empty($id)) {

                $mode = 'new';
                $data['post'] = (object) array(
                    'img_loc'           =>  '',
                    'title'             =>  '',
                    'location'          =>  '',
                    'industry'          =>  '',
                    'job_function'      =>  '',
                    'responsibilities'  =>  '',
                    'requirement'       =>  '',
                    'other_information' =>  '',
                    'user_id'           =>  '',
                    'update_date'       =>  '',
                    'apply_method'      =>  ''
                );

            } else {

                $mode = 'edit';
                $data['post'] = $this->post->post_data($id);

            }

            if (!empty($this->request->getVar('post_upload_btn'))) {

                $photo              =   $this->request->getFile('post_photo');
                $title              =   $this->request->getVar('title');
                $location           =   $this->request->getVar('location');
                $industry           =   $this->request->getVar('industry');
                $job_function       =   $this->request->getVar('job_function');
                $responsibilities   =   $this->request->getVar('responsibilities');
                $requirement        =   $this->request->getVar('requirement');
                $description        =   $this->request->getVar('description');
                $apply_method       =   $this->request->getVar('apply_method');

                if (!empty($photo)) {
                    $this->validation->setRules ([
                        'post_photo'        =>  ['label' => 'Photo', 'rules' => 'permit_empty|uploaded[post_photo]|max_size[post_photo,10240]'],
                        'title'             =>  ['label' => 'Title', 'rules' => 'required'],
                        'location'          =>  ['label' => 'Location', 'rules' => 'required'],
                        'industry'          =>  ['label' => 'Industry', 'rules' => 'required'],
                        'job_function'      =>  ['label' => 'Job Function', 'rules' => 'required'],
                        'responsibilities'  =>  ['label' => 'Responsibilities', 'rules' => 'required'],
                        'requirement'       =>  ['label' => 'Requirement', 'rules' => 'required'],
                        'description'       =>  ['label' => 'Description', 'rules' => 'required'],
                        'apply_method'      =>  ['label' => 'Apply Method', 'rules' => 'required']
                    ]);
                } else {
                    $this->validation->setRules ([
                        'title'             =>  ['label' => 'Title', 'rules' => 'required'],
                        'location'          =>  ['label' => 'Location', 'rules' => 'required'],
                        'industry'          =>  ['label' => 'Industry', 'rules' => 'required'],
                        'job_function'      =>  ['label' => 'Job Function', 'rules' => 'required'],
                        'responsibilities'  =>  ['label' => 'Responsibilities', 'rules' => 'required'],
                        'requirement'       =>  ['label' => 'Requirement', 'rules' => 'required'],
                        'description'       =>  ['label' => 'Description', 'rules' => 'required'],
                        'apply_method'      =>  ['label' => 'Apply Method', 'rules' => 'required']
                    ]);
                }

                $validation_data = [
                    'post_photo'        =>  $photo,
                    'title'             =>  $title,
                    'location'          =>  $location,
                    'industry'          =>  $industry,
                    'job_function'      =>  $job_function,
                    'responsibilities'  =>  $responsibilities,
                    'requirement'       =>  $requirement,
                    'description'       =>  $description,
                    'apply_method'      =>  $apply_method
                ];

                if ($this->validation->run($validation_data)) {

                    if (!empty($photo) && $photo->isValid() && !$photo->hasMoved()) {

                        $tmp_name = $photo->getRandomName();
                        $photo->move('img/', $tmp_name);

                        $post_data  =   array(
                            'img_loc'           =>  $tmp_name,
                            'title'             =>  $title,
                            'location'          =>  $location,
                            'industry'          =>  $industry,
                            'job_function'      =>  $job_function,
                            'responsibilities'  =>  $responsibilities,
                            'requirement'       =>  $requirement,
                            'other_information' =>  $description,
                            'user_id'           =>  $this->user->user_data()->id,
                            'update_date'       =>  $this->time->now(),
                            'apply_method'      =>  $apply_method
                        );
    
                    } else {

                        $post_data  =   array(
                            'title'             =>  $title,
                            'location'          =>  $location,
                            'industry'          =>  $industry,
                            'job_function'      =>  $job_function,
                            'responsibilities'  =>  $responsibilities,
                            'requirement'       =>  $requirement,
                            'other_information' =>  $description,
                            'user_id'           =>  $this->user->user_data()->id,
                            'update_date'       =>  $this->time->now(),
                            'apply_method'      =>  $apply_method
                        );

                    }

                    $this->my_model->save($id, $this->my_table, $post_data);

                    $this->session->setFlashdata('post_create_success', 'Post created successfully');
                    $this->session->setFlashdata('post_edit_success', 'Post Updated successfully');

                    $data['post_create_success'] = $this->session->getFlashdata('post_create_success');
                    $data['post_edit_success'] = $this->session->getFlashdata('post_edit_success');

                    $msg = $mode == 'new' ? $data['post_create_success'] : $data['post_edit_success'];

                    $this->session->setFlashdata('success', $msg);

                    $this->session->getFlashdata('success');

                    return redirect()->to(base_url('post/list'));

                } else {

                    $this->session->setFlashdata('post_validation_error', $this->validation->getErrors());

                }

            }

            $data['post_validation_error']  = $this->session->getFlashdata('post_validation_error');
            $data['upload_error']           = $this->session->getFlashdata('upload_error');

            return $this->view('job_post', $data, $data);
        }

        public function post_delete($id) {

            if ($this->my_model->delete_data($this->my_table, $id)) {

                $this->session->setFlashdata('success', 'Post deleted successfully');

                $this->session->getFlashdata('success');

                return redirect()->to(base_url('post/list'));

            }
        }

        public function post_list() {

            $data['user_id']        =   $this->session->get('user_id');
            $data['user']           =   $this->user->user_data();
            $data['post']           =   $this->post->all_post_data();

            if (empty($this->session->get('user_id'))) {

                $this->session->setFlashdata('login_alert', 'Please Login First To See Posted Job!');
                $data['login_alert'] = $this->session->getFlashdata('login_alert');
                return redirect()->to(base_url())->with('login_alert', $data['login_alert']);

            }

            return $this->view('job_post_list', $data);

        }

        public function post_search() {

            $title          =   $this->request->getVar('search_job_title') ?: '';
            $industry       =   $this->request->getVar('industry') ?: '';
            $job_function   =   $this->request->getVar('job_function') ?: '';
            $location       =   $this->request->getVar('location') ?: '';

            $search_data = array(
                'title'          =>   $title,
                'industry'       =>   $industry,
                'job_function'   =>   $job_function,
                'location'       =>   $location
            );


            $data = $this->my_model->search($this->my_table, $search_data);

            $result = '';

            foreach ($data as $row){

                $result .= '<tr>
                                <td>'.$row['title'].'</td>
                                <td>'.$row['industry'].'</td>
                                <td>'.$row['update_date'].'</td>
                                <td><a href="#">View Detail</a></td>
                            </tr>';

            }

            echo $result;

        }

    }