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
                                    <div class="c-page__img">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <?php the_post_thumbnail(); ?>
                                        
                                    <?php endif ;?>
                                    </div>
                                    <div class="c-page__title">
                                        <h2 class="c-title"><?php the_title(); ?></h2>
                                        <?php single_cat_title('カテゴリー:'); ?>
                                    </div>
                                </a>
                            </li>

                            <?php endwhile; ?>
                            <?php endif; ?>
                            
                        </ul>
                        <div class="c-pagenation">
                            <ul class="c-pagenation__numbers u-flex">
                                <li class="c-pagenation__item"><span class="c-numbers p-pagenation__current">1</span></li>
                                <li class="c-pagenation__item"><a href="" class="c-numbers p-pagenation__link">2</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php get_footer(); ?>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="./js/app.js"></script>
</body>
</html>