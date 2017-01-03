
$('.serie,.topserie').click(function(){
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

$('.topserie').mouseleave(function(){
	$('.afficheSerie').siblings().hide();
});

function ajout_ep(episodevu){
	$.get(
		'episodesusers.php',
		{
		idepisode : episodevu
		},
		nom_fonction_retour(episodevu),
		'int'
	);
}

function nom_fonction_retour(id) {
	console.log('#'+id);
	document.getElementById(id).value = 'Episodes vu.';
	document.getElementById(id).disabled = true;
}

