<div class="text-center justify-content-center">
    <div style="text-align:center">

        <?php 
        $post_id = get_the_ID();
        $views =  (int)get_post_meta($post_id, 'views', true);
        update_post_meta($post_id, 'views', $views + 1);
        $views = get_post_meta($post_id, 'views', true);
        echo "Views: <i class='fa fa-eye'></i>" . $views . "<br>";
        ?>
        <div class="card-container">
            <?php the_post_thumbnail('post-thumbnail', 
            ['style' => 'height:400px;width:500px;display:inline-block;'])?>
            <h5 class="card-title"><?php the_title()?></h5>
            <div class="card-body">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

