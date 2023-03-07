<section class="auth-form container">
    <div class="login col-md-4 col-md-offset-4">
        <form action="" method="post">
            <div class="message">
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success text-center"><?php echo session('success'); ?></div>
                <?php endif; ?>
                <?php if (session()->has('login_validation_error')): ?>
                    <div class="alert alert-danger text-center"><?php echo session('login_validation_error'); ?></div>
                <?php endif; ?>
                <?php if (session()->has('login_email_error')): ?>
                    <div class="alert alert-danger text-center"><?php echo session('login_email_error'); ?></div>
                <?php endif; ?>
                <?php if (session()->has('login_password_error')): ?>
                    <div class="alert alert-danger text-center"><?php echo session('login_password_error'); ?></div>
                <?php endif; ?>
            </div>
            <div>
                <h1>Login</h1>
            </div>
            <div>
                <?php
                    echo form_label('Email', 'email');
                    echo form_input([
                        'type'  =>  'email',
                        'name'  =>  'email',
                        'class' =>  'form-control',
                        'value' =>  set_value('email')
                    ]);
                ?>
            </div>
            <div>
                <?php
                    echo form_label('Password', 'password');
                    echo form_input([
                        'type'  =>  'password',
                        'name'  =>  'password',
                        'class' =>  'form-control',
                        'value' =>  set_value('password')
                    ]);
                ?>
            </div>
            <div>
                <?php
                    echo form_submit('login_btn', 'Login', array('class' => 'btn btn-primary'));
                    echo form_reset('', 'Reset', array('class' => 'btn btn-danger'));
                ?>
            </div>
        </form>
    </div>
    <a href="<?php echo base_url('register'); ?>">If you don't have account?</a>
</section>
