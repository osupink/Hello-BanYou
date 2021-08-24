function getnews() {
	$.ajax({url:'https://score.b.osu.pink/news.php',dataType:'jsonp',success:function(result){shownews(result);}});
}
function shownews(result) {
	$('#right-news').append('<h3>'+result.date+'</h3>');
	$('#right-news').append('<p>'+result.text+'</p>');
}
$(document).ready(function () {
	getnews();
});
