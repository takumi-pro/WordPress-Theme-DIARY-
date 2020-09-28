<?php
/*
Template Name: お問い合わせ
*/

?>

<?php get_header(); ?>
    <div class="l-container">
        <?php get_template_part('nav'); ?>

        <div class="l-content">
            <div class="l-content__inner u-flex u-p0">
                <div class="l-main">
                    <div class="l-main__inner p-main__inner">
                    <?php if(have_posts()):  //wordpressループ
                        while(have_posts()) : the_post(); //繰り返し処理開始 ?>
                        <div class="c-header">
                            <h1 class="c-header__title"><?php the_title(); ?></h1>
                        </div>
                        <section class="c-section">
                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php the_content(); ?>
                            </div>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </section>
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php get_footer(); ?>
    