<section class="auth-form container">
    <div class="register col-md-4 col-md-offset-4 ">
        <form action="" method="post">
            <?php if (isset($validation_error)): ?>
                <div class="alert alert-danger">
                    <?php foreach($validation_error as $error) {
                        echo $error;
                    }?>
                </div>
            <?php endif; ?>
            <?php if (session('email_error')): ?>
                <div class="alert alert-danger">
                    <?php echo session('email_error');?>
                </div>
            <?php endif; ?>
            <div>
                <h1>Create User</h1>
            </div>
            <div>
                <?php
                    echo form_label('First Name', 'firstname');
                    echo form_input([
                        'type'      =>  'text',
                        'name'      =>  'first_name',
                        'class'     =>  'form-control',
                        'required'  =>  'required',
                        'value'     =>  set_value('first_name')
                    ]);
                ?>
            </div>
            <div>
                <?php
                    echo form_label('Last Name', 'lastname');
                    echo form_input([
                        'type'      =>  'text',
                        'name'      =>  'last_name',
                        'class'     =>  'form-control',
                        'required'  =>  'required',
                        'value'     =>  set_value('last_name')
                    ]);
                ?>
            </div>
            <div>
                <?php
                    echo form_label('Email', 'email');
                    echo form_input([
                        'type'      =>  'email',
                        'name'      =>  'email',
                        'class'     =>  'form-control',
                        'required'  =>  'required',
                        'value'     =>  set_value('email')
                    ]);
                ?>
            </div>
            <div>
                <?php
                    echo form_label('Password', 'password');
                    echo form_input([
                        'type'      =>  'password',
                        'name'      =>  'password',
                        'class'     =>  'form-control',
                        'required'  =>  'required',
                        'value'     =>  set_value('password')
                    ]);
                ?>
            </div>
            <div>
                <?php
                    echo form_label('Confirm Password', 'confirmpassword');
                    echo form_input([
                        'type'      =>  'password',
                        'name'      =>  'cpassword',
                        'class'     =>  'form-control',
                        'required'  =>  'required',
                        'value'     =>  set_value('cpassword')
                    ]);
                ?>
            </div>
            <div>
                <?php
                    echo form_label('Description', 'description');
                    echo form_textarea([
                        'name'  =>  'description',
                        'class' =>  'form-control',
                        'value' =>  set_value('description')
                    ]);
                ?>
            </div>
            <div>
                <?php
                    echo form_submit('register_btn', 'Register', array('class' => 'btn btn-primary'));
                    echo form_reset('', 'Reset', array('class' => 'btn btn-danger'));
                ?>
            </div>
        </form>
    </div>
    <a href="<?php echo base_url('login'); ?>">If you already have account?</a>
</section>