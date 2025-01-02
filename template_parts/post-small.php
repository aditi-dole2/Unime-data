<a href="<?php the_permalink()?>">
    <div id="sidebar" class="card m-3 shadow border text-center">
        <div class="d-flex">
            <div class="flex-shrink-0">
                <?php the_post_thumbnail('post-preview-small', ['class' => 'card-img-top', 'alt' => get_the_title()]); ?>
            </div>
            <div  class="card-body">
                <h6 class="card-title"><?php the_title()?></h6>
                <p class="card-text">Read more</p>
            </div>
        </div>
    </div>
</a>
