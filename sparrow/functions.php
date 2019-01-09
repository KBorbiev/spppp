<?php

add_action( 'wp_enqueue_scripts', 'style_theme' );
add_action( 'wp_footer', 'scripts_theme' );
add_action( 'after_setup_theme', 'theme_register_nav_menu' );

function theme_register_nav_menu(){
    register_nav_menus( array(
            'top' => 'Меню в шапке',
            'bottom' => 'Меню в подвале'
        )
    );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails', array( 'post' ) );
    add_image_size('post-thumb', 1300, 500, true);
    // удаляет H2 из шаблона пагинации
    add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
    function my_navigation_template( $template, $class ){
        return 
        '<nav class="navigation %1$s" role="navigation">
            <div class="nav-links">%3$s</div>
        </nav>';
    }

    // выводим пагинацию
    the_posts_pagination( array(
        'end_size' => 2,
    ) ); 
}

function style_theme() {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('default', get_template_directory_uri() . '/assets/css/default.css' );
    wp_enqueue_style('layout', get_template_directory_uri() . '/assets/css/layout.css' );
    wp_enqueue_style('queries', get_template_directory_uri() . '/assets/css/media-queries.css' );
}

function scripts_theme() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
    wp_enqueue_script('jquery');
    wp_enqueue_script('flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', ['jquery'], null, true );
    wp_enqueue_script('doubletaptogo', get_template_directory_uri() . '/assets/js/doubletaptogo.js', ['jquery'], null, true );
    wp_enqueue_script('init', get_template_directory_uri() . '/assets/js/init.js', ['jquery'], null, true );
    wp_enqueue_script('medernizr', get_template_directory_uri() . '/assets/js/modernizr.js', null, null, true );
}

add_action( 'widgets_init', 'register_my_widgets' );

function register_my_widgets() {
    register_sidebar( array(
            'name'          => 'Right sidebar',
            'id'            => "right_sidebar",
            'description'   => 'Описание сайдбара...',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => "</div>\n",
            'before_title'  => '<h5 class="widgettitle">',
            'after_title'   => "</h5>\n"
        )
    );
}

