<?php
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
}

//ウィジェット自体を作成する
class my_widgets_item1 extends WP_Widget{
    //初期化（管理画面で表示するウィジェットの名前を設定する）
    //クラス名と同じにする
    function my_widgets_item1(){
        parent::WP_Widget(false,$name='メリットウィジェット');
    }

    //ウィジェットの入力項目を作成する処理
    //関数名は必ずformにする
    function form($instance){
        //サニタイズ
        $title = esc_attr($instance['title']);
        $body = esc_attr($instance['body']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo 'タイトル：'; ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo 'タイトル：'; ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('body'); ?>">
                <?php echo '内容：'; ?>
            </label>
            <textarea class="widefat" name="<?php echo $this->get_field_name('body'); ?>" id="<?php echo $this->get_field_id('body'); ?>" cols="30" rows="10"><?php echo $body; ?></textarea>
        </p>
        <?php
    }

    //ウィジェットに入力された情報を保存する処理
    function update($new_instance,$old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']); //タグを取り除く
        $instance['body'] = trim($new_instance['body']); //空白を取り除く
        return $instance;
    }

    //管理画面から入力されたウィジェット画面に表示する処理
    function widget($args,$instance){
        //配列を変数に展開
        extract($args);

        //ウィジェットから入力された情報を取得
        $title = apply_filters('widget_title',$instance['title']);
        $body = apply_filters('widget_body',$instance['body']);

        //ウィジェットから入力された情報がある場合、htmlを表示する
        if($title){
            ?>
            <div class="c-widget">
                <h4 class="c-widget__bar"><?php echo $title; ?></h4>
                <ul class="c-widget__list">
                    <li class="c-widget__item"><a href="" class="u-link c-widget__link"><?php echo $body; ?></a></li>
                    <li class="c-widget__item"><a href="" class="u-link c-widget__link">HTML</a></li>
                    <li class="c-widget__item"><a href="" class="u-link c-widget__link">JavaScript</a></li>
                    <li class="c-widget__item"><a href="" class="u-link c-widget__link">PHP</a></li>
                </ul>
            </div>
            
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


                  

