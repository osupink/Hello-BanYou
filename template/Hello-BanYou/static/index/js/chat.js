limit=10;
function getchat() {
	$.ajax({url:'https://score.b.osu.pink/chat.php?limit='+limit,dataType:'jsonp',success:function(result){showchat(result);}});
}
function showchat(result) {
	$('#left-chat p').remove();
	for (m in result) {
		m=result[m];
		show('#left-chat',(((m.am) ? '* ' : '')+'<a href="https://user.b.osu.pink/'+m.username+'">'+m.username+'</a>'+((!m.am) ? ':' : '')+' '+m.content),m.timestamp);
	}
}
$(document).ready(function () {
	getchat();
	/*
	������ʱ����Ҫ�����Զ�ˢ��
	setInterval(getchat,10000);
	*/
});
