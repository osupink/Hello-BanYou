function show(p,text,date=0) {
	if (date) {
		var hour=new Date(Date.parse(date.replace(/-/g, '/'))).getHours();
		var minute=new Date(Date.parse(date.replace(/-/g, '/'))).getMinutes();
		if (hour < 10) {
			hour='0'+hour;
		}
		if (minute < 10) {
			minute='0'+minute;
		}
		text=hour+':'+minute+' '+text;
	}
	$(p).append('<p>'+text+'</p>');
}
function showchat(result) {
	$('#left-chat p').remove();
	for (m in result) {
		m=result[m];
		show('#left-chat',(((m.am) ? '* ' : '')+'<a href="https://user.b.osu.pink/'+m.username+'">'+m.username+'</a>'+((!m.am) ? ':' : '')+' '+m.content),m.timestamp);
	}
}
function showevent(result) {
	$('#right-rank p').remove();
	for (m in result) {
		show('#right-rank',result[m].text);
	}
}
function shownews(result) {
	$('#right-news').append('<h3>'+result.date+'</h3>');
	$('#right-news').append('<p>'+result.text+'</p>');
}
$(document).ready(function () {
	/*
	setInterval(getchat,10000);
	setInterval(getevent,10000);
	*/
	$.ajax({url:'https://score.b.osu.pink/chat.php?limit=10',dataType:'jsonp',success:function(result){showchat(result);}});
	$.ajax({url:'https://score.b.osu.pink/event.php',dataType:'jsonp',success:function(result){showevent(result);}});
	$.ajax({url:'https://score.b.osu.pink/news.php',dataType:'jsonp',success:function(result){shownews(result);}});
});
