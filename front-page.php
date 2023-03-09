<?php get_header(); ?>

<!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            
            <?php
            global $post;
            $slider = get_posts([
                'post_type' => 'slider',
            ]);
            // woostudy_debug($slider);
            ?>
        
            <div class="col-lg-8">
                <?php if($slider): ?>
                    <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php for($i=0; $i < count($slider); $i++): ?>
                                <li data-target="#header-carousel" data-slide-to="<?php echo $i; ?>" <?php if($i == 0) : ?> class="active"><?php endif; ?></li>
                            <?php endfor; ?>
                        </ol>
                        <div class="carousel-inner">
                            <!--заполняем глоб.переменную $post с помощью функции wp setup_postdata данными поста-->
                            <?php $i = 0; foreach($slider as $post): setup_postdata($post); ?> 
                            <!-- после того, как заполнили переменную $post становятся доступны стандартные ф-ции wp, н/р the_title()? -->
                                <div class="carousel-item position-relative <?php if($i == 0): ?>active<?php endif; ?>" style="height: 430px;">
                                    <!-- выводим динамически url картинки -->
                                    <img class="position-absolute w-100 h-100" src="<?php the_post_thumbnail_url('full'); ?>" style="object-fit: cover;">
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown"><?php the_title(); ?></h1>
                                            <p class="mx-md-5 px-5 animate__animated animate__bounceIn"><?php the_excerpt(); ?></p>
                                            <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="<?php the_permalink(); ?>"><?php echo __('Shop Now', 'woostudy') ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p><?php echo __('Slider Here', 'woostudy') ?></p>
                
                <?php endif; wp_reset_postdata();?><!-- сбрасываем гдобальную переменную $post в исходное состояние, т.к. использовали пользовательский цикл -->
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->
    
    <?php
    // 1 из вариантов получения категорий
    // $cats = get_categories([
    //     'taxonomy' => 'product_cat',
    //     'hide_empty' =>  false, /* показать пустые категории */
    // ]);
    // woostudy_debug($cats);
    
    // 2 вариант шорткоды woo https://woocommerce.com/document/woocommerce-shortcodes/#product-category
    ?>

    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <!-- сделаем вывод надписи categories с учетом локализации, чтобы потом ее можно было перевести -->
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"><?php _e('Categories', 'woostudy') ?></span></h2>
        <div class="row px-xl-5 pb-3">
            <!-- Выводит категории ul>li (картинка, заголовок, количество) -->
            <?php echo do_shortcode('[product_categories hide_empty="0"]'); ?>
            <!-- <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/cat-1.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Category Name</h6>
                            <small class="text-body">100 Products</small>
                        </div>
                    </div>
                </a>
            </div> -->

        </div>
    </div>
    <!-- Categories End -->
    
<?php
    // Пользовательский цикл (один из вариантов) по выбору продуктов, но там не будет цены вроде.
    // $products = new WP_Query([
    //     'posts_per_page' => 3,
    //     'post_type' => 'product',
    // ]);
    // woostudy_debug($products);
    
?>

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"><?php _e('Featured Products', 'woostudy') ?></span></h2>
        <div class="row px-xl-5">
            
            <?php echo do_shortcode('[featured_products limit="8"]'); ?>
        
            <!-- <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?php echo get_template_directory_uri(); ?>/assets/img/product-1.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"><?php echo __('Recent Products', 'woostudy') ?></span></h2>
        <div class="row px-xl-5">
            <!-- последние товары -->
            <?php echo do_shortcode('[recent_products limit="8"]'); ?>
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vendor-1.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vendor-2.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vendor-3.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vendor-4.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vendor-5.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vendor-6.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vendor-7.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
    
    <?php get_footer(); ?>