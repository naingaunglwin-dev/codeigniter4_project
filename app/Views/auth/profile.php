<section class="profile container">
    <div class="profile-inner col-md-5 col-md-offset-5">

        <?php if (session()->has('update_success')): ?>
            <div class="alert alert-success text-center">
                <?php echo session('update_success'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('profile_validation_error')): ?>
            <div class="alert alert-danger text-center">
                <?php echo session('profile_validation_error'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('update_password_success')): ?>
            <div class="alert alert-success text-center">
                <?php echo session('update_password_success'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('password_error')): ?>
            <div class="alert alert-danger text-center">
                <?php echo session('password_error'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('password_validation_error')): ?>
            <div class="alert alert-danger text-center">
                <?php foreach (session('password_validation_error') as $errors) {
                    echo $errors;
                } ?>
            </div>
        <?php endif; ?>

        <h1>User Profile</h1>
        <div class="profile-data border rounded p-2">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item" id="profile-tab">
                    <a class="nav-link active">Profile</a>
                </li>
                <li class="nav-item" id="password-tab">
                    <a class="nav-link">Change Password</a>
                </li>
            </ul>

            <div class="profile-data-detail">

                <!-- Profile Data Form -->
                <form action="<?php echo base_url('profile/profile_update') ?>" class="profile-form" method="post">
                    <div class="form-group">
                        <?php
                            echo form_label('First Name', 'firstname', array('class' => 'fw-semibold'));
                            echo form_input([
                                'type'  =>  'text',
                                'name'  =>  'first_name',
                                'class' =>  'form-control',
                                'value' =>  set_value('first_name', $user->first_name)
                            ]);
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo form_label('Last Name', 'lastname', array('class' => 'fw-semibold'));
                            echo form_input([
                                'type'  =>  'text',
                                'name'  =>  'last_name',
                                'class' =>  'form-control',
                                'value' =>  set_value('last_name', $user->last_name)
                            ]);
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo form_label('Email', 'email', array('class' => 'fw-semibold'));
                            echo form_input([
                                'type'  =>  'email',
                                'name'  =>  'email',
                                'class' =>  'form-control',
                                'value' =>  set_value('email', $user->email)
                            ]);
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo form_label('Description', 'description', array('class' => 'fw-semibold'));
                            echo form_textarea([
                                'name'  =>  'description',
                                'class' =>  'form-control',
                                'value' =>  set_value('description', $user->description)
                            ]);
                        ?>
                    </div>
                    <div>
                        <?php echo form_submit('profile_update_btn', 'Update', array('class' => 'btn btn-primary')); ?>
                        <?php echo form_reset('', 'Reset', array('class' => 'btn btn-danger')); ?>
                    </div>
                </form>
                
                <!-- Password Form -->
                <form action="<?php echo base_url('profile/password_update'); ?>" method="post" class="password-form" style="display: none;">
                    <div class="form-group">
                        <?php
                            echo form_label('Current Password', 'currentpassword', array('class' => 'fw-semibold'));
                            echo form_input([
                                'type'  =>  'password',
                                'name'  =>  'current_password',
                                'class' =>  'form-control',
                                'value' =>  set_value('current_password')
                            ]);
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo form_label('New Password', 'newpassword', array('class' => 'fw-semibold'));
                            echo form_input([
                                'type'  =>  'password',
                                'name'  =>  'new_password',
                                'class' =>  'form-control',
                                'value' =>  set_value('new_password')
                            ]);
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo form_label('Confirm Password', 'confirmpassword', array('class' => 'fw-semibold'));
                            echo form_input([
                                'type'  =>  'password',
                                'name'  =>  'cpassword',
                                'class' =>  'form-control',
                                'value' =>  set_value('cpassword')
                            ]);
                        ?>
                    </div>
                    <div>
                        <?php echo form_submit('password_update_btn', 'Update', array('class' => 'btn btn-primary')); ?>
                        <?php echo form_reset('', 'Reset', array('class' => 'btn btn-danger')); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){

        $('#profile-tab').click(function(){
            $('#profile-tab').children('a').addClass('active');
            $('#password-tab').children('a').removeClass('active');
            $('.profile-form').slideDown();
            $('.password-form').hide();
        })
        $('#password-tab').click(function(){
            $('#profile-tab').children('a').removeClass('active');
            $('#password-tab').children('a').addClass('active');
            $('.profile-form').hide();
            $('.password-form').slideDown();
        })

        if (location.href == "<?php echo base_url('profile/password_update'); ?>") {
            $('#profile-tab').children('a').removeClass('active');
            $('#password-tab').children('a').addClass('active');
            $('.profile-form').hide();
            $('.password-form').show();
        }

    });
</script>
