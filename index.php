<?php
    get_header();
        get_template_part('template_parts/nav');
        if(is_home()){
            get_template_part('template_parts/sliders');
        }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-9 p-4  card-group justify-content-end" >
                <?php
                    if(have_posts()){
                        while(have_posts()){
                            the_post();
                            if(is_page()){
                                get_template_part('template_parts/page');
                            }else{
                                get_template_part('template_parts/post');
                            }
                        }
                    } else{
                        require_once get_template_directory() . '/404.php';
                    }
                    ?>
            </div>
            <!-- Sidebar -->
             <div id = "widget" class="col-md-3 bg-light p-2">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div>
        </div>
    </div>

<!--https: //www.billerickson.net/code/wp_query-arguments-->

<!-- 
<div class=" col p-4 card-group justify-content-center">
        <?php /*
        $args = ['s'=> 'hello',//changeable
          'post_type'=>'post',];

         $myposts = new WP_Query($args);
        if($myposts->have_posts()){
        while($myposts->have_posts()){
             $myposts->the_post();
             get_template_part('template_parts/post'); }
        wp_reset_postdata();*/
        ?>
</div>
 -->
<?php get_template_part('template_parts/pagination');?>

<?php get_footer();?>



