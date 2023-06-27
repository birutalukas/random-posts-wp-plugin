<?php
/*
Plugin Name:  Kilo Health Random Posts
Plugin URI:   https://biruta.lt 
Description:  This plugin fetches random posts from an external API and can be displayed on a homepage via the shortcode.
Version:      1.0
Author:       Lukas Biruta 
Author URI:   https://biruta.lt
Text Domain:  kh-random-posts
Domain Path:  /languages
*/
include_once 'kh-style-and-script.php';
include_once 'kh-admin.php';

function kilo_random_posts_shortcode_handler( $atts, $content = null, $count = '', $order = '' ) {

    // Declare shortcode's attributes
    $kilo_atts = shortcode_atts( array(
		'count' => 50,
		'order' => 'ASC',
	), $atts );

    // Get Options
    $title = esc_attr( get_option('kh_title') );
    $qty = array_key_exists( 'count', $kilo_atts ) ? $kilo_atts['count'] : esc_attr( get_option('kh_quantity') );
    $order = array_key_exists( 'order', $kilo_atts ) ? $kilo_atts['order'] : esc_attr( get_option('kh_order') );


    // Connect to the API
    $API_url = 'https://jsonplaceholder.typicode.com/posts';
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, $API_url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    
    $jsonArrayResponse = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    
    // Prepare posts array for loop
    $posts = json_decode($jsonArrayResponse);

    // Pull only newest items
    array_splice($posts, (int)$qty);
    ?>

    <div class="container py-5">

        <?php if ( $title) : ?>
            <div class="row mb-4">
                <h2><?= $title; ?></h2>
            </div>
        <?php endif; ?>

        <div class="row masonry-grid" data-masonry='{"percentPosition": true,  "itemSelector": ".col" }'>

            <?php if ( strtoupper($order) == 'DESC' ) : ?>
                <?php rsort($posts); ?>
            <?php endif; ?>
    
            <?php foreach ($posts as $key => $post) : ?>
                
                <?php if ( $key === $qty ) : ?>
                    <?php return; ?>
                <?php endif; ?>

                <?php if ( $key <  $qty ) : ?>

                    <div class="col col-12 col-sm-6 col-md-3 mb-4 masonry-column ">
                        <div class="card shadow rounded bg-light slide-up" data-id="<?= $post->id; ?>">
                            <div class="card-header">
                                <img src="<?= plugin_dir_url( __FILE__ ).'assets/images/post-icon.svg' ?>" alt="<?= $post->title; ?>">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $post->title; ?></h5>
                                <p class="card-text"><?= $post->body; ?></p>
                            </div>
                        </div>
                    </div>  

                <?php endif; ?>

            <?php endforeach; ?>   

        </div>
    </div>

<?php
}

add_shortcode('random_posts', 'kilo_random_posts_shortcode_handler');
?>
