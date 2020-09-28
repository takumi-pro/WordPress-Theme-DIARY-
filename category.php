<?php get_header(); ?>
    <div class="l-container">
        <?php get_template_part('nav'); ?>
        <div class="l-content">
            <div class="l-content__inner u-flex">
                <div class="l-main">
                    <div class="l-main__inner">
                        <div class="c-archive">
                            <h1 class="c-archive__title"><?php single_cat_title(); ?>の記事一覧</h1>
                        </div>
                        <ul class="p-page">
                        <?php if(have_posts()) :
                                while(have_posts()): the_post(); ?>
                            <li class="p-page__each c-eachpage">
                                <a href="<?php the_permalink(); ?>" class="c-page__link u-link">
                                    <div class="c-archive__img">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <?php the_post_thumbnail(); ?>
                                        
                                    <?php endif ;?>
                                        
                                    </div>
                                    <div class="c-page__time">
                                        <?php echo get_the_date('Y年n月j日'); ?>
                                    </div>
                                    <div class="c-page__title">
                                        <h2 class="c-title"><?php the_title(); ?></h2>
                                    </div>
                                    <?php if( has_post_thumbnail() ){ ?>
                                            <?php the_category(); ?>
                                        <?php }else{ ?>
                                            <div class="c-cate"><?php the_category(); ?></div>
                                            <div class="c-content"><?php the_excerpt(); ?></div>
                                        <?php }; ?>
                                </a>
                            </li>
                            <?php endwhile; ?>
                            <?php endif; ?>
                            
                            <?php if(function_exists("pagination")) pagination($additional_loop->max_num_pages); ?>
                        </ul>
                        
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php get_footer(); ?>