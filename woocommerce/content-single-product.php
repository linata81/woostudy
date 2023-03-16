<?php
defined( 'ABSPATH' ) || exit;

// объект продукта, который используется для вывода инфы
global $product;
?>

<div class="col-12">
	<?php
	/**
	 * Hook: woocommerce_before_single_product.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );
	?>
</div>

<!-- вывод самой информации о продукте -->
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'col-12 product-card', $product ); ?>>

	<div class="row">
		<div class="col-lg-5 mb-30">
			<!-- slider -->
			<!-- возможный вариант, но тут картинка не меняется у вариативных товаров -->
			<div id="product-carousel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner bg-light">
						
						<?php
							$product_img_id = $product->get_image_id();
							if($product_img_id) {
								$main_img = wp_get_attachment_image_url($product_img_id, 'full');
							} else {
								$main_img = wc_placeholder_img_src('full');
							}
							$product_img_ids = $product->get_gallery_image_ids();
						?>
						<div class="carousel-item active">
								<img class="w-100 h-100" src="<?php echo $main_img ?>" alt="Image">
						</div>
						
						<?php if($product_img_ids): ?>
							<?php foreach($product_img_ids as $product_img_id): ?>
								<div class="carousel-item">
									<img class="w-100 h-100" src="<?php echo wp_get_attachment_image_url($product_img_id, 'full'); ?>" alt="Image">
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
							
					</div>
					
					<?php if($product_img_ids): ?>
						<a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
								<i class="fa fa-2x fa-angle-left text-dark"></i>
						</a>
						<a class="carousel-control-next" href="#product-carousel" data-slide="next">
								<i class="fa fa-2x fa-angle-right text-dark"></i>
						</a>
					<?php endif; ?>
			</div>
		</div>
		
		<div class="col-lg-7 h-auto mb-30">
			<!-- content -->
		</div>
	</div>
	
</div>










<?php
return;



?>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10 (является ли товар распродажей)
	 * @hooked woocommerce_show_product_images - 20 (выводит галерею)
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>


<?php do_action( 'woocommerce_after_single_product' ); ?>
