<?php
/*
Plugin Name: Product Grid for WooCommerce
Plugin URI: http://paratheme.com
Description: Awesome post grid for query post from any post-type and display on grid.
Version: 1.0
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('product_grid_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('product_grid_plugin_dir', plugin_dir_path( __FILE__ ) );
define('product_grid_wp_url', 'https://wordpress.org/plugins/product-grid/' );
define('product_grid_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/product-grid' );
define('product_grid_pro_url','http://paratheme.com' );
define('product_grid_demo_url', 'http://paratheme.com/demo/product-grid/' );
define('product_grid_conatct_url', 'http://paratheme.com/contact/' );
define('product_grid_qa_url', 'http://paratheme.com/qa/' );
define('product_grid_plugin_name', 'Product Grid' );
define('product_grid_share_url', 'https://wordpress.org/plugins/product-grid/' );
define('product_grid_tutorial_video_url', '//www.youtube.com/embed/B0sOggSp3h9fE?rel=0' );








require_once( plugin_dir_path( __FILE__ ) . 'includes/product-grid-meta.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/product-grid-functions.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/ProductGridClass.php');

//Themes php files

require_once( plugin_dir_path( __FILE__ ) . 'themes/flat/index.php');




function product_grid_init_scripts()
	{
		wp_enqueue_script('jquery');

		wp_enqueue_style('product_grid_style', product_grid_plugin_url.'css/style.css');
		wp_enqueue_script('masonry.pkgd.min', plugins_url( '/js/masonry.pkgd.min.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_style('style-woocommerce', product_grid_plugin_url.'css/style-woocommerce.css');		
		
		//ParaAdmin
		wp_enqueue_style('ParaAdmin', product_grid_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		
		// Style for themes
		wp_enqueue_style('product-grid-style-flat', product_grid_plugin_url.'themes/flat/style.css');	
			
		
	}
add_action("init","product_grid_init_scripts");









function product_grid_admin_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-droppable');
						
		wp_enqueue_script('product_grid_admin_js', plugins_url( '/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'product_grid_admin_js', 'product_grid_ajax', array( 'product_grid_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		
		wp_enqueue_style('product_grid_admin_style', product_grid_plugin_url.'admin/css/style.css');

		//ParaAdmin
		wp_enqueue_style('ParaAdmin', product_grid_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		//wp_enqueue_style('ParaIcons', product_grid_plugin_url.'ParaAdmin/css/ParaIcons.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
	
	
	
	}



add_action( 'admin_enqueue_scripts', 'product_grid_admin_scripts' );




// to work upload button on user profile
add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' ); 




register_activation_hook(__FILE__, 'product_grid_activation');


function product_grid_activation()
	{
		$product_grid_version= "1.0";
		update_option('product_grid_version', $product_grid_version); //update plugin version.
		
		$product_grid_customer_type= "free"; //customer_type "free"
		update_option('product_grid_customer_type', $product_grid_customer_type); //update plugin version.

	}


function product_grid_display($atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => "",

				), $atts);


			$post_id = $atts['id'];

			$product_grid_themes = get_post_meta( $post_id, 'product_grid_themes', true );

			$html = '';

			if($product_grid_themes== "flat")
				{
					$html.= product_grid_themes_flat($post_id);
				}						
			else
				{
					$html.= product_grid_themes_flat($post_id);
				}					
							

			return $html;




}

add_shortcode('product_grid', 'product_grid_display');




add_action('admin_menu', 'product_grid_menu_init');

function product_grid_menu_help(){
	include('product-grid-help.php');	
}




function product_grid_menu_init() {
	add_submenu_page('edit.php?post_type=product_grid', __('Help','product_grid'), __('Help','product_grid'), 'manage_options', 'product_grid_menu_help', 'product_grid_menu_help');


}






?>