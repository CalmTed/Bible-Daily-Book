/* feedback.js */
feedback = function(){
	$('#f-topic').on('change',function(){
		console.log($('#f-topic').val());
		if($('#f-topic').val() == 'other'){
			$('#topic-other-label').removeClass('hidden');
		}else{
			$('#topic-other-label').addClass('hidden');
		}
	});
	$('#f-submit').on('mouseup',function(){
		valid();
	});
}
valid = function(){
	e = $('#f-email').val();
	t = $('#f-topic').val();
	to = $('#topic-other').val();
	m = $('#f-message').val();
	if(t == 'other'){
		t = to;
	}
	v = true;
	if(m.indexOf(' ') <= 1){
		v = false;
		f = 'Тут даже двух слов нету';
	}
	if(m.length < 0){
		v = false;
		f = 'Сообщение не должно быть пустым';
	}
	if($('#f-topic').val() == 'other'){
		if(t.length<1){
			v = false;
			f = 'Не забудь ввести тему';
		}
	}
	if(e.length < 1 || e.indexOf('@') <= 1 || e.length - (e.indexOf('@') + 1) <= 2 || (e.indexOf('.') - (e.indexOf('@'))) < 3 || e.length - (e.indexOf('.') + 1) <= 1){
		v = false;
		f = 'Не похоже на адрес почты';
	}
	if(e.length < 1){
		v = false;
		f = 'Похоже ты забыл написать эл. почту';
	}
	if(v == false){
		info(f);
	}else{
		//sending message
		link = "php/sendfeedback.php";
		objs = {
			"e" : e,
			"t" : t,
			"m" : m
		}
		$.ajax({
			type : "POST",
			data : objs,
			url : link,
			datatype : "json",
			success : function(data){
				var arr,ret;
				console.log(data);
				arr = JSON.parse(data);
				ret = arr['return'];
				console.log(ret);
				switch(ret){
					case 'message sent':info('show','Сообщение отправлено',1,2000);break;
					case 'vars leak':info('show','Не все данные переданы',1,2000);break;
					default :info('что-то пошло не так!');break;
				}
				ajxprcsf(false);
			},
			error : function() {
				info('show','Серверная ошибка!');
				ajxprcsf(false);
			}
		})
		
	}
}
tab = function(){return 'no'}//for gen.js
$('window').ready(function(){feedback();});