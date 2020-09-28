<header class="l-header u-main__color">
    <div class="l-header__inner">
        <h1 class="l-title"><a href="<?php echo home_url(); ?>" class="l-title__link">takumidiary</a></h1>
        <div class="c-nav__trigger js-nav__trigger">
            <span class="c-nav__trigger--item"></span>
            <span class="c-nav__trigger--item"></span>
            <span class="c-nav__trigger--item"></span>
        </div>
        <nav class="c-nav js-nav">
        <?php  wp_nav_menu(array(
            'theme_location' => 'mainmenu',
            'container' => '',            
            'item_wrap' => '<ul>%3$s</ul>'
        )); ?>
       </nav>
     </div>            
</header>