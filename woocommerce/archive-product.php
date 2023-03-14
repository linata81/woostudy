<?php get_header( 'shop' ); ?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
	<div class="row px-xl-5">
			<div class="col-12">
				<?php woocommerce_breadcrumb(); ?>
			</div>
	</div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="container-fluid">
	<div class="row px-xl-5">
		
	<?php do_action( 'woocommerce_sidebar' ); ?>
	
	<?php do_action( 'woocommerce_before_main_content' ); ?>
		
		<div class="col-12">
			<header class="woocommerce-products-header">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="woocommerce-products-header__title page-title section-title position-relative text-uppercase mb-3">
						<span class="bg-secondary pr-3"><?php woocommerce_page_title(); ?></span>					
					</h1>
				<?php endif; ?>

				<?php	do_action( 'woocommerce_archive_description' );?>
			</header>
		</div>
		
		<!--вывод товара----->
		<?php
			if ( woocommerce_product_loop() ) { ?>

				<div class="col-12">
					<div class="d-flex align-items-center justify-content-between mb-4">
						<?php do_action( 'woocommerce_before_shop_loop' ); ?>						
					</div>
				</div>
				
				<?php
				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				do_action( 'woocommerce_after_shop_loop' );
			} else {

				do_action( 'woocommerce_no_products_found' );
			}
		?>

	
	<?php do_action( 'woocommerce_after_main_content' ); ?>
			
	</div><!-- ./row px-xl-5 -->
</div><!-- ./container-fluid-->



<?php get_footer( 'shop' );  ?>


<!-- ++++++++++++++++++++ шаблон woocommerce +++++++++++++++++++++++++++ -->
<?php
return;
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit; //стандартная проверка для работы с файлами плагина (в шаблонах темы не принято использовать)

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );    //начало обертки контента

// ------------выводится название магазина
?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
	<?php woocommerce_output_all_notices(); ?>
</header>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10     выводятся уведомления
	 * @hooked woocommerce_result_count - 20           количество отображения
	 * @hooked woocommerce_catalog_ordering - 30       сортировка
	 */
	do_action( 'woocommerce_before_shop_loop' );

	
	// ----------------цикл с выводом товара
	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10   пагинация
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' ); //если не найдены товары
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)  конеу обертки
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10 подключение сайдбара
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' ); //подключение футера с параметром 'shop' - это значит, что первым ищется файл shop-footer.php, затем footer
