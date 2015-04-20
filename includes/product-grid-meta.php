<?php


function product_grid_posttype_register() {
 
        $labels = array(
                'name' => _x('Product Grid', 'product_grid'),
                'singular_name' => _x('Product Grid', 'product_grid'),
                'add_new' => _x('New Product Grid', 'product_grid'),
                'add_new_item' => __('New Product Grid'),
                'edit_item' => __('Edit Product Grid'),
                'new_item' => __('New Product Grid'),
                'view_item' => __('View Product Grid'),
                'search_items' => __('Search Product Grid'),
                'not_found' =>  __('Nothing found'),
                'not_found_in_trash' => __('Nothing found in Trash'),
                'parent_item_colon' => ''
        );
 
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => null,
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title'),
				'menu_icon' => 'dashicons-media-spreadsheet',
				
          );
 
        register_post_type( 'product_grid' , $args );

}

add_action('init', 'product_grid_posttype_register');





/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function meta_boxes_product_grid()
	{
		$screens = array( 'product_grid' );
		foreach ( $screens as $screen )
			{
				add_meta_box('product_grid_metabox',__( 'Product Grid Options','product_grid' ),'meta_boxes_product_grid_input', $screen);
			}
	}
add_action( 'add_meta_boxes', 'meta_boxes_product_grid' );


