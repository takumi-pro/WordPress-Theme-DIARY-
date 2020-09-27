jQuery(function($){
    jQuery('.js-nav__trigger').on('click',function(){
        $(this).toggleClass('active');
        $('.js-nav').slideToggle("slow");
    });
});

