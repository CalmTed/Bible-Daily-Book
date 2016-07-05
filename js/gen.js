//TeddyFrost©
//if you want to use this code please contact me : r2d2f9@gmail.com
//using this code without contact me is a theft!
//its a >12 hours of work here
gen = function() {//main function
	inforet = '',//info return
	ajxprcs = false;
	$(window).bind('hashchange', function(){//when hesh changing
		hash();	
	});
	$(window).resize(function(){scale();});//resize elements on page resize

	$(window).scroll(function (){
		scroll = $(this).scrollTop();
		$('#background img').css('top',-scroll/10);
		if(scroll>5000 && $('#arrtop.show').length<1){
			$('#arrtop').addClass('show');
		}else if(scroll<5000 && $('#arrtop.show').length>0){
			$('#arrtop').removeClass('show');
		}
		if(scroll>$(window).height()+($('#btbuttons').height()*2)+($('#teble h1').height()*2)){
			$('#table .th').css('position','fixed');
			$('#table .tr:nth-child(2)').css('margin-top','70px');
		}else{
			$('#table .th').css('position','relative');
			$('#table .tr:nth-child(2)').css('margin-top','0px');
		}
	});
	$('#arrtop').click(function(){//scroll top button
		$("body,html").animate({scrollTop:0}, 1000);
	});
	$(window).click(function(){//ajax processing indicator
		ajxprcsf();
	});
	scale();

}//end main function
scale = function(){
	if($(window).width() > 700){//for PS screen
		$('#wspan').css('height','0px');
	}else{//for phone
		$('#wspan').css('height',$('#win').height()/3);
	}
	//background
	wh = $(window).height();
	ww = $(window).width();
	$('#background').css('height',wh+'px');
	if(ww>wh){
		$('#background img').css('min-height','auto').css('min-width',$(window).width()+'px');
	}else{
		$('#background img').css('min-height',$(window).height()+'px').css('min-width','auto');
	}
	
	//content
	path = location.pathname;
	//dir = '/1/pr/10/';//for localhost
	dir = '/';
	if(path == dir+'u.php'||path  == dir+''){//for index and user.php only
		$('#content').css('margin-top',$(window).height()-$('#profile').height());
	}
	
	//for main page
	if($('#sitename').length>0){
		$('#content').css('margin-top','0');		
	}
	$('#win').css('height',$(window).height()-70);
	//footer
	$('footer').css('height',($(window).height/4));
}
info = function(c,t,n,wait,close,event,callback,secvar){
//info = function(c='none',t = 'no',n = 0,wait = 5000,close = false,event = '*',callback = function(){}){
//c - action(none,show,hide,toggle)
//t -text to show
//n - type of info(0-no change,1-ok,2-yes/no,3-'string',4-'********');
//wait - timeremaing before closing
//close did user want to ba able to close info box
//event - * do callback on any action(ok,yes,no,'string'...)
//callback - function on some action
//secvar - second var for callback
	if(t == undefined){t = 'no'}
	if(n == undefined){n = 1}
	if(wait == undefined){wait = 5000}
	if(close == undefined){close = false}
	if(event == undefined){event = '*'}
	if(callback == undefined){callback = function(){}}
	if(secvar == undefined){secvar = ''}
		if(typeof autohide !== 'undefined'){clearTimeout(autohide)};//stop previous wait
	if(t != 'no'){//write text or not
		$('#infow p').text(t);
	}
	if(c!='none'){//what to do
		switch(c){
				case 'show' :$('#infow').addClass('active'); break;
				case 'hide' :$('#infow').removeClass('active'); break;
				case 'toggle' :$('#infow').toggleClass('active'); break;
				case '' :$('#infow').toggleClass('active'); break;
				case 'help' :console.log('info( \n command(none,show,hide,toggle), \n text, \n type of info(0-no changes,1-ok,2-yes/no,3-sting,4-password), \n wait(milliseconds) dont close on 2,3,4 \n able to close(true-dont close/false - close on click), \n event(*,ok,yes,no,string) ot callback, \n callback function(event) \n secvar - second var for callback)'); break;
				default: info('show',c);break;
		}
	}
	if(n == 1&&c!='hide'){//how long show info
		autohide = setTimeout(function(){info('hide')},wait);
		autohide;
	}else{
		autohide = '';
	}
	if(n!=0){
		switch(n){//type of info window
				case 1 :$('.infobuttons').html('<div class="info-b-1">ОК</div>');break;
				case 2 :$('.infobuttons').html('<div class="info-b-2-y">Да</div><div class="info-b-2-n">Нет</div>');break;
				case 3 :$('.infobuttons').html('<input class="info-b-3-i"><div class="info-b-3-s">Далее</div>');break;
				case 4 :$('.infobuttons').html('<input type="password" class="info-b-4-i"><div class="info-b-4-s">Далее</div>');break;
				default:break;
		}
	}
	$('.info-b-1,.info-b-2-y,.info-b-2-n,.info-b-3-s,.info-b-4-s').mouseup(function(){//after click
		if(typeof autohide !== 'undefined'){clearTimeout(autohide)};//clear waitining
		zis = $(this).attr('class');
		if(close == false){//did he want to close it after click
			infowait = setTimeout(function(){
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
		//console.log(inforet);
		if(event == '*'|| inforet == event){
			callback(inforet,secvar);//do wothever he want
		}
	});
}
hash = function(){
	h = location.hash;
	if(h!=''){
		switch(h){
			case '#settings':tab('sett');break;
			case '#search':tab('search');break;
			case '#first':break;
			case '#second':break;
			case '#onone':h = '#new';
			case '#new':$('#wid').val('none');
								$('#wdate').val($('#info').attr('date'));
								$('#wpass').show();
								$('#topadd').hide();
								$('#topdelite').hide();
								$('#topedit').hide();
								$('#topsave').show();
								$('#topsave').val('new');
								$('head title').html('Новая запись - BibleDiary');
								win('edit');
								win('open');break;
			case '#list':	tab('list');
								win('close');break;
		}
		sh = h.substr(1,1);
		hn = h.substr(2,4);
		if(sh == 'o' && h != '#onone' && hn != ''){
			id = $('#r'+hn).attr('num');
			d = $('#r'+hn).children('.d').text();
			c = $('#r'+hn).children('.c').text();
			t = $('#r'+hn).children('.t').text();
			n = $('#r'+hn).children('.n').text();
			s = $('#r'+hn).children('.s').text();
			wwin(id,d,c,n,s,t);
			win('open');
		}
		if(h == '#rnone'){
			$('.tablnew').css('color','#eee');
		}else{
			$('.tablnew').css('color','inherit');
		}
	}else{
		if(location.pathname == '/1/pr/10/u.php'){
			location.hash = 'list';
		}
	}
}
ajxprcsf = function(mode,sender){//ajax procesing function
	if(mode == true){
		ajxprcs = true;
	}else if(mode == false){
		ajxprcs = false;
	}else{}
	if(ajxprcs == true){//showing indicator
		if($('#ajxprcs.show').length<1){
			if($('#ajxprcs').length<1){
				$('#fixedblocks').append('<div id="ajxprcs"><i class="fa fa-spinner fa-pulse"></i></div>');
			}else{
				$('#ajxprcs').addClass('show');
				if(tab() == 'sett'){//sett auth
					$('.settchckpass i').addClass('fa-pulse').addClass('fa-spinner');
				}
			}
		}
		if(sender == 'r'){//r - reload
			$('.tablreload i').addClass('fa-spinner').addClass('fa-pulse');
		}
	}else{//hiding loadings
		if(typeof tab !== 'undefined'){
			if($('#ajxprcs').length>0){
				$('#ajxprcs').removeClass('show');
			}
			if(tab() == 'sett'){//sett auth
				$('.settchckpass i').removeClass('fa-pulse').removeClass('fa-spinner');
			}
			if(sender == 'r'){//r - reload
				$('.tablreload i').removeClass('fa-spinner').removeClass('fa-pulse');
			}
		}
	}
	
}
$(document).ready(function(){gen()});