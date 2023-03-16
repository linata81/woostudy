<?php


function woostudy_setup() {
  load_theme_textdomain('woostudy', get_template_directory().'/languages'); /* 1-название текстового домена, 2 -где находятся переводы */
  add_theme_support('title-tag');      /* подключаем поддержку title */
  add_theme_support('post-thumbnail'); /* подключаем поддержку миниатюр */
  add_theme_support( 'woocommerce' ); /* подключаем поддержку woocommerce */
  add_theme_support( 'wc-product-gallery-zoom' ); /* подключаем поддержку zoom */
  add_theme_support( 'wc-product-gallery-lightbox' );/* просмотр фото на темном экране */
  add_theme_support( 'wc-product-gallery-slider' );  /* подключаем поддержку слайдера */
  
  /* подключаем меню(их будет несколько) */
  register_nav_menus([
    /* при подключении этого главного меню воспользуемся функциями локализации, чтобы в зависимости от языка меню было переведено*/
    'menu-1'=> __('Top Menu','woostudy'), /* 1арг -текст, кот нужно перевести, 2арг - текстовый домен */
    'menu-2'=> __('Categories Menu','woostudy'),
    'menu-3'=> __('Navbar Menu','woostudy'),
  ]);  
}
add_action( 'after_setup_theme', 'woostudy_setup' );

// сайдбар
function woostudy_widgets_init() {
  register_sidebar([
      'name' => esc_html__('Sidebar', 'woostudy'),
      'id' => 'sidebar-1',
      'description' => esc_html__('Add widgets here.', 'woostudy'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget' => '</section>',
  ]);
}
add_action('widgets_init', 'woostudy_widgets_init');

//делаем, чтобы сторонние шрифты были загружены заранее
add_action('wp_head', function() {
  echo '<link rel="preconnect" href="https://fonts.gstatic.com">';
}, 5);

/* подключаем стили  и скрипты */
function woostudy_scripts(){
  wp_enqueue_style('woostudy-google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap', [], null);
  wp_enqueue_style('woostudy-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css');
  wp_enqueue_style('woostudy-animate', get_template_directory_uri().'/assets/lib/animate/animate.min.css');
  wp_enqueue_style('woostudy-owlcarousel', get_template_directory_uri().'/assets/lib/owlcarousel/assets/owl.carousel.min.css');
  wp_enqueue_style('woostudy-main', get_template_directory_uri().'/assets/css/style.css');
  wp_enqueue_style('woostudy-custom', get_template_directory_uri().'/assets/css/custom.css');
  
  wp_enqueue_script('jquery');
  wp_enqueue_script('woostudy-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js', ['jquery'], false, true);
  wp_enqueue_script('woostudy-easing', get_template_directory_uri().'/assets/lib/easing/easing.min.js', [], false, true);
  wp_enqueue_script('woostudy-owlcarousel', get_template_directory_uri().'/assets/lib/owlcarousel/owl.carousel.min.js', [], false, true);
  wp_enqueue_script('woostudy-main', get_template_directory_uri().'/assets/js/main.js', [], false, true);
}
add_action('wp_enqueue_scripts', 'woostudy_scripts');

/* подключаем файлы из папки inc */
require_once get_template_directory() . '/inc/woocommerce-hooks.php';
require_once get_template_directory() . '/inc/class-woostudy-menu-categories.php';
require_once get_template_directory() . '/inc/class-woostudy-menu-navbar.php';
require_once get_template_directory() . '/inc/cpt.php';

/* функция для удобной распечатки */
function woostudy_debug($data) {
  echo '<pre>' . print_r($data, 1) . '</pre>'; /* 1/true - чтобы перехватить вывод */
}