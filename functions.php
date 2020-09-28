<?php
function add_script(){
    wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js', array('jquery'), '', false);
}
add_action( 'wp_enqueue_scripts', 'add_script' );

//title
add_theme_support( 'title-tag' );

//カスタムヘッダー画像を使う
$custom_header_defaults = array(
    'default-image' => get_bloginfo('template_url').'/image/headers/logo.png',
    'header-text' => false,//ヘッダー画像にテキストを被せる
);
//カスタムヘッダー機能を有効にさせる
add_theme_support('custom-header',$custom_header_deafults);

//カスタムメニュー
//第一引数はtheme_locationで設定したもの
//第二引数は管理画面から確認できるもの
register_nav_menu('mainmenu','メインメニュー');

//アイキャッチ有効
add_theme_support('post-thumbnails');
//set_post_thumbnail_size(300, 250, true);

/*============================
カスタムウィジェット
=============================*/
//ウィジェットエリアを作成する関数がどれなのかを登録する
add_action('widgets_init','my_widgets_area');
//ウィジェット自体の作成するクラスがどれなのかを登録する
add_action('widgets_init',create_function('','return register_widget("my_widgets_item1");'));

//ウィジェットエリアを作成する
function my_widgets_area(){
    register_sidebar(array(
        'name' => 'カテゴリー',
        'id' => 'category',
        'before_widget' => '<div class="c-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="c-widget__bar">',
        'after_title' => '</h4>' 
    ));
    register_sidebar(array(
        'name' => 'フッターナビ',
        'id' => 'footer',
        'before_widget' => '<div class="l-footer_navlist">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="c-widget__bar">',
        'after_title' => '</h4>' 
    ));
}

//ウィジェット自体を作成する
class my_widgets_item1 extends WP_Widget{
    //初期化（管理画面で表示するウィジェットの名前を設定する）
    //クラス名と同じにする
    function my_widgets_item1(){
        parent::WP_Widget(false,$name='フッターウィジェット');
    }

    //ウィジェットの入力項目を作成する処理
    //関数名は必ずformにする
    function form($instance){
        //サニタイズ
        $title = esc_attr($instance['title']);
        $url = esc_attr($instance['url']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo 'タイトル：'; ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
            <label for="<?php echo $this->get_field_id('url'); ?>">
                <?php echo 'url：'; ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $url; ?>">
        </p>
        <?php
    }

    //ウィジェットに入力された情報を保存する処理
    function update($new_instance,$old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']); //タグを取り除く
        $instance['url'] = trim($new_instance['url']); //空白を取り除く
        return $instance;
    }

    //管理画面から入力されたウィジェット画面に表示する処理
    function widget($args,$instance){
        //配列を変数に展開
        extract($args);

        //ウィジェットから入力された情報を取得
        $title = apply_filters('widget_title',$instance['title']);
        $url = apply_filters('widget_body',$instance['url']);

        //ウィジェットから入力された情報がある場合、htmlを表示する
        if($title){
            ?>
            <li class="l-footer__item">
                <a href="<?php echo $url; ?>" class="l-footer__link u-link"><?php echo $title; ?></a>
            </li>
            <?php
        }
    }
}

//ページネーション
function pagination($pages='',$range=2){
    $showtime = ($range*2)+1; //表示するページ数

    global $paged; //wordpressで用意されている変数
    if(empty($paged)) $paged = 1; //デフォルトのページ

    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages; //全ページ数取得
        if(!$pages){
            $pages = 1;
        }
    }

    if(1 != $pages){ //全ページ数が1出ない場合はページネーションを表示する
        echo "<div class=\"c-pagenation\">\n";
        echo "<ul class=\"c-pagenation__numbers u-flex\">\n";
        //prev:現在のページ数が１より大きい場合は表示
        if($paged > 1) echo "<li class=\"c-pagenation__item\"><a class=\"c-numbers p-pagenation__link\" href='".get_pagenum_link($paged-1)."'>Prev</a></li>\n";

        for($i = 1; $i <= $pages; $i++){
            if(1 != $pages && (!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showtime)){
                echo ($paged == $i) ? "<li class=\"c-pagenation__item\">"."<span class=\"c-numbers p-pagenation__current\">".$i."</span>"."</li>\n" : "<li class=\"c-pagenation__item\"><a class=\"c-numbers p-pagenation__link\" href='".get_pagenum_link($i)."'>".$i."</a></li>\n";
            }
        }
        //Next :総ページ数より現在のページ値が小さい場合は表示
        if($paged < $pages) echo "<li class=\"c-pagenation__item\"><a class=\"c-numbers p-pagenation__link\" href=\"".get_pagenum_link($paged+1)."\">Next</a></li>\n";
        echo "</ul>\n";
        echo "</div>\n";
    }
}


                  

