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
