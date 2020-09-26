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
                    <!--<ul class="c-nav__menu u-flex">
                        <li class="c-nav__item"><a href="" class="c-nav__link">プログラミング</a></li>
                        <li class="c-nav__item"><a href="" class="c-nav__link">HTML</a></li>
                        <li class="c-nav__item"><a href="" class="c-nav__link">JavaScript</a></li>
                        <li class="c-nav__item"><a href="" class="c-nav__link">PHP</a></li>
                    </ul>-->
                </nav>
            </div>
            
        </header>