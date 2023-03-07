<section class="job_post_list">
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success col-md-3 col-md-offset-3 text-center">
            <?php echo session('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="job_post_list_inner">
        <h3>Posted Job List</h3>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="w-50">Job Title</th>
                    <th>Posted/Updated Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    if (!empty($post)):
                ?>
                    <?php foreach ($post as $row): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['update_date']; ?></td>
                        <td><a href="<?php echo base_url('post/edit/'. $row['id']); ?>" class="btn btn-edit">Edit<i class="fa-solid fa-pen-to-square ms-1"></i></a></td>
                        <td><a href="#" class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#deletemodal" data-post-id=<?php echo $row['id']; ?>>Delete<i class="fa-solid fa-trash ms-1"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h4 class="position-absolute top-50 start-50 translate-middle">There is not posted job!</h4>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Delete Modal -->
<form action="" method="post">
    <div class="modal fade" id="deletemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a type="submit" class="btn btn-primary" id="delete_btn" name="post_delete_btn" href="<?php echo base_url('post/delete/'); ?>">Yes, Delete</a>
            </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#deletemodal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var post_id = button.data('post-id');
            var delete_btn = $('#delete_btn');

            delete_btn.attr('href', '<?php echo base_url('post/delete/'); ?>' + '/' + post_id);
        });
    });
</script>
