<?php $this->extend("layouts/layout"); ?>

<?php $this->section("title"); ?>
Admin-Users
<?php $this->endsection(); ?>


<?php $this->section("content"); ?>
<div class="row my-5">
    <div class="col-md-10 mx-auto">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td>
                            <?php if ($user->is_admin) : ?>
                                <span class="badge bg-success">
                                    Admin
                                </span>
                            <?php else : ?>
                                <span class="badge bg-danger">
                                    Simple user
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo form_open('admin/users/delete/' . $user->id, [
                                'id' => $user->id
                            ]); ?>
                            <?php echo form_close(); ?>
                            <button class="btn btn-sm btn-danger <?php echo $user->id === session("user_id") ? "disabled" : ""; ?>" onclick="event.preventDefault();
                                if(confirm('Do you want to delete <?php echo $user->name; ?>?'))
                                    document.getElementById(<?php echo $user->id; ?>).submit();
                                ">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        <td>
                            <?php echo form_open('admin/users/update/' . $user->id); ?>
                            <button type="submit" class="btn btn-sm
                                <?php echo $user->id === session("user_id") ? "disabled" : ""; ?>
                                <?php echo $user->is_admin ? "btn-danger" : "btn-success"; ?>">
                                <i class="fas <?php echo $user->is_admin ? "fa-times" : "fa-user-plus"; ?>"> </i>
                            </button>
                            <?php echo form_close(); ?>
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