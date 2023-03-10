<?php
/* отключили стили woocommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/* список категорий товаров */
remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);

add_action('woocommerce_shop_loop_subcategory_title', function($category) {
  // woostudy_debug($category);
  echo '<h6>'. esc_html($category->name).'</h6>';  /* выводим название категории */
  echo '<small class="text-body">'.$category->count. __(' Products', 'woostudy').'</small>'; 
});

// Ссылка на товар в карточке товара
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);


// Удаляем название товара woo в карточке и добавляем свой
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', function() {
  // получим данные из глобального объекта 
  //https://woocommerce.github.io/code-reference/classes/WC-Product.html
  global $product;
  /** @var WC_Product $product */
  echo '<a class="h6 text-decoration-none text-truncate" href="'. $product->get_permalink() .'">'. $product->get_title() .'</a>';
});

// Рейтинг товара в карточке товара
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

//Обновление мини-корзины(счетчика)
add_filter('woocommerce_add_to_cart_fragments', function( $fragments ) {
  //$fragments['.mini-cart-cnt'] = '<span class="badge text-dark border border-dark rounded-circle mini-cart-cnt">'. count(WC()->cart->get_cart()) .'</span>';
  $fragments['.mini-cart-cnt'] = '<span class="badge text-dark border border-dark rounded-circle mini-cart-cnt">'. WC()->cart->get_cart_contents_count() .'</span>';
  return $fragments;
});

//Хлебные крошки
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_filter( 'woocommerce_breadcrumb_defaults', function() {
	return array(
		'delimiter'   => '&nbsp;/&nbsp;', //разделитель
		'wrap_before' => '<nav class="breadcrumb bg-light mb-30">', //обертка
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
		'home'        => __( 'Home', 'woostudy' ),
	);
} );