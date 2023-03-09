<?php
  
add_action( 'init', 'woostudy_slider' );

function woostudy_slider() {
    
    register_post_type( 'slider', array( // регистрируем кастомный тип поста
      'labels'       => array(
        'name'          => __( 'Slider', 'woostudy' ),
        'singular_name' => __( 'Slider', 'woostudy' ),
        'add_new'       => __( 'Add new slide', 'woostudy' ),
        'add_new_item'  => __( 'New slide', 'woostudy' ),
        'edit_item'     => __( 'Edit', 'woostudy' ),
        'new_item'      => __( 'New slide', 'woostudy' ),
        'view_item'     => __( 'View', 'woostudy' ),
        'menu_name'     => __( 'Slider', 'woostudy' ),
        'all_items'     => __( 'All slides', 'woostudy' ),
      ),
      'public'       => true,
      'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
      'menu_icon'    => 'dashicons-format-gallery',
      'show_in_rest' => true, //false - доступен стандартный  редактор wp, true- блочный редактор гутенберг
    ) );
  }
  
