/* feedback.js */
faq = function(){
	sc = 0;
	$('#backa').click(function(){
		if(window.history.length >0){
			window.history.back();
			return false;
		}else{
			
		}
	});
	$(window).scroll(function (){
		scrol = $(this).scrollTop();
		wh = $(window).height();
		whh = wh/100;
		if(scrol > wh+$('#f-answers').height()){
			if($('#f-menu').css('position') == 'fixed'){
				$('#f-menu').css('top',scrol+((wh/100)*15)).css('position','absolute');
				sc++;
			}
			if(sc == 10){
				info('show','Не надоело еще?',2,0,false,'no',info('Тогда можешь продолжать'));
			}
			if(sc == 50){
				setTimeout(function(){$('html').html('Молодец:'+sc+'раз')},20000);
				setTimeout(function(){info('show','5',1,1000);},15000);
				setTimeout(function(){info('show','4',1,1000);},16000);
				setTimeout(function(){info('show','3',1,1000);},17000);
				setTimeout(function(){info('show','2',1,1000);},18000);
				setTimeout(function(){info('show','1',1,900);},19000);
				info('show','Через 20 секунд страница самоуничтожится',14000);
			}
		}else{
			$('#f-menu').css('top','auto').css('position','fixed');
		}
	});
}

tab = function(){return 'no'}//for gen.js
$('window').ready(function(){faq();});