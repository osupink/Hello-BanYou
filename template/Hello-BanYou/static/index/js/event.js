function getevent() {
	$.ajax({url:'https://score.b.osu.pink/event.php',dataType:'jsonp',success:function(result){showevent(result);}});
}
function showevent(result) {
	$('#right-rank p').remove();
	for (m in result) {
		show('#right-rank',result[m].text);
	}
}
$(document).ready(function () {
	getevent();
	/*
	我们暂时不需要事件自动刷新
	setInterval(getevent,10000);
	*/
});
