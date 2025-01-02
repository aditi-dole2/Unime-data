<?php 
$slider_active = get_theme_mod('theme_slider_activate',1);
?>
<?php if($slider_active):?>
  
<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <?php
        $image= get_template_directory_uri().'/assets/images/slider1.jpg';
        if(get_theme_mod('theme_slider_image_1','' )!="")
        {
          $image=wp_get_attachment_url(get_theme_mod('theme_slider_image_1',''));
        }
      ?>
      <img src="<?=$image?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
    <?php
        $image= get_template_directory_uri().'/assets/images/slider2.jpg';
        if(get_theme_mod('theme_slider_image_2','' )!="")
        {
          $image=wp_get_attachment_url(get_theme_mod('theme_slider_image_2',''));
        }
      ?>
      <img src="<?=$image?>" class="d-block w-100" alt="...">   </div>
    <div class="carousel-item">
    <?php
        $image= get_template_directory_uri().'/assets/images/slider3.jpg';
        if(get_theme_mod('theme_slider_image_3','' )!="")
        {
          $image=wp_get_attachment_url(get_theme_mod('theme_slider_image_3',''));
        }
      ?>
      <img src="<?=$image?>" class="d-block w-100" alt="...">   </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" 
  data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" 
  data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<?php endif;?>