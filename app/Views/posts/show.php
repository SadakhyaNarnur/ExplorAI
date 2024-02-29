<?php $this->extend("layouts/layout"); ?>

<?php $this->section("title"); ?>
<?php echo $post->title; ?>
<?php $this->endsection(); ?>


<?php $this->section("content"); ?>
<?php if ($post->post_image) : ?>
    <img src="<?php echo base_url('posts_images/' . $post->post_image); ?>" width="500" height="450" class="img-fluid" alt="...">
<?php else : ?>
    <img src="<?php echo base_url('posts_images/default.png'); ?>" width="500" height="450" class="img-fluid" alt="...">
<?php endif; ?>
<p>
    <span class="badge bg-primary">
        <?php echo $controller->getUserById($post->user_id); ?>
    </span>
</p>
<h1>
    <?php echo $post->title; ?>
</h1>
<p>
    <?php echo $post->description; ?>
</p>
<?php if ($owner) : ?>
    <a href=" <?php echo site_url("/posts/edit/" . $post->id); ?>" class="btn btn-sm btn-warning">Update</a>
    <?php echo form_open('posts/delete/' . $post->id, [
        'id' => 'deletePost'
    ]); ?>
    <?php echo form_close(); ?>
    <button class="btn btn-sm btn-danger" onclick="event.preventDefault();
                    if(confirm('Are you sure ?'))
                        document.getElementById('deletePost').submit();
                    ">
        Delete
    </button>
<?php endif; ?>
<?php $this->endsection(); ?>