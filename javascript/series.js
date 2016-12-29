

var cacher=true;

$('.serie').click(function(){
    if(cacher){
        $(this).children().show();
        cacher=false;
    }else{
        $(this).children().hide();
        cacher=true;
    }
});