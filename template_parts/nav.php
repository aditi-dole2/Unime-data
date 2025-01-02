<nav class="navbar navbar-expand-lg" >
    <div class="container-fluid">
    <?php
      if (has_custom_logo() ) {
        the_custom_logo();
      }else
          {?>
    <a class="navbar-brand site-title" href="<?= get_home_url();?>">
    <?php bloginfo('name')?>
    </a>  <?php
}?>
  
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
  aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php 
      wp_nav_menu( 
        array( 
          'theme_location' => 'header-menu', // Menu location, referenced in Appearance
          'container' => '',
          'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
          'walker' => new header_menu_walker(),));?>


      <form class="d-flex" action="<?php get_home_url()?>">
        <input name="s" class="form-control me-2" type="search" placeholder="Search" 
        aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
    
  </div>
</nav>

</div>
