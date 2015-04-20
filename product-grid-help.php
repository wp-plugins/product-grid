<?php	

	if(empty($_POST['product_grid_hidden']))
		{
			//$product_grid_ribbons = get_option( 'product_grid_ribbons' );
			
			
		}
	else
		{
					
				
		if($_POST['product_grid_hidden'] == 'Y') {
			//Form data sent

			//$product_grid_ribbons = stripslashes_deep($_POST['product_grid_ribbons']);
			//update_option('product_grid_ribbons', $product_grid_ribbons);
			
		
			
					

			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.' ); ?></strong></p></div>

			<?php
		} 
	}
	
	
	
    $product_grid_customer_type = get_option('product_grid_customer_type');
    $product_grid_version = get_option('product_grid_version');
	
	
	
	
	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(product_grid_plugin_name.' Help')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="product_grid_hidden" value="Y">
        <?php settings_fields( 'product_grid_plugin_options' );
				do_settings_sections( 'product_grid_plugin_options' );
			
		?>
        
        
	<div class="para-settings">
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Help & Support</li>

        </ul> <!-- tab-nav end -->
    
		<ul class="box">
            <li style="display: block;" class="box1 tab-box active">
            
				<div class="option-box">
                    <p class="option-title">Need Help ?</p>
                    <p class="option-info">Feel free to contact with any issue for this plugin, Ask any question via forum <a href="<?php echo product_grid_qa_url; ?>"><?php echo product_grid_qa_url; ?></a> <strong style="color:#139b50;">(free)</strong><br />
                    </p>

                </div>
                
				<div class="option-box">
                    <p class="option-title">Upgrade</p>
                    <p class="option-info">
					<?php
                
                    if($product_grid_customer_type=="free")
                        {
                    
                            echo 'You are using <strong> '.$product_grid_customer_type.' version  '.$product_grid_version.'</strong> of <strong>'.product_grid_plugin_name.'</strong>, To get more feature you could try our premium version. ';
                            
                            echo '<br /><a href="'.product_grid_pro_url.'">'.product_grid_pro_url.'</a>';
                            
                        }
                    else
                        {
                    
                            echo 'Thanks for using <strong> premium version  '.$product_grid_version.'</strong> of <strong>'.product_grid_plugin_name.'</strong> ';	
                            
                            
                        }
                    
                     ?>       

                    
                    </p>

                </div>
                
				<div class="option-box">
                    <p class="option-title">Submit Reviews...</p>
                    <p class="option-info">We are working hard to build some awesome plugins for you and spend thousand hour for plugins. we wish your three(3) minute by submitting five star reviews at wordpress.org. if you have any issue please submit at forum.</p>
                	<img class="product_grid-pro-pricing" src="<?php echo product_grid_plugin_url."css/five-star.png";?>" /><br />
                    <a target="_blank" href="<?php echo product_grid_wp_reviews; ?>">
                		<?php echo product_grid_wp_reviews; ?>
               		</a>
                    
                    
                    
                </div>
				<div class="option-box">
                    <p class="option-title">Please Share</p>
                    <p class="option-info">If you like this plugin please share with your social share network.</p>
                    <?php
                    
						echo product_grid_share_plugin();
					?>
                </div>
				
            
            
            </li>  

        </ul>
    
    
    
    </div>    




<p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes' ) ?>" />
                </p>
		</form>


</div>
