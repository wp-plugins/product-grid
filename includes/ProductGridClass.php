<?php


class ProductGridClass
	{
		
		public 	$grid_items = array('post_title'=>'Title',
									'content'=>'Content',
									'thumbnail'=>'Thumbnail',
									'meta'=>'Meta',
									'meta_fields'=>'Meta Fields',									
									'social'=>'Social',
									'hover_items'=>'Hover Items',
									'price'=>'Price',
									'add_to_cart'=>'Add to Cart',									
									'star_rate'=>'Star Rate'									
									);
									
		public	$grid_items_properties = array(
												'post_title'=> array('post_title'),
												'content'=> array('body','read_more'),
												'thumbnail'=> array('video','img'),
												'meta'=> array(	'post_date','post_author','terms','comments_count',),				
												'meta_fields'=> '',												
												'social'=> array('facebook','twitter','googleplus'),				
												'hover_items'=> array('zoom','link','social'),
												'price'=>array('sale','regular','full'),
												'add_to_cart'=>array('add_to_cart'),									
												'star_rate'=>array('graphic','text'),
												
												
												);
												
												
												
		public 	$product_grid_items_display = array('post_title'=>'on',
													'content'=>'on',
													'thumbnail'=>'on',
													'meta'=>'on',
													'meta_fields'=>'on',									
													'social'=>'on',
													'hover_items'=>'on',
													'price'=>'on',
													'add_to_cart'=>'on',								
													'star_rate'=>'on',
													);												
												
												
												
												
												
									
									
									
									
	public function settings_grid_get_post_meta($post_id,$meta_key)
				{	
					return get_post_meta( $post_id, $meta_key, true );
				
				}								





	public function product_grid_settings_builder_saved_items()
				{

					global $post;
					$product_grid_items = $this->settings_grid_get_post_meta($post->ID, 'product_grid_items');
					$product_grid_wrapper = $this->settings_grid_get_post_meta($post->ID, 'product_grid_wrapper');
					$product_grid_items_display = $this->settings_grid_get_post_meta($post->ID, 'product_grid_items_display');
					$product_grid_post_meta_fields = $this->settings_grid_get_post_meta($post->ID, 'product_grid_post_meta_fields');					

					
					
					$html = '';
					
					if(empty($product_grid_items))
						{
							$product_grid_items = $this->grid_items;
						}
					
				
					foreach($product_grid_items as $key=>$name)
						{
							
							if(empty($product_grid_wrapper[$key]['start']))
								{
									$product_grid_wrapper[$key]['start'] = '';
								}
							
							if(empty($product_grid_wrapper[$key]['end']))
								{
									$product_grid_wrapper[$key]['end'] = '';
								}
								
								
								
								
					$html .= '<div class="saved-item" data-class="saved-item" id="'.$key.'"><div class="header">'.$name;
					if(!empty($product_grid_items_display[$key]))
						{
					$html .= '<span class="input-switch"><input checked type="checkbox" id="switch-'.$key.'" name="product_grid_items_display['.$key.']" class="switch" />
	<label title="Display on grid ?" for="switch-'.$key.'">&nbsp;</label>
</span>';

						}
					else
						{
					$html .= '<span class="input-switch"><input type="checkbox" id="switch-'.$key.'" name="product_grid_items_display['.$key.']" class="switch" />
	<label title="Display on grid ?" for="switch-'.$key.'">&nbsp;</label>
</span>';
						}

					$html .= '<span class="remove">X</span>';
					
					$html .= '</div>';
							
					$html .= '<input type="hidden" name="product_grid_items['.$key.']" value="'.$name.'" />';							
					$html .= '<div class="options">';
					$html .= '<b>'.$name.'</b> wrapper <input placeholder="<div>" type="text" name="product_grid_wrapper['.$key.'][start]" value="'.htmlentities($product_grid_wrapper[$key]['start'],ENT_QUOTES).'" /> <b>'.$name.'</b> goes here <input placeholder="</div>"  type="text" name="product_grid_wrapper['.$key.'][end]" value="'.htmlentities($product_grid_wrapper[$key]['end'],ENT_QUOTES).'" />';
					
					if($key =='meta_fields')
						{
							$html .= '<div class="options-meta_fields"><br /> <br />';
							$html .= 'Custom Meta Fields. comma separated, no blank space.';
							
							$html .= '<input style="width:80%" type="text" placeholder="post_view_count,post_share_count" name="product_grid_post_meta_fields" value="'.$product_grid_post_meta_fields.'" />';	
							$html .= '</div>';
						}

					
						
					$html .= '</div>';									
					$html .= '</div>';
					
	
								
						}
					return $html;
				}


	public function product_grid_settings_builder_items()
				{	
					global $post;
					$grid_items = $this->grid_items;
					$product_grid_wrapper = $this->settings_grid_get_post_meta($post->ID, 'product_grid_wrapper');
					$product_grid_items_display = $this->settings_grid_get_post_meta($post->ID, 'product_grid_items_display');
					$html = '';
				
				
					foreach($grid_items as $key=>$name)
						{
							
							if(empty($product_grid_wrapper[$key]['start']))
								{
									$product_grid_wrapper[$key]['start'] = '';
								}
							
							if(empty($product_grid_wrapper[$key]['end']))
								{
									$product_grid_wrapper[$key]['end'] = '';
								}
								
					$html .= '<div title="'.$name.'" class="item draggable" id="'.$key.'">'.$name;
					
																						
								
							$html .= '</div>';
					
	
								
						}
					return $html;
				}


			
	public function settings_grid_items()
				{
					global $post;
									
					$html = '';
					$html .= '<div class="product-grid-builder">';	
					$html .= '<div  class="items" id="items">';	
					$html .= '<p><b>Grid Items</b></p>';
					$html .= '<p>Post Grid items drag on <b>Grid Layout</b> to build your own layout.</p>';
					
					$html .= $this->product_grid_settings_builder_items();
					$html .= '</div>';
					$html .= '<div id="canvas" class="canvas droppable" >';	
					$html .= '<p><b>Grid Layout</b></p>';
					$html .= '<p>Drag-drop items to re-order. multiple items not supported for each. for example you can\'t add two "Title" on layout.</p>';
					$html .= '<div class="items-container sortable" >';	
					$html .= $this->product_grid_settings_builder_saved_items();
					$html .= '</div></div>';
					
					$html .= '</div>';						
									
									
					return $html;
				}
	
	
	public function product_grid_content()
				{
					
				}
		
	
	}