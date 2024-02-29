<?php $this->extend("layouts/layout"); ?>

<?php $this->section("title"); ?>
Admin-Articles
<?php $this->endsection(); ?>


<?php $this->section("content"); ?>
<div class="row my-5">
    <div class="col-md-10 mx-auto">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?php echo $post->id; ?></td>
                        <td><?php echo $post->title; ?></td>
                        <td><?php echo substr($post->description, 0, 50); ?></td>
                        <td>
                            <?php echo form_open('admin/posts/delete/' . $post->id, [
                                'id' => $post->id
                            ]); ?>
                            <?php echo form_close(); ?>
                            <button class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                if(confirm('Do you want to delete <?php echo $post->title; ?>?'))
                                    document.getElementById(<?php echo $post->id; ?>).submit();
                                ">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center my-3 sticky-bottom">
        <?php echo $pager->links(); ?>
    </div>
</div>
<?php $this->endsection(); ?>