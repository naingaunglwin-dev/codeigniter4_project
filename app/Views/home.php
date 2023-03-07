<div class="home">
    <?php if (session()->has('login_alert')): ?>
        <div class="alert alert-danger col-md-3 col-md-offset-3 text-center">
            <?php echo session('login_alert'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="home-inner">
        <div class="home-search-area border rounded p-1">
            <form action="" method="post" class="row" id="search-form">
                <div class="col-6 row home-search-input">
                    <div class="row home-search-input-inner">
                        <?php
                            echo form_label('Job Title', '', array('class' => 'col-2'));
                            echo form_input([
                                'type'  =>  'text',
                                'class' =>  'form-control w-75 col-10',
                                'name'  =>  'search_job_title',
                                'value' =>  set_value('search_job_title')
                            ]);
                        ?>
                    </div>
                    <div class="row home-search-input-inner">
                        <?php
                            $industry = array('' => 'Select') + $industry;
                            echo form_label('Industry', '', array('class' => 'col-2'));
                            echo form_dropdown('industry', $industry, set_value('industry'),array('class' => 'form-select w-75 col-10'));
                        ?>
                    </div>
                </div>
                <div class="col-6 row home-search-input">
                    <div class="row home-search-input-inner">
                        <?php
                            $job_function = array('' => 'Select') + $job_function;
                            echo form_label('Job Function', '', array('class' => 'col-2'));
                            echo form_dropdown('job_function', $job_function, set_value('job_function'),array('class' => 'form-select w-75 col-10'));
                        ?>
                    </div>
                    <div class="row home-search-input-inner">
                        <?php
                            $location = array('' => 'Select') + $location;
                            echo form_label('Location', '', array('class' => 'col-2'));
                            echo form_dropdown('location', $location, set_value('location'),array('class' => 'form-select w-75 col-10'));
                        ?>
                    </div>
                </div>
                <div class="button-area">
                    <button id="post-search" type="button" name="post_search_btn" class="btn btn-primary" onclick="data_search();">Search</button>
                    <?php
                        echo form_reset('', 'Reset', array('class' => 'btn btn-danger'));
                    ?>
                </div>
            </form>
        </div>
        <div id="search-result">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <td class="w-50">Title</td>
                        <td>Industry</td>
                        <td>Posted Date</td>
                        <td>View Detail</td>
                    </tr>
                </thead>
                <tbody class="result">

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        data_search();
    });

    function data_search() {
        var form_data = $('#search-form').serialize();
        $.ajax({
            url: '<?php echo base_url('search'); ?>',
            type: 'POST',
            data: form_data,
            dataType: 'json',
            success:function(response){
                    //$('.result').html(result);
                //console.log(response.result);

                if (response.status == 'success') {
                    $('.result').html(response.data);
                } else {
                    $('.result').html('<tr><td colspan="4">No data found.</td></tr>');
                }
            }
        })
    }

</script>
