<?php get_header(); ?>

<!-- стандартный цикл вывода постов-->
<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
<!-- вывод постов, функции цикла: the_title() и т.д -->
  <h2><?php the_title(); ?></h2>
  <?php the_content(); ?>
<?php endwhile; else: ?>
  Записей нет
<?php endif; ?>
  
<?php get_footer(); ?>