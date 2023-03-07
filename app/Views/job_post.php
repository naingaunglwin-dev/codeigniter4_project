<section class="job_post_form">
    <?php if (session()->has('post_validation_error')): ?>
        <div class="alert alert-danger">
            <?php
                foreach (session('post_validation_error') as $error) {
                    echo $error;
                }
            ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('upload_error')): ?>
        <div class="alert alert-danger">
            <?php echo session('upload_error'); ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <h2>JOB POST</h2>
        <div class="form border rounded p-3 col-md-8 col-md-offest-8">
            <form action="" method="post" enctype="multipart/form-data">

                <?php if (strpos($current_url, 'edit') !== false): ?>
                    <div class="job_photo">
                        <img src="<?php echo base_url('img/' . $post->img_loc); ?>" width="150" alt="">
                    </div>
                <?php endif; ?>
                    <div class="form-input">
                        <?php
                            echo form_upload([
                                'name'  =>  'post_photo',
                                'class' =>  'form-control',
                                'value' =>  set_value('post_photo', $post->img_loc)
                            ]);
                        ?>
                    </div>

                <div class="form-input">
                    <?php
                        echo form_label('Title', '');
                        echo form_input([
                            'type'  => 'text',
                            'name'  => 'title',
                            'class' => 'form-control',
                            'value' => set_value('title', $post->title)
                        ]);
                    ?>
                </div>
                <div class="form-input">
                    <?php
                        $location = array('' => 'Select Location') + $location;
                        echo form_dropdown('location', $location, set_value('location', $post->location),array('class' => 'form-select'));
                    ?>
                </div>
                <div class="form-input">
                    <?php
                        $industry = array('' => 'Select Industry') + $industry;
                        echo form_dropdown('industry', $industry, set_value('industry', $post->industry),array('class' => 'form-select'));
                    ?>
                </div>
                <div class="form-input">
                    <?php
                        $job_function = array('' => 'Select Job Function') + $job_function;
                        echo form_dropdown('job_function', $job_function, set_value('job_function', $post->job_function),array('class' => 'form-select'));
                    ?>
                </div>
                <div class="form-input">
                    <?php
                        echo form_label('Responsibilities');
                        echo form_textarea([
                            'name'  =>  'responsibilities',
                            'class' =>  'form-control',
                            'value' =>  set_value('responsibilities', $post->responsibilities)
                        ]);
                    ?>
                </div>
                <div class="form-input">
                    <?php
                        echo form_label('Requirement');
                        echo form_textarea([
                            'name'  =>  'requirement',
                            'class' =>  'form-control',
                            'value' =>  set_value('requirement', $post->requirement)
                        ]);
                    ?>
                </div>
                <div class="form-input">
                    <?php
                        echo form_label('Description');
                        echo form_textarea([
                            'name'  =>  'description',
                            'class' =>  'form-control',
                            'value' =>  set_value('description', $post->other_information)
                        ]);
                    ?>
                </div>
                <div class="form-input">
                    <?php
                        echo form_label('How To Apply');
                        echo form_input([
                            'type'  =>  'text',
                            'name'  =>  'apply_method',
                            'class' =>  'form-control',
                            'value' =>  set_value('apply_method', $post->apply_method)
                        ]);
                    ?>
                </div>
                <div>
                    <?php
                        if (strpos($current_url, 'create') !== false) {

                            echo form_submit('post_upload_btn', 'Create', array('class' => 'btn btn-primary'));
                            echo form_reset('', 'Reset', array('class' => 'btn btn-danger'));

                        } else {

                            echo form_submit('post_upload_btn', 'Update', array('class' => 'btn btn-primary'));
                            echo form_reset('', 'Reset', array('class' => 'btn btn-danger'));

                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
</section>