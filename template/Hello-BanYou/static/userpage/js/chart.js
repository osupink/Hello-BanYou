new Chart($("#rankchart").get(0).getContext("2d"),{
	type:'line',
	data:{
		labels:datedata,
		datasets:[{
			label:'Performance',
			data:ppdata,
			backgroundColor:['rgba(255, 99, 132, 0.2)'],
			borderColor:['rgba(255,99,132,1)']
		}]
	},options:{
		responsive:true,
		title:{
			display:true,
			text:'Performance'
		},legend:{
			display:false
		}
	}
});
