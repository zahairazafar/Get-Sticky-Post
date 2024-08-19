
<?php
// Get the sticky posts (posts marked as 'sticky') . You can make the post sticky using any plugin 
$sticky = get_option('sticky_posts');

// Set up query arguments to fetch only one sticky post
$sticky_args = array(
  // Specify the sticky posts
    'post__in' => $sticky, 
  // Prevent sticky posts from being prioritized in the query
    'ignore_sticky_posts' => 1, 
  // Fetch only one sticky post
    'posts_per_page' => 1, 
);

// Create a new WP_Query instance with the defined arguments
$sticky_query = new WP_Query($sticky_args);
?>

<?php if ($sticky_query->have_posts()) : ?>
    <?php while ($sticky_query->have_posts()) : $sticky_query->the_post(); ?>
        <div class="wide-postbox">
            <a href="<?php the_permalink(); ?>">
                <div class="sticky-post" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>');">
                    <?php
                    // Get the categories associated with the current post
                    $categories = get_the_category();
                    if (!empty($categories)) :
                    ?>
                        <div class="sticky-post-cat">
                            <?php foreach ($categories as $category) : ?>
                                <span><?php echo esc_html($category->name); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif;
// Display the post title 
   ?>
                    <h2><?php the_title();  ?></h2>
                </div>
            </a>
        </div>
    <?php endwhile; 
  // Reset the global post data to prevent conflicts
  ?>
    <?php wp_reset_postdata();  ?>
<?php endif; ?>