function meta_boxes_product_grid_input( $post ) {
	
	global $post;
	wp_nonce_field( 'meta_boxes_product_grid_input', 'meta_boxes_product_grid_input_nonce' );
	
	
	$product_grid_post_per_page = get_post_meta( $post->ID, 'product_grid_post_per_page', true );
	$product_grid_themes = get_post_meta( $post->ID, 'product_grid_themes', true );
	$product_grid_masonry_enable = get_post_meta( $post->ID, 'product_grid_masonry_enable', true );	
	
	$product_grid_bg_img = get_post_meta( $post->ID, 'product_grid_bg_img', true );	
	$product_grid_thumb_size = get_post_meta( $post->ID, 'product_grid_thumb_size', true );	
	$product_grid_empty_thumb = get_post_meta( $post->ID, 'product_grid_empty_thumb', true );
	
	$product_grid_pagination_display = get_post_meta( $post->ID, 'product_grid_pagination_display', true );		

	$product_grid_excerpt_count = get_post_meta( $post->ID, 'product_grid_excerpt_count', true );	
	$product_grid_read_more_text = get_post_meta( $post->ID, 'product_grid_read_more_text', true );			
	
	$product_grid_query_order = get_post_meta( $post->ID, 'product_grid_query_order', true );	
	$product_grid_query_orderby = get_post_meta( $post->ID, 'product_grid_query_orderby', true );			
	$product_grid_taxonomy = get_post_meta( $post->ID, 'product_grid_taxonomy', true );	
	$product_grid_taxonomy_category = get_post_meta( $post->ID, 'product_grid_taxonomy_category', true );		
	
	$product_grid_items_width = get_post_meta( $post->ID, 'product_grid_items_width', true );		
	$product_grid_thumb_height = get_post_meta( $post->ID, 'product_grid_thumb_height', true );	
	
	$product_grid_meta_author_display = get_post_meta( $post->ID, 'product_grid_meta_author_display', true );	
	$product_grid_meta_date_display = get_post_meta( $post->ID, 'product_grid_meta_date_display', true );		
	$product_grid_meta_categories_display = get_post_meta( $post->ID, 'product_grid_meta_categories_display', true );	
	$product_grid_meta_tags_display = get_post_meta( $post->ID, 'product_grid_meta_tags_display', true );		
	$product_grid_meta_comments_display = get_post_meta( $post->ID, 'product_grid_meta_comments_display', true );
	
	
	$product_grid_items = get_post_meta( $post->ID, 'product_grid_items', true );		
	$product_grid_wrapper = get_post_meta( $post->ID, 'product_grid_wrapper', true );	
	$product_grid_items_display = get_post_meta( $post->ID, 'product_grid_items_display', true );			
	$product_grid_post_meta_fields = get_post_meta( $post->ID, 'product_grid_post_meta_fields', true );	


	$product_grid_posttype = 'product';






?>

    <div class="para-settings product-grid-settings">
        <div class="option-box">
            <p class="option-title">Shortcode</p>
            <p class="option-info">Copy this shortcode and paste on page or post where you want to display post grid. <br />Use PHP code to your themes file to display post grid.</p>
			<textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" >[product_grid <?php echo ' id="'.$post->ID.'"';?> ]</textarea>
        <br /><br />
        PHP Code:<br />
        <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[product_grid id='; echo "'".$post->ID."' ]"; echo '"); ?>'; ?></textarea>  
		</div>


        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Options</li>
            <li nav="2" class="nav2">Style</li>
            <li nav="3" class="nav3">Content</li>
            <li nav="4" class="nav4">Grid Builder</li>            
        </ul> <!-- tab-nav end -->
        
		<ul class="box">
            <li style="display: block;" class="box1 tab-box active">
				<div class="option-box">
                    <p class="option-title">Grid Post per page</p>
                    <p class="option-info"></p>
					<input type="text" size="5"  name="product_grid_post_per_page" value="<?php if(!empty($product_grid_post_per_page))echo $product_grid_post_per_page; else echo 10; ?>" />                   
                </div>
                
				<div class="option-box">
                    <p class="option-title">Grid items width</p>
                    <p class="option-info">Value with px, or %</p>
					<input type="text" placeholder="ex: 250px" size="10"  name="product_grid_items_width" value="<?php if(!empty($product_grid_items_width))echo $product_grid_items_width; ?>" />                   
                </div>  
                
				     
                
				<div class="option-box">
                    <p class="option-title">Grid thumbnail height</p>
                    <p class="option-info">Value with px</p>
					<input type="text" placeholder="ex: 150px" size="10"  name="product_grid_thumb_height" value="<?php if(!empty($product_grid_thumb_height)) echo $product_grid_thumb_height; ?>" />                   
                </div>
                
                
				<div class="option-box">
                    <p class="option-title">Display Pagination</p>
                    <p class="option-info"></p>
                    
					<select name="product_grid_pagination_display"  >
                    <option value="yes" <?php if($product_grid_pagination_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($product_grid_pagination_display=="no")echo "selected"; ?>>No</option>                  
                    </select>
                  
                </div>                
                
                
                
                
                
                
               
            </li>
            <li style="display: none;" class="box2 tab-box ">
				<div class="option-box">
                    <p class="option-title">Themes</p>
                    <p class="option-info"></p>
					<select name="product_grid_themes"  >
                    <option value="flat" <?php if($product_grid_themes=="flat")echo "selected"; ?>>Flat</option>
              
                    </select>                 
                </div>
                
                
				<div class="option-box">
                    <p class="option-title">Active Masonry Grid</p>
                    <p class="option-info">Masonry Style grid.</p>
                    <select name="product_grid_masonry_enable"  >
                    <option  value="no" <?php if($product_grid_masonry_enable=="no")echo "selected"; ?>>No</option>
                    <option  value="yes" <?php if($product_grid_masonry_enable=="yes")echo "selected"; ?>>Yes</option>
             
                    </select>                 
                </div>                
                
                
                
                
                
                
                
                
                
				<div class="option-box">
                    <p class="option-title"><?php _e('Background Image.','product_grid'); ?></p>
                    <p class="option-info"><?php _e('Background image for post grid area.','product_grid'); ?></p>
                                           
            <script>
            jQuery(document).ready(function(jQuery)
                {
                        jQuery(".product_grid_bg_img_list li").click(function()
                            { 	
                                jQuery('.product_grid_bg_img_list li.bg-selected').removeClass('bg-selected');
                                jQuery(this).addClass('bg-selected');
                                
                                var product_grid_bg_img = jQuery(this).attr('data-url');
            
                                jQuery('#product_grid_bg_img').val(product_grid_bg_img);
                                
                            })	
            
                                
                })
            
            </script> 
                    
            
            <?php
            
            
            
                $dir_path = product_grid_plugin_dir."css/bg/";
                $filenames=glob($dir_path."*.png*");
            
            
                $product_grid_bg_img = get_post_meta( $post->ID, 'product_grid_bg_img', true );
                
                if(empty($product_grid_bg_img))
                    {
                    $product_grid_bg_img = "";
                    }
            
            
                $count=count($filenames);
                
            
                $i=0;
                echo "<ul class='product_grid_bg_img_list' >";
            
                while($i<$count)
                    {
                        $filelink= str_replace($dir_path,"",$filenames[$i]);
                        
                        $filelink= product_grid_plugin_url."css/bg/".$filelink;
                        
                        
                        if($product_grid_bg_img==$filelink)
                            {
                                echo '<li  class="bg-selected" data-url="'.$filelink.'">';
                            }
                        else
                            {
                                echo '<li   data-url="'.$filelink.'">';
                            }
                        
                        
                        echo "<img  width='70px' height='50px' src='".$filelink."' />";
                        echo "</li>";
                        $i++;
                    }
                    
                echo "</ul>";
                
                echo "<input style='width:100%;' value='".$product_grid_bg_img."'    placeholder='Please select image or left blank' id='product_grid_bg_img' name='product_grid_bg_img'  type='text' />";
            
            
            
            ?>
				</div> 
                
                
				<div class="option-box">
                    <p class="option-title"><?php _e('Thumbnail Size.','product_grid'); ?></p>
                    <p class="option-info"><?php _e('Thumbnail size of member on grid.','product_grid'); ?></p>
                    <select name="product_grid_thumb_size" >
                    <option value="none" <?php if($product_grid_thumb_size=="none") echo "selected"; ?>>None</option>
                    <option value="thumbnail" <?php if($product_grid_thumb_size=="thumbnail") echo "selected"; ?>>Thumbnail</option>
                    <option value="medium" <?php if($product_grid_thumb_size=="medium") echo "selected"; ?>>Medium</option>
                    <option value="large" <?php if($product_grid_thumb_size=="large") echo "selected"; ?>>Large</option>                               
                    <option value="full" <?php if($product_grid_thumb_size=="full") echo "selected"; ?>>Full</option>   

                    </select>
                </div>  
                
				<div class="option-box">
                    <p class="option-title">Empty Thumbnail</p>
                    <p class="option-info"></p>
					<input type="text" name="product_grid_empty_thumb" id="product_grid_empty_thumb" value="<?php if(!empty($product_grid_empty_thumb)) echo $product_grid_empty_thumb; ?>" /><br />
                    <input id="product_grid_empty_thumb_upload" class="product_grid_empty_thumb_upload button" type="button" value="Upload Image" />
                       <br />
                       
                       
                        <?php
                        	if(empty($product_grid_empty_thumb))
								{
								?>
                                <img class="product_grid_empty_thumb_display" width="300px" src="<?php echo product_grid_plugin_url.'css/no-thumb.png'; ?>" />
                                <?php
								}
							else
								{
								?>
                                <img class="product_grid_empty_thumb_display" width="300px" src="<?php echo $product_grid_empty_thumb; ?>" />
                                <?php
								}
						?>
                       
                       
                       
                       
                       
					<script>
                        jQuery(document).ready(function($){

                            var custom_uploader; 
                         
                            jQuery('#product_grid_empty_thumb_upload').click(function(e) {
													
                                e.preventDefault();
                         
                                //If the uploader object has already been created, reopen the dialog
                                if (custom_uploader) {
                                    custom_uploader.open();
                                    return;
                                }
                        
                                //Extend the wp.media object
                                custom_uploader = wp.media.frames.file_frame = wp.media({
                                    title: 'Choose Image',
                                    button: {
                                        text: 'Choose Image'
                                    },
                                    multiple: false
                                });
                        
                                //When a file is selected, grab the URL and set it as the text field's value
                                custom_uploader.on('select', function() {
                                    attachment = custom_uploader.state().get('selection').first().toJSON();
                                    jQuery('#product_grid_empty_thumb').val(attachment.url);
                                    jQuery('.product_grid_empty_thumb_display').attr('src',attachment.url);									
                                });
                         
                                //Open the uploader dialog
                                custom_uploader.open();
                         
                            });
                            
                            
                        })
                    </script>      
                </div>

                
                
				<div class="option-box">
                    <p class="option-title">Display Author</p>
                    <p class="option-info"></p>
					<select name="product_grid_meta_author_display"  >
                    <option value="yes" <?php if($product_grid_meta_author_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($product_grid_meta_author_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div> 
                
				<div class="option-box">
                    <p class="option-title">Display Date</p>
                    <p class="option-info"></p>
					<select name="product_grid_meta_date_display"  >
                    <option value="yes" <?php if($product_grid_meta_date_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($product_grid_meta_date_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div>
                
				<div class="option-box">
                    <p class="option-title">Display Categories</p>
                    <p class="option-info"></p>
					<select name="product_grid_meta_categories_display"  >
                    <option value="yes" <?php if($product_grid_meta_categories_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($product_grid_meta_categories_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div>
                
				<div class="option-box">
                    <p class="option-title">Display Tags</p>
                    <p class="option-info"></p>
					<select name="product_grid_meta_tags_display"  >
                    <option value="yes" <?php if($product_grid_meta_tags_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($product_grid_meta_tags_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div>
                
                
				<div class="option-box">
                    <p class="option-title">Display Comments Counts</p>
                    <p class="option-info"></p>
					<select name="product_grid_meta_comments_display"  >
                    <option value="yes" <?php if($product_grid_meta_comments_display=="yes")echo "selected"; ?>>Yes</option>
                    <option value="no" <?php if($product_grid_meta_comments_display=="no")echo "selected"; ?>>No</option>                  
                    </select>            
                </div>                          
                               
                                 
                

            </li>
            <li style="display: none;" class="box3 tab-box ">
				
                
				<div class="option-box">
                    <p class="option-title">Content excerpt count</p>
                    <p class="option-info"></p>
					<input type="text" placeholder="30" name="product_grid_excerpt_count" value="<?php if(!empty($product_grid_excerpt_count)) echo $product_grid_excerpt_count; ?>" /><br />                       
                    
                    <p class="option-title">Read more Text</p>
                    <p class="option-info"></p>
					<input type="text" placeholder="Read More" name="product_grid_read_more_text" value="<?php if(!empty($product_grid_read_more_text)) echo $product_grid_read_more_text; else echo 'Read More'; ?>" /><br />                   
                </div> 
                
                
                
				<div class="option-box">
                    <p class="option-title"><?php _e('Post query order','product_grid'); ?></p>
                    <p class="option-info"></p>
                    <select name="product_grid_query_order" >
                    <option value="ASC" <?php if($product_grid_query_order=="ASC") echo "selected"; ?>>ASC</option>
                    <option value="DESC" <?php if($product_grid_query_order=="DESC") echo "selected"; ?>>DESC</option>

                    </select>
                </div>
                
				<div class="option-box">
                    <p class="option-title"><?php _e('Post query orderby','product_grid'); ?></p>
                    <p class="option-info"></p>
                    <select name="product_grid_query_orderby" >
                    <option value="none" <?php if($product_grid_query_orderby=="none") echo "selected"; ?>>None</option>
                    <option value="ID" <?php if($product_grid_query_orderby=="ID") echo "selected"; ?>>ID</option>
                    <option value="date" <?php if($product_grid_query_orderby=="date") echo "selected"; ?>>Date</option>
                    <option value="rand" <?php if($product_grid_query_orderby=="rand") echo "selected"; ?>>Rand</option>                    <option value="comment_count" <?php if($product_grid_query_orderby=="comment_count") echo "selected"; ?>>Comment Count</option>                    
                    
                    <option value="author" <?php if($product_grid_query_orderby=="author") echo "selected"; ?>>Author</option>                                       
                    <option value="title" <?php if($product_grid_query_orderby=="title") echo "selected"; ?>>Title</option>
                    <option value="name" <?php if($product_grid_query_orderby=="name") echo "selected"; ?>>Name</option>                    <option value="type" <?php if($product_grid_query_orderby=="type") echo "selected"; ?>>Type</option>      
                    
                    
               

                    </select>
                </div>                
                
                

				<div class="option-box">
                    <p class="option-title"><?php _e('Taxonomy & Catgory','product_grid'); ?></p>
                    <p class="option-info"></p>
                    <div class="product-grid-reset-taxonomy button">Reset Taxonomy</div>
					<table style="width:100%;" >
            
                        <tr style="overflow:scroll; vertical-align:top;">
                            <td style="overflow:scroll; vertical-align:top; padding:0; width:45%;">
                             
                            
                             
            <?php 
            $product_grid_taxonomies = get_object_taxonomies( $product_grid_posttype ); 
            if(!empty($product_grid_taxonomies))
                {
                    foreach ($product_grid_taxonomies as $taxonomy ) {
                        ?>
                    
                        
                      <label ><input type="radio" class="product_grid_taxonomy" name="product_grid_taxonomy" value="<?php echo $taxonomy; ?>" <?php if($product_grid_taxonomy==$taxonomy)  echo "checked";?> /><?php echo $taxonomy; ?></label><br />
                      
                      <?php
                    }
                }
            else
                {
					if(empty($product_grid_posttype))
						{
							echo 'Please choose at least one post type and update settings.';
						}
					else
						{
							echo 'No Taxomony found for ';
							echo '<strong>'.implode(', ', $product_grid_posttype).'</strong>';
						}

                }
            
            ?>
                            
                            </td>
                            <td style=" height:auto;vertical-align:top; padding:0; width:45%;">
                            <span class="product_grid_loading_taxonomy_category" ></span>
                            <div class="product_grid_taxonomy_category">
                            
                            <?php
                            if(!empty($product_grid_taxonomy))
                                {
                                product_grid_get_taxonomy_category($post->ID);
                                }
                            else
                                {
                                
                                }
                            
                            ?>
                            
                            
                            </div>
                            
                            </td>
                        </tr>
             
                        
            </table>
                </div>
                 
            </li>
            <li style="display: none;" class="box4 tab-box ">
            
				<div class="option-box">
                    <p class="option-title">Grid Builder</p>
                    <p class="option-info"></p>
                    
                   
                    <?php
                    		$Postgridbuilder = new ProductGridClass();
							echo $Postgridbuilder->settings_grid_items();
					
					?>
                    

 <script>
 jQuery(document).ready(function($)
	{
jQuery(function() {
$( ".items-container" ).sortable();
//$( ".items-container" ).disableSelection();
});

})

</script>        
                    
<script>
jQuery(document).ready(function($)
	{
		$( ".draggable" ).draggable();
        $( ".droppable, #droppable-inner" ).droppable({
            activeClass: "ui-state-hover",
            hoverClass: "ui-state-active",
            drop: function( event, ui ) {
				
				var drop_item_id = ui.draggable.attr('id');
				var drop_item_data_class = ui.draggable.attr('data-class');				
				var drop_item_title = ui.draggable.attr('title');
				
				if(drop_item_data_class == 'saved-item')
					{
					
					}
				else
					{
				
						//alert(ui.draggable.attr('id') + ' was dropped from ' + ui.draggable.parent().attr('id'));
						$( this ).addClass( "ui-state-highlight" );
						
						// Move the dragged element into its new container
						ui.draggable.attr('style','position:relative');
						
						
						var content = '<div id="'+drop_item_id+'" data-class="saved-item" class="saved-item draggable ui-draggable ui-draggable-handle ui-sortable-handle" style="position:relative"><div class="header">'+drop_item_title+'<span class="input-switch"><input id="switch-'+drop_item_id+'" class="switch" type="checkbox" name="product_grid_items_display['+drop_item_id+']">&nbsp;<label for="switch-'+drop_item_id+'" title="Display on grid ?">&nbsp;</label></span><span class="remove">X</span><input type="hidden" name="product_grid_items['+drop_item_id+']" value="'+drop_item_title+'" /></div><div class="options"><b>'+drop_item_title+'</b> wrapper <input placeholder="<div>" type="text" name="product_grid_wrapper['+drop_item_id+'][start]" value="" /><b>'+drop_item_title+'</b> goes here <input placeholder="</div>"  type="text" name="product_grid_wrapper['+drop_item_id+'][end]" value="" /></div></div>';
						
						
						$(this).children('.items-container').append(content);
					}
				

                
                return false;
            }            
        });
	})
</script>
                    
                    
                    
                    
                    
                </div> 
            </li>
        </ul>

    
    </div>
    
    
    
    

    
    
    
<?php


	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function meta_boxes_product_grid_save( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['meta_boxes_product_grid_input_nonce'] ) )
    return $post_id;

  $nonce = $_POST['meta_boxes_product_grid_input_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'meta_boxes_product_grid_input' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;



  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
	$product_grid_post_per_page = sanitize_text_field( $_POST['product_grid_post_per_page'] );	
	$product_grid_themes = sanitize_text_field( $_POST['product_grid_themes'] );
	$product_grid_masonry_enable = sanitize_text_field( $_POST['product_grid_masonry_enable'] );	
	
	$product_grid_bg_img = sanitize_text_field( $_POST['product_grid_bg_img'] );	
	
	$product_grid_thumb_size = sanitize_text_field( $_POST['product_grid_thumb_size'] );	
	$product_grid_empty_thumb = sanitize_text_field( $_POST['product_grid_empty_thumb'] );	
	
	$product_grid_pagination_display = sanitize_text_field( $_POST['product_grid_pagination_display'] );		
		

	$product_grid_excerpt_count = sanitize_text_field( $_POST['product_grid_excerpt_count'] );	
	$product_grid_read_more_text = sanitize_text_field( $_POST['product_grid_read_more_text'] );		
			
	$product_grid_query_order = sanitize_text_field( $_POST['product_grid_query_order'] );
	$product_grid_query_orderby = sanitize_text_field( $_POST['product_grid_query_orderby'] );
	

		
		
	
	
	if(empty($_POST['product_grid_taxonomy']))
		{
			$_POST['product_grid_taxonomy'] = '';
		}
	if(empty($_POST['product_grid_taxonomy_category']))
		{
			$_POST['product_grid_taxonomy_category'] = '';
		}	
	
	
	$product_grid_taxonomy = sanitize_text_field( $_POST['product_grid_taxonomy'] );
	$product_grid_taxonomy_category = stripslashes_deep( $_POST['product_grid_taxonomy_category'] );	
		
	$product_grid_items_width = sanitize_text_field( $_POST['product_grid_items_width'] );		

	$product_grid_thumb_height = sanitize_text_field( $_POST['product_grid_thumb_height'] );	
	
	$product_grid_meta_author_display = sanitize_text_field( $_POST['product_grid_meta_author_display'] );	
	$product_grid_meta_date_display = sanitize_text_field( $_POST['product_grid_meta_date_display'] );
	$product_grid_meta_categories_display = sanitize_text_field( $_POST['product_grid_meta_categories_display'] );	
	$product_grid_meta_tags_display = sanitize_text_field( $_POST['product_grid_meta_tags_display'] );	
	$product_grid_meta_comments_display = sanitize_text_field( $_POST['product_grid_meta_comments_display'] );		
	
	
	$product_grid_items = stripslashes_deep( $_POST['product_grid_items'] );	
	$product_grid_wrapper = stripslashes_deep( $_POST['product_grid_wrapper'] );
	$product_grid_items_display = stripslashes_deep( $_POST['product_grid_items_display'] );
	
	if(empty($_POST['product_grid_post_meta_fields']))
		{
			$_POST['product_grid_post_meta_fields'] = '';
		}		
	$product_grid_post_meta_fields = sanitize_text_field( $_POST['product_grid_post_meta_fields'] );	

  // Update the meta field in the database.
	update_post_meta( $post_id, 'product_grid_post_per_page', $product_grid_post_per_page );	
	update_post_meta( $post_id, 'product_grid_themes', $product_grid_themes );
	update_post_meta( $post_id, 'product_grid_masonry_enable', $product_grid_masonry_enable );	
	
	update_post_meta( $post_id, 'product_grid_bg_img', $product_grid_bg_img );	
	
	update_post_meta( $post_id, 'product_grid_thumb_size', $product_grid_thumb_size );	
	update_post_meta( $post_id, 'product_grid_empty_thumb', $product_grid_empty_thumb );		
	update_post_meta( $post_id, 'product_grid_pagination_display', $product_grid_pagination_display );		

	update_post_meta( $post_id, 'product_grid_excerpt_count', $product_grid_excerpt_count );	
	update_post_meta( $post_id, 'product_grid_read_more_text', $product_grid_read_more_text );			
	
	update_post_meta( $post_id, 'product_grid_query_order', $product_grid_query_order );
	update_post_meta( $post_id, 'product_grid_query_orderby', $product_grid_query_orderby );	
	update_post_meta( $post_id, 'product_grid_taxonomy', $product_grid_taxonomy );
	update_post_meta( $post_id, 'product_grid_taxonomy_category', $product_grid_taxonomy_category );		
	
	update_post_meta( $post_id, 'product_grid_items_width', $product_grid_items_width );	
	//update_post_meta( $post_id, 'product_grid_thumb_width', $product_grid_thumb_width );
	update_post_meta( $post_id, 'product_grid_thumb_height', $product_grid_thumb_height );
	
	update_post_meta( $post_id, 'product_grid_meta_author_display', $product_grid_meta_author_display );		
	update_post_meta( $post_id, 'product_grid_meta_date_display', $product_grid_meta_date_display );	
	update_post_meta( $post_id, 'product_grid_meta_categories_display', $product_grid_meta_categories_display );		
	update_post_meta( $post_id, 'product_grid_meta_tags_display', $product_grid_meta_tags_display );
	update_post_meta( $post_id, 'product_grid_meta_comments_display', $product_grid_meta_comments_display );	
	
	
	update_post_meta( $post_id, 'product_grid_items', $product_grid_items );	
	update_post_meta( $post_id, 'product_grid_wrapper', $product_grid_wrapper );
	update_post_meta( $post_id, 'product_grid_items_display', $product_grid_items_display );	
	update_post_meta( $post_id, 'product_grid_post_meta_fields', $product_grid_post_meta_fields );	
}
add_action( 'save_post', 'meta_boxes_product_grid_save' );






?>