<?php

    namespace App\Controllers;

    use App\Models\MyModel;
    use App\Models\MyTable;
    use App\Models\UserModel;

    class Auth extends BaseController {

        protected $helpers = ['form','url'];
        protected $session;
        protected $my_model;
        protected $my_table;
        protected $user;

        public function __construct() {
            
            $this->session  = \Config\Services::session();
            $this->my_model = new MyModel;
            $this->my_table = MyTable::User;
            $this->user     = new UserModel;

        }

        public function index() {

            return view('header')
                  .view('auth/login')
                  .view('footer');

        }

        public function register() {

            if ($this->request->getVar('register_btn')) {

                $insert_data = [
                    'first_name'     =>   $this->request->getVar('first_name'),
                    'last_name'      =>   $this->request->getVar('last_name'),
                    'email'          =>   $this->request->getVar('email'),
                    'password'       =>   $this->request->getVar('password'),
                    'description'    =>   $this->request->getVar('description')
                ];

                $query = $this->my_model->count($this->my_table, array('email' => $insert_data['email']));

                if ($query > 0) {

                    $this->session->setFlashdata('email_error', 'Email that you have entered is already exist');

                } else {

                    $validation_data = [
                        'First Name'        =>  $this->request->getVar('first_name'),
                        'Last Name'         =>  $this->request->getVar('last_name'),
                        'Email'             =>  $this->request->getVar('email'),
                        'Password'          =>  $this->request->getVar('password'),
                        'Confirm Password'  =>  $this->request->getVar('cpassword'),
                        'Description'       =>  $this->request->getVar('description')
                    ];

                    $rules = [
                        'First Name'        =>  'required',
                        'Last Name'         =>  'required',
                        'Email'             =>  'required|valid_email',
                        'Password'          =>  'required',
                        'Confirm Password'  =>  'required|matches[Password]',
                        'Description'       =>  'required'
                    ];

                    if ($this->validateData($validation_data,$rules)) {
                           
                        $this->my_model->insert_data($this->my_table, $insert_data);
                        $this->session->setFlashdata('success','Account Created Successfully! You can login now');
                        $data['success'] = $this->session->getFlashdata('success');

                        return redirect()->to('login');

                    } else {

                        $this->session->setFlashdata('validation_error', $this->validator->getErrors());

                    }
                }

            }

            $data['email_error']        = $this->session->getFlashdata('email_error');
            $data['validation_error']   = $this->session->getFlashdata('validation_error');

            return view('header')
                  .view('auth/register', $data)
                  .view('footer');

        }

        public function login() {

            if ($this->request->getVar('login_btn')) {

                $login_data = [
                    'email'     =>  $this->request->getVar('email'),
                    'password'  =>  $this->request->getVar('password')
                ];

                $query = $this->my_model->count($this->my_table, array('email' => $login_data['email']));

                $user_detail = $this->my_model->select_where($this->my_table, array('email' => $login_data['email']));

                if ($query > 0) {

                    $login = [
                        'Email'     =>  $this->request->getVar('email'),
                        'Password'  =>  $this->request->getVar('password')
                    ];

                    $rules = [
                        'Email'     =>  'required|valid_email',
                        'Password'  =>  'required'
                    ];

                    if ($this->validateData($login, $rules)) {

                        if ($login_data['password'] != $user_detail->password) {

                            $this->session->setFlashdata('login_password_error', 'Password wrong! Please Check Again!');

                        } else {

                            $user_id = $user_detail->id;
                            $this->session->set('user_id', $user_id);
                            $update_type = [
                                'Type'  =>  '1'
                            ];

                            $this->my_model->update_data($this->my_table, $update_type, $user_detail->id);

                            return redirect()->to(base_url());

                        }

                    } else {

                        $this->session->setFlashdata('login_validation_error', $this->validator->getErrors());

                    }

                } else {

                    $this->session->setFlashdata('login_email_error', 'Account with this Email not found!');

                }

            }

            $data['login_validation_error'] =   $this->session->getFlashdata('login_validation_error');
            $data['login_password_error']   =   $this->session->getFlashdata('login_password_error');
            $data['login_email_error']      =   $this->session->getFlashdata('login_email_error');

            return view('header')
                  .view('auth/login', $data)
                  .view('footer');

        }

        public function logout() {

            if ($this->request->getVar('logout_btn')) {

                $user_id = $this->session->get('user_id');

                $update_type = [
                    'Type'  =>  '0'
                ];

                $this->my_model->update_data($this->my_table, $update_type, $user_id);

                $this->session->remove('user_id');

                return redirect()->to(base_url());

            }

        }

        public function update_profile() {

            $data['user_id'] =   $this->session->get('user_id');
            $data['user']    =   $this->user->user_data();

            if ($this->request->getVar('profile_update_btn')) {

                $validation_data = [
                    'First Name'    =>  $this->request->getVar('first_name'),
                    'Last Name'     =>  $this->request->getVar('last_name'),
                    'Email'         =>  $this->request->getVar('email'),
                    'Description'   =>  $this->request->getVar('description'),
                ];

                $rules = [
                    'First Name'    => 'required',
                    'Last Name'     => 'required',
                    'Email'         => 'required|valid_email',
                    'Description'   => 'required'
                ];

                if ($this->validateData($validation_data, $rules)) {

                    $this->session->setFlashdata('update_success', 'Profile Updated Successfully');

                    $update_data = array(
                        'first_name'    => $this->request->getVar('first_name'),
                        'last_name'     => $this->request->getVar('last_name'),
                        'email'         =>$this->request->getVar('email'),
                        'description'   =>$this->request->getVar('description')
                    );

                    $this->my_model->update_data($this->my_table, $update_data, $data['user_id']);

                } else {

                    $this->session->setFlashdata('profile_validation_error', $this->validator->getErrors());

                }

            }

            $data['update_success']     =   $this->session->getFlashdata('update_success');
            $data['validation_error']   =   $this->session->getFlashdata('profile_validation_error');

            return view('header', $data)
                  .view('auth/profile', $data)
                  .view('footer');

        }

        public function update_password() {

            $data['user_id'] =   $this->session->get('user_id');
            $data['user']    =   $this->user->user_data();

            if ($this->request->getVar('password_update_btn')) {

                $validation_data = [
                    'Current Password'  =>  $this->request->getVar('current_password'),
                    'New Password'      =>  $this->request->getVar('new_password'),
                    'Confirm Password'  =>  $this->request->getVar('cpassword')
                ];

                $rules = [
                    'Current Password'  =>  'required',
                    'New Password'      =>  'required',
                    'Confirm Password'  =>  'required|matches[New Password]'
                ];

                if ($this->validateData($validation_data, $rules)) {

                    if ($this->request->getVar('current_password') == $this->user->user_data()->password) {

                        $update_data = array(
                            'password'  =>  $this->request->getVar('new_password')
                        );

                        $this->my_model->update_data($this->my_table, $update_data, $this->user->user_data()->id);

                        $this->session->setFlashdata('update_password_success', 'Password Updated Successfully');

                    } else {

                        $this->session->setFlashdata("password_error", "Current Password didn't match!");

                    }

                } else {

                    $this->session->setFlashdata('password_validation_error', $this->validator->getErrors());

                }

            }

            $data['update_password_success']    = $this->session->getFlashdata('update_password_success');
            $data['password_error']             = $this->session->getFlashdata('password_error');
            $data['validation_error']           = $this->session->getFlashdata('password_validation_error');

            return view('header', $data)
                  .view('auth/profile', $data)
                  .view('footer');

        }

    }
