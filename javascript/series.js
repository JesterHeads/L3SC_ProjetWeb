

var cacher=true;

$('.serie').click(function(){
    if(cacher){
        $(this).children().show();
        cacher=false;
    }
});

$('.serie').mouseleave(function(){
    cacher=true;
    $(this).children().hide();
})