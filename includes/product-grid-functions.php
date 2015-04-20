<?php



function product_grid_get_all_product_ids($postid)
	{
		
		$product_grid_product_ids = get_post_meta( $postid, 'product_grid_product_ids', true );
		
		
		
		$return_string = '';
		$return_string .= '<ul style="margin: 0;">';
		
		
		
		$args_product = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		);

		$product_query = new WP_Query( $args_product );
	
		if($product_query->have_posts()): while($product_query->have_posts()): $product_query->the_post();
		

	   $return_string .= '<li><label ><input class="product_grid_product_ids" type="checkbox" name="product_grid_product_ids['.get_the_ID().']" value ="'.get_the_ID().'" ';
		
		if ( isset( $product_grid_product_ids[get_the_ID()] ) )
			{
			$return_string .= "checked";
			}
		
		
		
		
		$return_string .= '/>';

		$return_string .= get_the_title().'</label ></li>';
			
		endwhile;   endif; wp_reset_query();
		
		
		$return_string .= '</ul>';
		echo $return_string;
	
	}






function product_grid_get_taxonomy_category($postid)
	{
		

	
	$product_grid_taxonomy = get_post_meta( $postid, 'product_grid_taxonomy', true );
	if(empty($product_grid_taxonomy))
		{
			$product_grid_taxonomy= "";
		}
	$product_grid_taxonomy_category = get_post_meta( $postid, 'product_grid_taxonomy_category', true );
	
		
		if(empty($product_grid_taxonomy_category))
			{
			 	$product_grid_taxonomy_category =array('none'); // an empty array when no category element selected
				
			
			}

		
		
		if(!isset($_POST['taxonomy']))
			{
			$taxonomy =$product_grid_taxonomy;
			}
		else
			{
			$taxonomy = $_POST['taxonomy'];
			}
		
		
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => $taxonomy,
		  );
	
	$categories = get_categories($args);
	
	
	if(empty($categories))
		{
		echo "No Items Found!";
		}
	
	
		$return_string = '';
		$return_string .= '<ul style="margin: 0;">';
	
	foreach($categories as $category){
		
		if(array_search($category->cat_ID, $product_grid_taxonomy_category))
		{
	   $return_string .= '<li class='.$category->cat_ID.'><label ><input class="product_grid_taxonomy_category" checked type="checkbox" name="product_grid_taxonomy_category['.$category->cat_ID.']" value ="'.$category->cat_ID.'" />'.$category->cat_name.'</label ></li>';
		}
		
		else
			{
				   $return_string .= '<li class='.$category->cat_ID.'><label ><input class="product_grid_taxonomy_category" type="checkbox" name="product_grid_taxonomy_category['.$category->cat_ID.']" value ="'.$category->cat_ID.'" />'.$category->cat_name.'</label ></li>';			
			}
		
		

		
		}
	
		$return_string .= '</ul>';
		
		echo $return_string;
	
	if(isset($_POST['taxonomy']))
		{
			die();
		}
	
		
	}

add_action('wp_ajax_product_grid_get_taxonomy_category', 'product_grid_get_taxonomy_category');
add_action('wp_ajax_nopriv_product_grid_get_taxonomy_category', 'product_grid_get_taxonomy_category');


















// solve error replace #038; by &

function product_grid_fix_pagination($link) {
	
	return str_replace('#038;', '&', $link);
	
	}
add_filter('paginate_links', 'product_grid_fix_pagination');



































function product_grid_dark_color($input_color)
	{
		if(empty($input_color))
			{
				return "";
			}
		else
			{
				$input = $input_color;
			  
				$col = Array(
					hexdec(substr($input,1,2)),
					hexdec(substr($input,3,2)),
					hexdec(substr($input,5,2))
				);
				$darker = Array(
					$col[0]/2,
					$col[1]/2,
					$col[2]/2
				);
		
				return "#".sprintf("%02X%02X%02X", $darker[0], $darker[1], $darker[2]);
			}

		
		
	}
	
	
	
	
	
	function product_grid_share_plugin()
		{
			
			?>
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwordpress.org%2Fplugins%2Fproduct-grid%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=652982311485932" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
            
            <br />
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php echo product_grid_share_url; ?>"></div>
            
            <br />
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo product_grid_share_url; ?>" data-text="<?php echo product_grid_plugin_name; ?>" data-via="ParaTheme" data-hashtags="WordPress">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



            <?php
			
			
			
		
		
		}
	
	
	
	
	function product_grid_admin_notices()
		{
			$product_grid_license_key = get_option('product_grid_license_key');
			
			$html= '';
			
			
			
			if(empty($product_grid_license_key))
				{
					$admin_url = get_admin_url();
					
					$html.= '<div class="update-nag">';
					$html.= 'Please activate your license for <b>'.product_grid_plugin_name.' &raquo; <a href="'.$admin_url.'edit.php?post_type=product_grid&page=product_grid_menu_license">License</a></b>';
					$html.= '</div>';	
				}
			else
				{

				}
			
			
			
			
			
			
								
			
			
			echo $html;
		}
	
	add_action('admin_notices', 'product_grid_admin_notices');
		