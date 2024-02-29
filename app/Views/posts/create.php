<?php $this->extend("layouts/layout"); ?>

<?php $this->section("title"); ?>
Add new article
<?php $this->endsection(); ?>


<?php $this->section("content"); ?>
<div class="row my-5">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white text-center">
                <h3 class="card-title">
                    Add new article
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
                <?php echo form_open_multipart('posts/store'); ?>
                <div class="form-group">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'title',
                        'id'    => 'title',
                        'placeholder' => 'Title',
                        'class' => 'form-control',
                        'value' => old('title')
                    ];
                    echo form_input($data);
                    ?>
                </div>
                <div class="form-group my-2">
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Body"><?php echo old('description'); ?></textarea>
                </div>
                <div class="form-group">
                    <!-- Multi-selection checkbox dropdown -->
                    <label>Tags</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="ai" name="tags[]" value="ai">
                        <label class="form-check-label" for="tag1">AI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="ml" name="tags[]" value="ml">
                        <label class="form-check-label" for="tag2">ML</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="cloud" name="tags[]" value="cloud">
                        <label class="form-check-label" for="tag3">Cloud</label>
                    </div>
                    <!-- Add more checkboxes as needed -->
                </div>
                <div class="form-group">
                    <?php
                    $data = [
                        'type'  => 'file',
                        'name'  => 'image',
                        'id'    => 'image',
                        'class' => 'form-control'
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
