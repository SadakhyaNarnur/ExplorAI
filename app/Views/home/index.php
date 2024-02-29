<?php $this->extend("layouts/layout"); ?>

<?php $this->section("title"); ?>
<?php echo "Home" ?>
<?php $this->endsection(); ?>

<?php
function truncateText($text, $limit) {
    // Explode the text into an array of words
    $words = explode(" ", $text);
    
    // If the number of words is greater than the limit, truncate the text
    if (count($words) > $limit) {
        // Take only the first $limit words and join them back into a string
        $truncatedText = implode(" ", array_slice($words, 0, $limit));
        // Append ellipsis (...) to indicate truncated text
        $truncatedText .= "...";
        return $truncatedText;
    } else {
        // If the number of words is less than or equal to the limit, return the original text
        return $text;
    }
}
?>
<?php $this->section("content"); ?>
<div class="card text-center mb-5 bg-secondary text-white" style="width: 60rem;">
  <div class="card-body" style="background-color: #342A3D;">
    <blockquote class="blockquote mb-0">
    <h7 class="card-title">Top 5 Blogs you need to explore</h7>
    </blockquote>
  </div>
</div>

<div class="row my-5">
    <?php foreach ($posts as $post) : ?>
            <div class="card" style="width: 60rem;">
            <div class="card mb-3" style="max-width: 1080px;">
            <div class="row g-0">
                <div class="col-md-4">
                <?php if ($post->post_image) : ?>
                        <img src="<?php echo base_url('posts_images/' . $post->post_image); ?>" width="350" height="250" class="card-img-top" alt="Unable to load">
                    <?php else : ?>
                        <img src="<?php echo base_url('posts_images/default.png'); ?>" width="350" height="250" class="card-img-top" alt="No image">
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                <div class="card-body">
                <?php $cleaned = str_replace(['[', ']', '"'], '', $post->tags);?>
                <?php $tagsArray = explode(",", $cleaned);?>
                
                <?php foreach ($tagsArray as $tag) : ?>
                     <span class="badge bg-secondary text-light bg-dark">
                        <?php echo strtoupper($tag); ?>
                    </span>
                    <?php endforeach; ?>
                    <h5 class="card-title"><?php echo $post->title; ?></h5>
                    <p class="card-text"><?php echo truncateText($post->description, 50); ?></p>
                    <span class="badge bg-info text-light">
                        <?php
                        echo $controller->getUserById($post->user_id); ?>
                    </span>
                    <span class="badge bg-warning text-light">
                        <?php
                        echo $post->created_at->humanize(); ?>
                    </span>
                    <span class="badge bg-secondary text-light bg-dark">
                        <?php
                        echo "Likes : ", $post->likes; ?>
                    </span>
                    <a href="<?= site_url('/posts/likePost/' . $post->id); ?>" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</a>
                    <a href="<?= site_url('/posts/show/' . $post->id); ?>" class="btn btn-secondary btn-sm">Read more</a>
                </div>
                </div>
            </div>
            </div>
        </div>
    <?php endforeach; ?>
    
    <div class="d-flex flex-column min-vh-10">
        <div class="d-flex justify-content-center my-3">
           <!-- can check the pagination from posts/index.php -->
        </div>
    </div>
</div>
<?php $this->endsection(); ?>