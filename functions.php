<?php 
//echo get_template_directory_uri().'/assets/css/bootstrap.min.css';

add_action('init',function(){

	//Adding css files, js script, theme support, and actions.

    if (!is_admin()) {
        wp_enqueue_style('boot01', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
        wp_enqueue_style('custom-style', get_template_directory_uri() . '/style.css?hjdskh');
        wp_enqueue_script('bootjs', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '', true);
    }

    add_theme_support('widgets');
    add_theme_support('menus');
    add_theme_support('post-thumbnails');

    add_image_size('post-preview',270,200,true);
	add_image_size('post-preview-small',100,100,true);
    //register_menu
        register_nav_menus(
          array(
            'header-menu' => 'Header Menu' ,
            'footer-menu' => 'Footer Menu' ,
            'sidebar-menu'=>'Sidebar Menu')
         );
       }
);
//custom logo
add_action('after_setup_theme',function() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => false, 
	);
	add_theme_support( 'custom-logo', $defaults );
});

//register sidebars
add_action('widgets_init',function() {
	register_sidebar( array(
		'name'          => 'Primary Sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'footer Sidebar1',
		'id'            => 'footer-sidebar-1',
		'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li></ul>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    register_sidebar( array(
		'name'          => 'footer Sidebar2',
		'id'            => 'footer-sidebar-2',
		'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li></ul>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
});

//SLIDER settings
add_action( 'customize_register', function ( $wp_customize ) 
  {

	//image_slider section
	$wp_customize->add_section( 'theme_slider_settings', array(
		'title' => __( 'Slider Image Settings' ),
		'description' => __( 'Edit slider image settings' ),
		'priority' => 160,
		'capability' => 'edit_theme_options',));

		//activate sldier setting
		$wp_customize->add_setting( 'theme_slider_activate', array(
			'type' => 'theme_mod', // or 'option'
			'capability' => 'edit_theme_options',
			'default' => '1',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field',
		  ) );


	  $wp_customize->add_control( 'theme_slider_activate', array(
		'type' => 'checkbox',
		'priority' => 10, // Within the section.
		'section' => 'theme_slider_settings', // Required, core or custom.
		'label' => __( 'activate image slider' ),
		'description' => __( 'activate/deactivate' ),
		'input_attrs' => array(
		  'class' => 'my-custom-class-for-js',
		  'style' => '',
		),
		'active_callback' => 'is_front_page',
	  ) );

//slider image text settings
//1

//image slider 1
	  $wp_customize->add_setting( 'theme_slider_image_1', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'default' => '',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'sanitize_text_field',
	  ) );


	  $wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'theme_slider_image_1',
			array(
				'label'      => __( 'Slider Image 1'),
				'section'    => 'theme_slider_settings',
				'height'=>200, // cropper Height
				'width'=>1000, // Cropper Width
				'flex_width'=>false, //Flexible Width
				'flex_height'=>false, // Flexible Heiht
			)
		)
	);

	/*$wp_customize->add_setting( 'theme_slider_header_text_1', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'default' => 'First slide label',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'sanitize_text_field',
	  ) );
	  $wp_customize->add_setting( 'theme_slider_content_text_1', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'default' => '',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'sanitize_text_field',
	  ) );



	$wp_customize->add_control( 'theme_slider_header_text_1', array(
		'type' => 'text',
		'section' => 'theme_slider_settings', // Required, core or custom.
		'label' => __( 'Image 1 header text' ),
		'input_attrs' => array(
		  'class' => 'my-custom-class-for-js',
		  'style' => '',
		  'placeholder' => __( 'Image 1 header text' ),
		),
		'active_callback' => 'is_front_page',
	  ) );

	
	$wp_customize->add_control( 'theme_slider_content_text_1', array(
		'type' => 'textarea',
		'section' => 'theme_slider_settings', // Required, core or custom.
		'label' => __( 'Image 1 content text' ),
		'input_attrs' => array(
		  'class' => 'my-custom-class-for-js',
		  'style' => '',
		  'placeholder' => __( 'Image 1 content text' ),
		),
		'active_callback' => 'is_front_page',
	  ) );*/



	//image slider 2
	$wp_customize->add_setting( 'theme_slider_image_2', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'default' => '',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'sanitize_text_field',
	  ) );

	  $wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'theme_slider_image_2',
			array(
				'label'      => __( 'Slider Image 2'),
				'section'    => 'theme_slider_settings',
				'height'=>200, // cropper Height
				'width'=>1000, // Cropper Width
				'flex_width'=>false, //Flexible Width
				'flex_height'=>false, // Flexible Heiht
			)
		)
	);
	//2
	/*$wp_customize->add_setting( 'theme_slider_header_text_2', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'default' => 'second slide label',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'sanitize_text_field',
	  ) );
	  $wp_customize->add_setting( 'theme_slider_content_text_2', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'default' => 'second slide label',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'sanitize_text_field',
	  ) );

	  $wp_customize->add_control( 'theme_slider_header_text_2', array(
		'type' => 'text',
		'section' => 'theme_slider_settings', // Required, core or custom.
		'label' => __( 'Image 2 header text' ),
		'input_attrs' => array(
		  'class' => 'my-custom-class-for-js',
		  'style' => '',
		  'placeholder' => __( 'Image 2 header text' ),
		),
		'active_callback' => 'is_front_page',
	  ) );

	
	$wp_customize->add_control( 'theme_slider_content_text_2', array(
		'type' => 'textarea',
		'section' => 'theme_slider_settings', // Required, core or custom.
		'label' => __( 'Image 2 content text' ),
		'input_attrs' => array(
		  'class' => 'my-custom-class-for-js',
		  'style' => '',
		  'placeholder' => __( 'Image 2 content text' ),
		),
		'active_callback' => 'is_front_page',
	  ) );*/
	
	
	
	
	//image slider 3
	$wp_customize->add_setting( 'theme_slider_image_3', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control(
	  new WP_Customize_Cropped_Image_Control(
		  $wp_customize,
		  'theme_slider_image_3',
		  array(
			  'label'      => __( 'Slider Image 3'),
			  'section'    => 'theme_slider_settings',
			  'height'=>300, // cropper Height
			  'width'=>1000, // Cropper Width
			  'flex_width'=>false, //Flexible Width
			  'flex_height'=>false, // Flexible Heiht
		  )
	  )
  );  //3
  /*$wp_customize->add_setting( 'theme_slider_header_text_3', array(
	'type' => 'theme_mod', // or 'option'
	'capability' => 'edit_theme_options',
	'default' => 'third slide label',
	'transport' => 'refresh', // or postMessage
	'sanitize_callback' => 'sanitize_text_field',
  ) );
  $wp_customize->add_setting( 'theme_slider_content_text_3', array(
	'type' => 'theme_mod', // or 'option'
	'capability' => 'edit_theme_options',
	'default' => '',
	'transport' => 'refresh', // or postMessage
	'sanitize_callback' => 'sanitize_text_field',
  ) );


  $wp_customize->add_control( 'theme_slider_header_text_3', array(
	'type' => 'text',
	'section' => 'theme_slider_settings', // Required, core or custom.
	'label' => __( 'Image 3 header text' ),
	'input_attrs' => array(
	  'class' => 'my-custom-class-for-js',
	  'style' => '',
	  'placeholder' => __( 'Image 3 header text' ),
	),
	'active_callback' => 'is_front_page',
  ) );


$wp_customize->add_control( 'theme_slider_content_text_3', array(
	'type' => 'textarea',
	'section' => 'theme_slider_settings', // Required, core or custom.
	'label' => __( 'Image 3 content text' ),
	'input_attrs' => array(
	  'class' => 'my-custom-class-for-js',
	  'style' => '',
	  'placeholder' => __( 'Image 3 content text' ),
	),
	'active_callback' => 'is_front_page',
  ) );*/
	


	


} );

require get_template_directory() . '/template_parts/walker.php';
require get_template_directory() . '/template_parts/widgets.php';