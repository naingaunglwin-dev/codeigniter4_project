<section class="d-flex justify-content-center w-100 mb-5">

    <div class="container">
        <div class="detail-items">
            <img src="<?php echo base_url('img/'. $detail->img_loc); ?>" width="100" height="100" alt="">
        </div>
        <div class="detail-items">
            <h3><?php echo $detail->title; ?></h3>
        </div>
        <div class="detail-items">
            <h4>Location</h4>
            <hr>
            <p><?php echo $detail->location_name; ?></p>
        </div>
        <div class="detail-items">
            <h4>Industry</h4>
            <hr>
            <p><?php echo $detail->industry_name; ?></p>
        </div>
        <div class="detail-items">
            <h4>Description</h4>
            <hr>
            <p><?php echo nl2br($detail->user_desc); ?></p>
        </div>
        <div class="detail-items">
            <h4>Responsibilities</h4>
            <hr>
            <p><?php echo nl2br($detail->responsibilities); ?></p>
        </div>
        <div class="detail-items">
            <h4>Requirement</h4>
            <hr>
            <p><?php echo nl2br($detail->requirement); ?></p>
        </div>
        <div class="detail-items">
            <h4>Other Information</h4>
            <hr>
            <p><?php echo nl2br($detail->other_information); ?></p>
        </div>
        <div class="detail-items">
            <h4>Apply Method</h4>
            <hr>
            <p><?php echo $detail->apply_method; ?></p>
        </div>
    </div>
</section>