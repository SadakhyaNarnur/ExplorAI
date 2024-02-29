<?php $this->extend("layouts/layout"); ?>

<?php $this->section("title"); ?>
Update profile
<?php $this->endsection(); ?>


<?php $this->section("content"); ?>
<div class="row my-5">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white text-center">
                <h3 class="card-title">
                    Update profile
                </h3>
            </div>
            <div class="card-body p-2">
                <?php if (session()->has("errors")) : ?>
                    <?php foreach (session("errors") as $error) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php echo form_open('profile/updateProfile/' . $user->id); ?>
                <div class="form-group">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'name',
                        'id'    => 'name',
                        'placeholder' => 'Name',
                        'class' => 'form-control',
                        'value' => old('name', $user->name)
                    ];
                    echo form_input($data);
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $data = [
                        'type'  => 'email',
                        'name'  => 'email',
                        'id'    => 'email',
                        'placeholder' => 'E-mail',
                        'class' => 'form-control my-2',
                        'value' => old('email', $user->email)
                    ];
                    echo form_input($data);
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_submit('submit', 'Submit', [
                        'class' => 'btn btn-primary my-2'
                    ]);
                    ?>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="card-footer">
                <a href="<?php echo site_url("profile/editUserPassword"); ?>" class="btn btn-sm btn-warning">
                    Update your password
                </a>
            </div>
        </div>
    </div>
</div>
<?php $this->endsection(); ?>