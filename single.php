<?php get_header(); ?>
    <div class="l-container">
        <?php get_template_part('nav'); ?>

        <div class="l-content">
            <div class="l-content__inner u-flex u-p0">
                <div class="l-main">
                    <div class="l-main__inner p-main__inner">
                        <div class="c-header">
                            <h1 class="c-header__title"><?php the_title(); ?></h1>
                            <div class="c-header__time">
                                <?php echo get_the_date('Y年n月j日'); ?>
                            </div>
                            <?php if( has_post_thumbnail() ): ?>
                                <div class="c-page__img">
                                    <?php the_post_thumbnail(); ?>       
                                </div>
                            <?php endif ;?>
                        </div>
                        <section class="c-section">
                            
                            <?php the_content(); ?>
                        </section>
                    </div>
                   
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php get_footer(); ?>
    