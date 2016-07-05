//TeddyFrost©
//if you want to use this code please contact me : r2d2f9@gmail.com
//using this code without contact me is a theft!
//its a >2 hours of work here =)
//reg.js
onstart = function(){
	v = 0;
	$('input').keyup(function(){
		valid();
	});
	$('.checkbox').click(function(){
		valid();
	});
}
valid = function(){
	v = 0;
	n = $('#iname').val();
	e = $('#imail').val();
	p1 = $('#ipass1').val();
	p2 = $('#ipass2').val();
	ch = $('#agree').val();
	if($('#agree:checked').length != 1){
		v++;
		text = 'Почти. Осталось поставить галочку';
	}
	if(p1.length < 6 || p1 != p2){
		v++;
		text = 'Пароли не сходятся';
	}
	if(p1 == 'password' || p1 == '123456' || p1.indexOf('фыва')>= 0 ||  p1 == '123456789'||  p1 == 'qwerty'||  p1 == '12345678'||  p1 == 'abc123'||  p1 == '1234567'||  p1 == 'football'||  p1 == '1234567890'){
		v++;
			ppass = "";
			chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			for( i=0; i < 6; i++ )
				ppass += chars.charAt(Math.floor(Math.random() * chars.length));
		text = 'Придумай пароль посложнее. Например: '+ppass;
	}
	if(p1.length > 30){
		v++;
		text = 'Слишком длинный пароль. Максимум 30 знаков';
	}
	if(p1.length < 6){
		v++;
		text = 'Слишком короткий пароль. Хотя бы 6 знаков';
	}
	//email
	if(e.length < 1 || e.indexOf('@') <= 1 || e.length - (e.indexOf('@') + 1) <= 2 || (e.indexOf('.') - (e.indexOf('@'))) < 3 || e.length - (e.indexOf('.') + 1) <= 1){
		v++;
		text = 'Не похоже адрес почты';
	}
	//check for / % '  " * ( ) # =
	if(n.indexOf('/') >= 0||n.indexOf('%') >= 0||n.indexOf('"') >= 0||n.indexOf("'") >= 0||n.indexOf('*') >= 0||n.indexOf('(') >= 0||n.indexOf(')') >= 0||n.indexOf('#') >= 0||n.indexOf('=') >= 0) {
		v++;
		text = 'Нельзя использовать /   % " \' * ( ) # =';
	}
	if( n.length>50){
		v++;
		text = 'Слишком длинное имя. Максимум 50 знаков';
	}
	if(n.length<6){
		v++;
		text = 'Слишком короткое имя.  Хотя бы 6 знаков';
	}
	t = $('#reg-inps small');
	s = $('#reg-submit');
	if(v==0){
		text = '';
		t.text('');
		t.css('opacity','0');
		s.removeAttr('disabled');
	}else{
		t.text(text);
		t.css('opacity','1');
		s.attr('disabled','disabled');
	}
}
$(document).ready(function(){onstart()});