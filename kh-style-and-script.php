<?php

function kh_enqueue_styles_and_scripts() 
{       
    // JS
    wp_register_script('kh_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js');
    wp_register_script('kh_masonry', 'https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js');
    wp_register_script('kh_custom_js', plugins_url( '/kh-random-posts/assets/scripts/script.js' ) );

    wp_enqueue_script('kh_bootstrap');
    wp_enqueue_script('kh_masonry');
    wp_enqueue_script('kh_custom_js');


    // CSS
    wp_register_style('kh_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_register_style('kh_custom_css', plugins_url( '/kh-random-posts/assets/css/style.css' ) );
    
    wp_enqueue_style('kh_bootstrap');
	wp_enqueue_style( 'kh_custom_css' );

}

add_action( 'wp_enqueue_scripts', 'kh_enqueue_styles_and_scripts' );

?>