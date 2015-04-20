jQuery(document).ready(function($)
	{


		
		$(document).on('click', '.product-grid-reset-taxonomy', function()
			{
				$('.product_grid_taxonomy_category').prop('checked', false);
				$('.product_grid_taxonomy').prop('checked', false);
				
				
			})

		
		
		
		$(document).on('click', '.product_grid_content_source', function()
			{	
				var source = $(this).val();
				var source_id = $(this).attr("id");
				
				$(".content-source-box.active").removeClass("active");
				$(".content-source-box."+source_id).addClass("active");
				
			})
		
		
		
	
		
		
		
		
		$(".product_grid_taxonomy").click(function()
			{
				


				var taxonomy = jQuery(this).val();
				
				jQuery(".product_grid_loading_taxonomy_category").css('display','block');

						jQuery.ajax(
							{
						type: 'POST',
						url: product_grid_ajax.product_grid_ajaxurl,
						data: {"action": "product_grid_get_taxonomy_category","taxonomy":taxonomy},
						success: function(data)
								{	
									jQuery(".product_grid_taxonomy_category").html(data);
									jQuery(".product_grid_loading_taxonomy_category").fadeOut('slow');
								}
							});

		
			})
		
		
		

		$(document).on('click', '.product-grid-builder .canvas .remove', function()
			{
				$(this).parent().parent().remove();
				
			})






		$(document).on('click', '.product-grid-builder .canvas .header', function()
			{
				
				if($(this).parent().hasClass('active'))
					{
						$(this).parent().removeClass('active');
					}
				else
					{
						$(this).parent().addClass('active');
					}
				
			})




	});	







