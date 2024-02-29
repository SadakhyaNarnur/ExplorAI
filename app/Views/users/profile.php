<?php $this->extend("layouts/layout"); ?>

<?php $this->section("title"); ?>
Profile - <?php echo $user->name; ?>
<?php $this->endsection(); ?>


<?php $this->section("content"); ?>
<div class="row my-4">
    <div class="col-md-8 mx-auto">
        <div class="card p-3 d-flex flex-row justify-content-around">
            <div class="p-2">
                <h2>
                    Hello
                        <?php echo $user->name; ?></h2>

                <p>Welcome to our blog, where we delve into the dynamic realm of technology, artificial intelligence (AI), and data-driven innovations. At ExplorAi Blogs, we are passionate about exploring the cutting-edge advancements shaping our digital landscape. With a keen focus on the transformative power of AI and the intricacies of data science, we strive to provide insightful analyses, thought-provoking discussions, and expert perspectives on emerging trends and breakthroughs in technology. Our mission is to foster a community of tech enthusiasts, professionals, and curious minds eager to delve into the ever-evolving world of technology and its profound impact on society. Join us on this journey as we navigate the complexities of the digital age and uncover the limitless possibilities that technology, AI, and data hold for the future.</p>
    
            </div>
        </div>
    </div>
</div>
<?php $this->endsection(); ?>