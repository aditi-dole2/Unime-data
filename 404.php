<?php
get_header();

  get_template_part('template-parts/nav');


   ?>

<div class="p-4 justify-content-center mx-auto" style ="max-width:600px;">
  
    <h1>we cant find the what you are looking for.<br></h1>
    <h3>search below:<br></h3>

    <form class="d-flex" action="<?= get_home_url()?>">
        <input autofocus name="s" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>

<?php get_footer()?>
