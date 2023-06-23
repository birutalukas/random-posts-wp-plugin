<?php

function kilo_create_menu() {

	//create new top-level menu
	add_menu_page('Random Posts', 'Random Posts', 'administrator', __FILE__, 'kilo_settings_page' , 'dashicons-admin-post' );

	//call register settings function
    
}
add_action('admin_menu', 'kilo_create_menu');


function register_kilo_settings() {
	//register our settings
	register_setting( 'kh-settings-group', 'kh_title' );
	register_setting( 'kh-settings-group', 'kh_quantity' );
	register_setting( 'kh-settings-group', 'kh_order' );
}	
add_action( 'admin_init', 'register_kilo_settings' );

function kilo_settings_page() {
?>
<div class="wrap">
    <h1><?php esc_html_e( 'Kilo Health Random Posts', 'kh-random-posts' ); ?></h1>

    <form method="post" action="options.php">

        <?php settings_fields( 'kh-settings-group' ); ?>
        <?php do_settings_sections( 'kh-settings-group' ); ?>

        <table class="form-table">
            <tr>
                <th><?php esc_html_e( 'Feed title', 'kh_title' ) ?></th>
                <td>
                    <input type="text" name="kh_title" value="<?= esc_attr( get_option('kh_title') ); ?>" />
                    <p><?php esc_html_e( 'Displayed on the top of the section.', 'kh-random-posts' ) ?></p>

                </td>
            </tr>

            <tr>
                <th><?php esc_html_e( 'How many posts?', 'kh-random-posts' ) ?></th>
                <td>
                    <input type="text" name="kh_quantity" value="<?= esc_attr( get_option('kh_quantity') ); ?>" />
                    <p><?php esc_html_e( 'Maximum number of posts to retrieve.', 'kh-random-posts' ) ?></p>
                </td>
            </tr>
            
            <tr>
                <th><?php esc_html_e( 'Order?', 'kh-random-posts' ) ?></th>
                <td>
                    <select name="kh_order" id="kh_order">
                        <option value="ASC" <?= esc_attr( get_option('kh_order') ) === 'ASC' ?  'selected' : ''; ?> >Ascending</option>
                        <option value="DESC" <?= esc_attr( get_option('kh_order') )  === 'DESC' ?  'selected' : ''; ?>>Descending</option>
                    </select>
                    <p><?php esc_html_e( 'Select the order.', 'kh-random-posts' ) ?></p>

                </td>
            </tr>        
        
        </table>
        
        <?php submit_button(); ?>

    </form>
</div>
<?php } ?>