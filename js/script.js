//TeddyFrost©
//if you want to use this code please contact me : r2d2f9@gmail.com
//using this code without contact me is a theft!
//its a >24 hours of work here
start = function() {//main function
	clickbletr();//clickable tr and some more
	hash();	//check page hash
	$('head').append('<style>#progbar:before{width: '+ $('#info').attr('percent') +'%;}</style>');
	$('#times').text($('#info').attr('times'));
	$('.tablreload').on('click',function(){
		if($('#btbuttons').attr('tab') == 'sett'){
			tab('list');
		}else{
			reload();
		}
	});
	$('.tablnew').on('click',function(){
		win('edit');
		winnew();
		$('#wid').val('none');
		$('#wdate').val($('#info').attr('date'));
		$('#wpass').show();
		$('#topsave').show();
		$('#topadd').hide();
		$('#topdelite').hide();
		$('#topsave').val('new');
		$('head title').html('Новая запись - BibleDiary');
		win('open');
	});
	$('.tablsett').on('click',function(){
		tab('sett');
	});
	$('#topback').click(function(){
		win('close');
		$('head title').html('BibleDiary');
		if($('#wid').val() == 'none'){
			
		}else{
			win('clear');
			location.hash = 'list';
			$('#topadd').show();
			$('#topdelite').show();
		}
		win('nedit');
		$('#wpass').hide();
	});
	$('#topdelite').click(function(){
		if($('#passinp').val()!=''){
			info('show','Точно удалить?',2,0,true,'*',function(inforet){
				r = inforet;
				//console.log(r);
				if (r == 'yes'){
					//console.log('deliting');
					ajaxscript('del');
					info('hide');
				}else{
					info('show','Ладно',1,2000);
				}
			});
		}else{
			if($('#wpass').css('display') == 'none'){
				$('#wpass').show();	
			}else{
				info('show','Введите пароль',1);
			}
		}
	});
	$('#topadd').click(function(){
		win('clear');
		win('edit');
		winnew();
		$('#wid').val('none');
		$('#wdate').val($('#info').attr('date'));
		$('#wpass').show();
		$('#topsave').show();
		$('#topadd').hide();
		$('#topdelite').hide();
		$('#topsave').val('new');
		location.hash = 'new';
		$('head title').html('Новая запись - BibleDiary');
	});
	$('#topedit').click(function(){
		win('edit');
	});
	$('#topsave').click(function(){//saving
		if($('#passinp').val()!='' ){
			ajaxscript();
		}else{
			info('show','Введите пароль',1);
		}
	});
	if(location.hash == '#first'){
		location.hash = 'second';
		info('show','Хочешь почитать инструкцию к сайту?',2,0,true,'*',function(r){
			if(r == 'yes'){
				location.href="faq.php"
			}else{
				info('none','Хочешь поставить аватарку?',2,0,false,'*',function(r){
					if(r == 'yes'){
						location.hash = 'settings';
					$(window).scrollTop($(window).height());
					}else{
						location.hash = '';				
					}
				});
			}
		})
	}else if(location.hash == '#second'){
		location.hash = '';
		info('none','Хочешь поставить аватарку?',2,0,false,'*',function(r){
			if(r == 'yes'){
				location.hash = 'settings';
			$(window).scrollTop($(window).height());
			}else{
				location.hash = '';				
			}
		});
	}
}//end main function
win = function(c){
	switch(c){
		case 'open':	$('#win').addClass('active');
							$('#toppanel').addClass('active');
							if($('#wid').val() != 'none'){
								$('head title').html('Запись '+$('#wid').val()+' - BibleDiary')
								location.hash = 'o'+$('#wid').val();break;
							}else{
								$('head title').html('Новая запись - BibleDiary')
								location.hash = 'new';break;
							}
		case 'close':	$('#win').removeClass('active');
							$('#toppanel').removeClass('active');
							$('head title').html('BibleDiary');
							if(location.hash != '#list'){
								location.hash = 'r'+$('#wid').val();break;								
							}
		case 'clear':	$('#wid').val('');
							$('#wdate').val('');
							$('#wnumber').val('');
							$('#wtags').val('');
							$('#wchapters').val('');
							$('#wdescription').val('');
							$('#wdescription').html('');break;
		case 'edit':	$('#topedit').hide();
							$('#wpass').show();
							$('#topsave').show();
							$('#wdate').removeAttr('readonly');
							$('#wnumber').removeAttr('readonly');
							$('#wtags').removeAttr('readonly');
							$('#wchapters').removeAttr('readonly');
							$('#wdescription').removeAttr('readonly');break;
		case 'nedit':	$('#topedit').show();
							$('#wpass').hide();
							$('#topsave').hide();
							$('#wdate').attr('readonly','');
							$('#wnumber').attr('readonly','');
							$('#wtags').attr('readonly','');
							$('#wchapters').attr('readonly','');
							$('#wdescription').attr('readonly','');break;
		default:console.error('win() say "Comand '+c+' is not exists"\n  Valid comands: open, close, clear, edit, nedit');break;
	}
}
ajaxscript = function(c){
	if(ajxprcs == false){
		ajxprcsf(true);
	if(c == "del"){
		link = "php/deliteline.php";
	}else{
		link = "php/editline.php";
		location.hash = 'r'+$('#wid').val();
	}
	objs = {
		"id" : $('#wid').val(),
		"d" : $('#wdate').val(),
		"chap" : $('#wchapters').val(),
		"tag" : $('#wtags').val(),
		"n" : $('#wnumber').val(),
		"s" : $('#wdescription').val(),
		"name" : $('#nameinp').val(),
		"pass" : $('#passinp').val()
	}
	$.ajax({
		type : "POST",
		data : objs,
		url : link,
		datatype : "json",
		success : function(data){
			var arr,ret;
			arr = JSON.parse(data);
			ret = arr['return'];
			switch(ret){
				case 'insert success':info('show','Запись добавлена',1,2000);break;
				case 'update success':info('show','Запись изменена',1,2000);break;
				case 'deliting: success':info('show','Запись удалена',1,2000);break;
				case 'wrong password':info('show','неправильный пароль',1,2000);break;
				case 'user verification: not all info':info('show','Ошибка входа- не вся информация',1,2000);break;
				case 'user verification: denied':info('show','неправильный пароль',1,2000);break;
				case 'user verification: denied - wrong password':info('show','неправильный пароль',1,2000);break;
				case 'date is allready exists':info('show','Запись с такой датой уже есть',1,2000);break;
				case 'not all variables':info('show','Не все поля введены',1,2000);break;
				case 'user not exists':info('show','Пользователь не найден',1,2000);break;
				case 'deliting: ERROR! post id isnt set':info('show','id записи неизвестен',1,2000);break;
				default :console.log('some other error!');break;
			}
			if(ret == 'insert success'||ret == 'update success'||ret == 'deliting: success'){
				$('#wid').val('');
				$('#wdate').val('');
				$('#wnumber').val('');
				$('#wchapters').val('');
				$('#wtags').val('');
				$('#wdescription').text('');
				$('#topdelite').show();
				$('#topedit').show();
				$('#topadd').show();
				win('close');
				win('clear');
				win('nedit');
				ajxprcsf(false);
				reload();
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
reload = function(c){
	if(ajxprcs == false){
		ajxprcsf(true,'r');
	objr = {
		'name' : $('#nameinp').val(),
		'c' : c
	}
	$.ajax({
		type : "POST",
		data : objr,
		url : 'php/reload.php',
		datatype : "json",
		success : function(data){
			var arr,ret;
			arr = JSON.parse(data);
			ret = arr['return'];
			switch(ret){
				case 'cant connect':info('show','Нет связи с базой данных',1,2000);break;
				case 'empty table':info('show','Таблица полностью пустая',1,2000);break;
				default :break;
			}
			if(ret = 'success'){
				var i,num,curId,curDate,curChap,curChaps,curNum,curShort,curShorts;
				num = arr['num'];
				$('#table table').html('');
				$('#table table').append('<tr class="th"><th style="width:10%;">Дата</th><th>Главы</th><th style="width:10%;">Кол-во</th><th style="width:40%;">Описание</th></tr>');
				if(num > 0){
					for (i = 0; i < num ; i++){
						curId = arr["id_" + i];
						curDate = arr["d_" + i];
						curChap = arr["c_" + i];
						curTag = arr["t_" + i];
						curNum = arr["n_" + i];
						curShort = arr["s_" + i];
						if(curChap.length > 41){
							curChaps = curChap.slice(0, 25)+'...';
						}else{
							curChaps = curChap;
						}
						if(curShort.length > 41){
							curShorts = curShort.slice(0, 25)+'...';
						}else{
							curShorts = curShort;
						}
						
						$('#table table').append('<tr num="'+curId+'" id="r'+curId+'"><td style="display:none" class="t">'+curTag+'</td><td class="d">'+curDate+'</td><td class="c" full="'+curChap+'">'+curChaps+'</td><td class="n">'+curNum+'</td><td class="s" full="'+curShort+'">'+curShorts+'</td></tr>');
							
					}
				}else{
					$('#table table').append('<tr num="1" class="tradd"><td class="d"></td><td class="c" full="">Добавить запись</td><td class="n"></td><td class="s" full="пусто"></td></tr>');
				}
				$('#tlevel').html(arr["level"]);
				$('#tallchap').html(arr["nt"]);
				$('#tthischap').html(arr["nt"]);
				$('#tleftchap').html(arr["left"]);
				$('#tpercent').html(arr["perc"]);
				clickbletr();
			}
			ajxprcsf(false,'r');
		},
		error : function() {
			info('show','Серверная ошибка!');
			ajxprcsf(false,'r');
		}
	})
	}
}
wwin = function(id,d,c,n,s){
	//console.log('Open win num:'+id);
	$('#wid').val(id);
	$('#wdate').val(d);
	$('#wnumber').val(n);
	$('#wchapters').val(c);
	$('#wtags').val(t);
	$('#wdescription').val(s);
	$('#wdescription').html(s);
}
clickbletr = function(){
	$('tr').on('click',function(){
		$('.th').click(function(){
			return false;
		});
		if($(this).attr('num')){
			n = $(this).attr('num');
			//console.log(n);
		}
	});
	$('tr td').on('click',function(){
		thtd = $(this);//able to click
		opentd = function(zis){
			id = zis.parents('tr').attr('num');
			d = zis.parents('tr').children('.d').text();
			c = zis.parents('tr').children('.c').attr('full');
			t = zis.parents('tr').children('.t').text();
			n = zis.parents('tr').children('.n').text();
			s = zis.parents('tr').children('.s').attr('full');
			wwin(id,d,c,n,s,t);
			win('open');
			$('#win input').on('dblclick',function(){
				if($(this).is('[readonly]')){
					win('edit');
				}
				$(this).removeAttr('readonly').focus();
			});
			$('#win textarea').on('dblclick',function(){
				if($(this).is('[readonly]')){
					win('edit');
				}
				$(this).removeAttr('readonly').focus();
			});
		}
		if($('tr[class = tradd]').length>0){
				$('.tablnew').trigger('click');
			}else{
			if($('#wid').val() == 'none'){
				info('show','Стереть несохраненную новую запись?',2,0,false,'*',function(r,thtd){
					if(r == 'no'){
						//dont open
					}else{
						opentd(thtd);
					}
				},thtd);
			}else{
				opentd($(this));
			}
		}
	});
}
checksettpass = function(){
	settpass  = $('#settlbl input').val();
	//check pass length
	if(settpass.length <1){
		info('show','Введите пароль',1,3000);
	}else{
		//check free ajax, is nothing ajaxing now
		if(ajxprcs == false){
			ajxprcsf(true);
			link = "php/chcksettpass.php";
			objs = {
				"pass" : settpass,
				"num" : $('#nameinp').val()
			}
			$.ajax({
				type : "POST",
				data : objs,
				url : link,
				datatype : "json",
				success : function(data){
					var arr,ret;
					arr = JSON.parse(data);
					ret = arr['return'];
					switch(ret){
						case 'done':break;
						case 'cant connect':info('show','Не удалось подключиться к Базе Данных');break;
						case 'wrong password':info('show','Пароль неправильный');break;
						case 'user not finded':info('show','Пользователь не найден');break;
						default :console.log('some other error!');break;
					}
					//ret: name,pass,email,img,bg
					//showing result/return of ajax
					if(ret == 'done'){
						showsettfields(arr['name'],arr['email'],arr['img'],arr['bg'],arr['verif']);
						//laoding file with functions MAYBE later
						//$('head').append('<script id="sett-script"></script>');
						//$('#sett-script').load('js/sett.js');
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
}
showsettfields = function(n,e,i,b,v){//+chimgs
	$('.settings').hide();
	if(v == 'yes'){
		vm = 'Email подтвержден';
	}else{
		vm = 'Email НЕ подтвержден. Проверь почту, там должно быть письмо cо ссылкой';
	}
	if($('.settinputs').length>0){
		$('.settinputs').remove();
	}
	feilds = '<div class="settinputs">'+
					'<h1>Настройки:</h1>'+
					'<span class="befhr">Общая информация</span><hr>'+
					'<label>Имя:<input id="sett-name" type="text" maxLength="50"value="'+n+'"></label><br>'+
					'<label>Email:<input id="sett-email" type="email" required maxlength="40" value="'+e+'"></label><br>'+
					'<small>'+vm+'</small><br>'+
					'<div id="sett-aang"><label>Изображение профиля:</label><br><div class="img"><img src="'+$('#image img').attr('src')+'"></div><label for="sett-a-inp" id="sett-a-lab"><input id="sett-a-inp" type="file" style="display:none">Загрузить новую</label><br><small>до 2 МБ, .png, .jpg, .gif</small>'+/*<br><button>Заменить цвет на прозрачность</button>*/'</div>'+
					'<div id="sett-bg"><label>Фон профиля:</label><br><img src="'+$('#background img').attr('src')+'"><label for="sett-b-inp" id="sett-b-lab"><input id="sett-b-inp" type="file" style="display:none">Загрузить новую</label><br><small>до 2 МБ, .png, .jpg, .gif</small>'+/*<br><button>Поставить базовую</button>*/'</div>'+
					'<span class="befhr">Изменение пароля</span><hr>'+
					'<label>Новый пароль:<input id="sett-pass1" type="password" maxLength="30" ></label><br>'+
					'<label>Пароль еще раз:<input id="sett-pass2" type="password" maxLength="30"></label>'+
					'<button id="sett-save" onclick="savingsettings()" >Сохранить</button>'+
				'</div>';
	$('.settings').after(feilds);
	//saving settings actions
	$('#sett-save').on('click',function(){
		savingsettings();
	});
	//check input file changing
	 chimgs = function(data,link){
	//sending files on server
		if(ajxprcs == false){
			ajxprcsf(true);
			$.ajax({
			url: link,
			type: 'POST',
			data: data,
			cache: false,
			dataType: 'json',
			processData: false, 
			contentType: false,
			success: function(data){
				console.log(data);
				var ar;
				ar = data['ret'];
				ext = data['ext'];
				d = data['d'];
				switch(ar){
					case 'lack of data':info('show','Не хватает переменных');break;
					case 'wrong password':info('show','Пароль не правельный');break;
					case 'to large':info('show','Файл весит больше 2 МБ');break;
					case 'wrong extention':info('show','Расширение файла не .png,.jpg  и не .gif');break;
					case 'error on uploading img':info('show','Ошибка загрузки');break;
					case 'files are here':info('show','Файл успешно загружен');break;
				}
				//reloading img
				name = $('#nameinp').val();
				plus = '?'+new Date();
				if(d == 'a'){
					$('#sett-aang .img img').attr('src', 'img/a/'+name+'.'+ext+plus);
					$('#image img').attr('src', 'img/a/'+name+'.'+ext+plus);
				}else if(d == 'b'){
					$('#sett-bg  img').attr('src', 'img/b/'+name+'.'+ext+plus);
					$('#background img').attr('src', 'img/b/'+name+'.'+ext+plus);
				}
				ajxprcsf(false);
			},error: function(data){
				ajxprcsf(false);
				var ar;
				info('show','Ошибка загрузки.');
				//console.log(data);
				ar = data['ret'];
			}
			});
		}else{
			info('show','В процессе... Подожди');
		}
	}
	
	$('#sett-a-inp').on('change',function(){
		files = event.target.files;
		data = new FormData();
		$.each(files, function(key, value){data.append(key, value);});
		data.append('p',$('#settlbl input').val());
		data.append('n',$('#nameinp').val());
		data.append('dir','a');
		link = 'php/saveimg.php?files';
		chimgs(data,link);
	});
	$('#sett-b-inp').on('change',function(){
		files = event.target.files;
		data = new FormData();
		$.each(files, function(key, value){data.append(key, value);});
		data.append('p',$('#settlbl input').val());
		data.append('n',$('#nameinp').val());
		data.append('dir','b');
		link = 'php/saveimg.php?files';
		chimgs(data,link);
	});
}
savingsettings = function(){
	//vars
	n = $('#sett-name').val();
	e = $('#sett-email').val();
	p1 = $('#sett-pass1').val();
	p2 = $('#sett-pass2').val();
	if(p1.length <1 || p2.length < 1){
		p1 = '';
		p2 = '';
	}
	right = true;
	if(n.length<6){
		right = false;
		info('show','Имя слишком короткое');
	}
	if(n.length>50){
		right = false;
		info('show','Имя слишком длинное');
	}
	if(n.indexOf('/') >= 0||n.indexOf('%') >= 0||n.indexOf('"') >= 0||n.indexOf("'") >= 0||n.indexOf('*') >= 0||n.indexOf('(') >= 0||n.indexOf(')') >= 0||n.indexOf('#') >= 0||n.indexOf('=') >= 0) {
		right = false;
		info('show','В имени нельзя использовать такие знаки');
	}
	if(e.length < 5 || e.indexOf('@') <= 1 || e.length - (e.indexOf('@') + 1) <= 2 || (e.indexOf('.') - (e.indexOf('@'))) < 3 || e.length - (e.indexOf('.') + 1) <= 1){
		right = false;
		info('show','Неправильный адрес почты');
	}
	if(p1.length>0){		
		if(p1.length<6){
			right = false;
			info('show','Пароль слишком короткий');
		}
		if(p1.indexOf('password')>= 0 || p1 == '123456' || p1.indexOf('фыва')>= 0 ||  p1 == '123456789'|| p1.indexOf('qwer')>= 0 ||  p1 == '12345678'||  p1 == 'abc123'||  p1 == '1234567'||  p1 == 'football'||  p1 == '1234567890'){
			right = false;
			info('show','Пароль слишком простой');
		}
		if(p1 != p2){
			right = false;
			info('show','Пароли не совпадают');
		}
	}
	if(right == true){
		if(ajxprcs == false){
			ajxprcsf(true);
			link = "php/savesettings.php";
			objs = {
				"num" : $('#nameinp').val(),
				"p" : $('#settlbl input').val(),
				"n" : n,
				"e" : e,
				"p1" : p1,
				"p2" : p2
			}
			$.ajax({
				type : "POST",
				data : objs,
				url : link,
				datatype : "json",
				success : function(data){
					var arr,ret;
					arr = JSON.parse(data);
					ret = arr['return'];
					switch(ret){
						case 'done':break;
						case 'cant connect':info('show','Не удалось подключиться к Базе Данных');break;
						case 'wrong password':info('show','Пароль неправильный');break;
						case 'user not finded':info('show','Пользователь не найден');break;
						case 'vars missing':info('show','Не все данные переданы');break;
						case 'invalid value':info('show','Некоректно введены данные');break;
						default :console.log('some other error!');break;
					}
					if(ret == 'done'){
						if(arr['verif'] == 'new'){
							info('show','Настройки сохранены. Проверь почту для подтвержнения нового адресса.');
						}else{
							info('show','Настройки сохранены');
						}
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
}
tab = function(n){
	//n - needed tab
	c = $('#btbuttons').attr('tab');//curret tab
	if(typeof n !== 'undefined'){//return mode
		if(c == n){
		}else{
			//hidding curret tab
			switch(c){
				case 'list' :$('#table').hide();break;
				case 'sett' :	if($('.settings').length >0 ){
									$('.settings').hide();}
									if($('.settinputs').length >0 ){
									$('.settinputs').remove();}
									$('head title').html('BibleDiary');
									$('.tablsett').show();break;
			}
			//showing needed tab
			switch(n){
				case 'list' :location.hash = 'list';
								$('#btbuttons').attr('tab','list');
								$('.tablreload i').addClass(' fa-repeat').removeClass('fa-list-ul');
								$('#table').show();break;
				case 'sett' :location.hash = 'settings';
								$('.tablsett').hide();
								$('#btbuttons').attr('tab','sett');
								$('head title').html('Настройки - BibleDiary');
								$('.tablreload i').removeClass(' fa-repeat').addClass('fa-list-ul');
								if($('.settings').length == 0){
									$('#btbuttons').after('<div class="settings"></div>');
									$('.settings').append('<h1>Настройки:</h1><label id="settlbl">Пароль:<input type="password" ></label><button class="settchckpass" onClick="checksettpass()"><i class="fa fa-angle-right"></i></button>');
								}else{
									$('.settings').show();
								}break;
			}
		}
	}else{
		return c;
	}
}
winnew = function(){
	var date = new Date();
	y = date.getFullYear();
	y = (y+'').substr(2,4);
	m = (date.getMonth()+1);
	if(m<10){m = '0'+m}else{m = ''+m}
	dy = (date.getDate());
	if(dy<10){dy = '0'+dy}else{dy = ''+dy}
	d = dy+'.'+m+'.'+y;
	if($('#info').attr('date') != d && date.getHours() > 4){
		$('#info').attr('date',d);
	}else{
		
	}
}
$(document).ready(function(){start()});