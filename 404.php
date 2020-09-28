<?php get_header(); ?>
    <div class="l-container">
        <?php get_template_part('nav'); ?>
        <div class="l-content">
            <div class="l-content__inner u-flex">
                <div class="l-main">
                    <div class="l-main__inner">  
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
                            <?php if(function_exists("pagination")) pagination($additional_loop->max_num_pages); ?> 
                        </ul>
                        <?php else : ?>
                        <div class="p-page__notfound">
                            <p class="p-notfound__title">お探しのページが見つかりませんでした。</p>
                            <p class="p-notfound__img"><img class="u-img" src="<?php echo get_theme_file_uri().'/images/jamie-haughton-Z05GiksmqYU-unsplash.jpg' ?>" alt=""></p>
                            <div class="p-notfound__content">
                                <p class="p-notfound__text">別のキーワードやカテゴリーから記事を探してみましょう。</p>
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php get_footer(); ?>