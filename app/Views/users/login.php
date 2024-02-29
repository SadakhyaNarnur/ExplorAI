<?php $this->extend("layouts/layout"); ?>

<?php $this->section("title"); ?>
Login
<?php $this->endsection(); ?>


<?php $this->section("content"); ?>
<div class="row my-5">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white text-center">
                <h3 class="card-title">
                    Login
                </h3>
                <hr />
                <?php if (session()->has("errors")) : ?>
                    <?php foreach (session("errors") as $error) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php echo form_open('login/auth'); ?>
                <div class="form-group">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'email',
                        'id'    => 'email',
                        'placeholder' => 'Email',
                        'class' => 'form-control my-2',
                        'value' => old('email')
                    ];
                    echo form_input($data);
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $data = [
                        'type'  => 'password',
                        'name'  => 'password',
                        'id'    => 'password',
                        'placeholder' => 'Password',
                        'class' => 'form-control',
                        'value' => old('password')
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
        </div>
    </div>
</div>
<?php $this->endsection(); ?>