//TeddyFrost©
//if you want to use this code please contact me : r2d2f9@gmail.com
//using this code without contact me is a theft!

var start = function() {//main function
	var treeright = 0,
	inforet = '',//info return
	infowait;//setinterval for info win
	scale();
	$(window).scroll(function (){
			return false;
	});
	$(window).resize(function(){scale();});
	clickbletr();//clickable tr end some more
	$('head').append('<style>#progbar:before{width: '+ $('#info').attr('percent') +'%;}</style>');
	$('#times').text($('#info').attr('times'));
	$('#topback').click(function(){
		win('close');
		win('clear');
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
		$('#wid').val('none');
		$('#wdate').val($('#info').attr('date'));
		$('#wpass').show();
		$('#topsave').show();
		$('#topsave').val('new');
	});
	$('#topedit').click(function(){
		win('edit');
		$('#wpass').show();
		$('#topsave').show();
	});
	//saving
	$('#topsave').click(function(){
		if($('#passinp').val()!='' ){
			ajaxscript();
		}else{
			info('show','Введите пароль',1);
		}
	});	
}//end main function
win = function(c){
	switch(c){
		case 'open':$('#win').addClass('active');$('#toppanel').addClass('active');break;
		case 'close':$('#win').removeClass('active');$('#toppanel').removeClass('active');break;
		case 'clear':$('#wid').val('');$('#wdate').val('');$('#wnumber').val('');$('#wchapters').val('');$('#wdescription').text('');break;
		case 'edit':$('#wdate').removeAttr('readonly');$('#wnumber').removeAttr('readonly');$('#wchapters').removeAttr('readonly');$('#wdescription').removeAttr('readonly');break;
		case 'nedit':$('#wpass').hide();	$('#topsave').hide();$('#wdate').attr('readonly','');$('#wnumber').attr('readonly','');$('#wchapters').attr('readonly','');$('#wdescription').attr('readonly','');break;
		default:console.log('ERROR! Comand is not exists.');break;
	}
}
ajaxscript = function(c){
	if(c == "del"){
		link = "php/deliteline.php";
		console.log($('#wid').val(),$('#wdate').val(),$('#wchapters').val(),$('#wnumber').val(),$('#wdescription').val(),$('#nameinp').val(),$('#passinp').val());
	}else{
		link = "php/editline.php";
	}
	objs = {
		"id" : $('#wid').val(),
		"d" : $('#wdate').val(),
		"chap" : $('#wchapters').val(),
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
			//console.log(arr['return']);
			switch(ret){
				case 'insert success':info('show','Запись добавлена',1,2000);break;
				case 'update success':info('show','Запись изменена',1,2000);break;
				case 'deliting: success':info('show','Запись удалена',1,2000);break;
				case 'wrong password':info('show','Неправельный пароль',1,2000);break;
				case 'user verification: not all info':info('show','Ошибка входа- не вся информация',1,2000);break;
				case 'user verification: denied':info('show','Неправельный пароль',1,2000);break;
				case 'user verification: denied - wrong password':info('show','Неправельный пароль',1,2000);break;
				case 'date is allready exists':info('show','Запись с такой датой уже есть',1,2000);break;
				case 'not all variables':info('show','Не все поля введены',1,2000);break;
				case 'deliting: ERROR! post id isnt set':info('show','id записи неизвестен',1,2000);break;
				default :console.log('some other error!');break;
			}
			if(ret == 'insert success'||ret == 'update success'||ret == 'deliting: success'){
				$('#wid').val('');
				$('#wdate').val('');
				$('#wnumber').val('');
				$('#wchapters').val('');
				$('#wdescription').text('');
				win('close');
				win('clear');
				win('nedit');
				reload();
			}
		},
		error : function() {
			info('show','Серверная ошибка!');
		}
	})
}
reload = function(c){
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
						curNum = arr["n_" + i];
						curShort = arr["s_" + i];
						if(curChap.length > 41 || curShort.length > 41){
							curChaps = curChap.slice(0, 40);
							curShorts = curShort.slice(0, 40);
						}else{
							curChaps = curChap;
							curShorts = curShort;
						}
						$('#table table').append('<tr num="'+curId+'"><td class="d">'+curDate+'</td><td class="c" full="'+curChap+'">'+curChaps+'</td><td class="n">'+curNum+'</td><td class="s" full="'+curShort+'">'+curShorts+'</td></tr>');
							
					}
				}else{
					$('#table table').append('<tr num="1"><td class="d"></td><td class="c" full="">Записей нет</td><td class="n"></td><td class="s" full="пусто"></td></tr>');
				}
				$('#tlevel').html(arr["level"]);
				$('#tallchap').html(arr["nt"]);
				$('#tthischap').html(arr["nt"]);
				$('#tleftchap').html(arr["left"]);
				$('#tpercent').html(arr["perc"]);
				clickbletr();
			}
		},
		error : function() {
			info('show','Серверная ошибка!');
		}
	})
}
wwin = function(id,d,c,n,s){
	//console.log('Open win num:'+id);
	$('#wid').val(id);
	$('#wdate').val(d);
	$('#wnumber').val(n);
	$('#wchapters').val(c);
	$('#wdescription').html(s);
}
scale = function(){
	if($(window).width() > 700){//for PS screen
		$('#wspan').css('height','0px');
	}else{//for phone
		$('#wspan').css('height',$('#win').height()/3);
	}
	//background
	$('#background').css('height',$(window).height()+'px');
	$('#background img').css('min-height',$(window).height()+'px').css('min-width',$(window).width()+'px');
	
	//content
	$('#content').css('margin-top',$(window).height()-$('#profile').height());
	$('#win').css('height',$(window).height()-50);
	//footer
	$('footer').css('height',($(window).height/4));
}
info = function(c='none',t = 'no',n = 0,wait = 5000,close = false,event = '*',callback = function(){}){
		clearTimeout();//stop previous wait
	if(t != 'no'){//write text or not
		$('#infow p').text(t);
	}
	if(c!='none'){//what to do
		switch(c){
				case 'show' :$('#infow').addClass('active'); break;
				case 'hide' :$('#infow').removeClass('active'); break;
				case 'toggle' :$('#infow').toggleClass('active'); break;
				default:break;
		}
	}
	if(n == 1){//how long show info
		setTimeout(function(){info('hide')},wait);
	}
	if(n!=0){
		switch(n){//tipe of info window
				case 1 :$('.infobuttons').html('<div class="info-b-1">ОК</div>');break;
				case 2 :$('.infobuttons').html('<div class="info-b-2-y">Да</div><div class="info-b-2-n">Нет</div>');break;
				case 3 :$('.infobuttons').html('<input class="info-b-3-i"><div class="info-b-3-s">Далее</div>');break;
				case 4 :$('.infobuttons').html('<input type="password" class="info-b-4-i"><div class="info-b-4-s">Далее</div>');break;
				default:break;
		}
	}
	$('.info-b-1,.info-b-2-y,.info-b-2-n,.info-b-3-s,.info-b-4-s').mouseup(function(){//after click
		zis = $(this).attr('class');
		if(close == false){//did he want to close it after click
			var infowait = setTimeout(function(){
				info('hide');
			},100);
			infowait;
		}
		switch(zis){//what to say after click
			case 'info-b-1':inforet = 'ok';break;
			case 'info-b-2-y':inforet = 'yes';break;
			case 'info-b-2-n':inforet = 'no';break;
			case 'info-b-3-s':inforet = $('.info-b-3-i').val();break;
			case 'info-b-4-s':$(rd).val($('.info-b-4-i').val());break;
			default:inforet = 'undefined';
		}
		console.log(inforet);
		if(event == '*'|| inforet == event){
			callback(inforet);//do wothever he want
		}
	});
}
clickbletr = function(){
	/*$('tr').on('click',function(){
		$('.th').click(function(){
			return false;
		});
		if($(this).attr('num')){
			n = $(this).attr('num');
			//console.log(n);
		}
	})*/
	$('tr td').on('click',function(){
		id = $(this).parents('tr').attr('num');
		d = $(this).parents('tr').children('.d').text();
		c = $(this).parents('tr').children('.c').attr('full');
		n = $(this).parents('tr').children('.n').text();
		s = $(this).parents('tr').children('.s').attr('full');
		wwin(id,d,c,n,s);
		win('open');
	});
}
$(document).ready(function(){start()});
