jQuery(function($){
    jQuery('.js-nav__trigger').on('click',function(){
        jQuery(this).toggleClass('active');
        jQuery('.js-nav').slideToggle("slow");
    });
});