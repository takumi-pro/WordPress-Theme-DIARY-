<?php
/*
Template Name: プロフィール
*/

?>

<?php get_header(); ?>
    <div class="l-container">
        <?php get_template_part('nav'); ?>

        <div class="l-content">
            <div class="l-content__inner u-flex u-p0">
                <div class="l-main">
                    <div class="l-main__inner p-main__inner">
                        <div class="c-header">
                            <h1 class="c-header__title">プロフィール</h1>
                        </div>
                        
                        <section class="c-section">
                        <?php if(have_posts()):  //wordpressループ
                                while(have_posts()) : the_post(); //繰り返し処理開始 ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <?php the_content(); ?>
                                </div>
                            <?php endwhile; 
                            else : //記事が見つからなかった場合の処理?>
                            <div class="post">
                                <h2>記事はありません</h2>
                                <p>お探しの記事は見つかりませんでした。</p>
                            </div>
                            <?php endif; ?>
                        </section>
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php get_footer(); ?>
    