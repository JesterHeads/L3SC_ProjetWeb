



$('.serie').click(function(){
        $(this).children().show();
});

$('.numsaison').click(function(){
    $(this).children().show();

});

$('.numsaison').mouseleave(function(){
   $(this).children().hide() ;
});

$('.serie').mouseleave(function(){
    $(this).children().hide();
    $('.numsaison').children().hide();

});