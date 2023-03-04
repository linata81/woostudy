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