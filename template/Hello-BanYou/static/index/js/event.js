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
	������ʱ����Ҫ�¼��Զ�ˢ��
	setInterval(getevent,10000);
	*/
});
