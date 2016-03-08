//TeddyFrost©
//if you want to use this code please contact me : r2d2f9@gmail.com
//using this code without contact me is a theft!

var start = function() {//main function
	treeright = 0;
	scale();
	$(window).scroll(function (){
			return false;
	});
	$(window).resize(function(){scale();});
	//
	$('head').append('<style>#progbar:before{width: '+ $('#info').attr('percent') +'%;}</style>');
	//$('#progbar').before().css('width',$('#info').attr('percent')+'%');
	$('tr').on('click',function(){
		$('.th').click(function(){
			return false;
		});
		if($(this).attr('num')){
			n = $(this).attr('num');
			console.log(n);
		}
	});
	$('tr td').on('click',function(){
		id = $(this).parents('tr').attr('num');
		d = $(this).parents('tr').children('.d').text();
		c = $(this).parents('tr').children('.c').attr('full');
		n = $(this).parents('tr').children('.n').text();
		s = $(this).parents('tr').children('.s').attr('full');
		wwin(id,d,c,n,s);
		win('open');
	});
	$('#win').click(function(){
		win('close');
	});
}//end main function
win = function(c){
	switch(c){
		case 'open':$('#win').fadeIn('300');$('#toppanel').fadeIn('300');break;
		case 'close':$('#win').fadeOut('300');$('#toppanel').fadeOut('300');break;
		case 'clear':$('#win').text();break; 
		default:console.log('ERROR! Comand is not exists.');break;
	}
}
wwin = function(id,d,c,n,s){
	console.log('Open win num:'+id);
	$('#wdate').val(d);
	$('#wnumber').val(c);
	$('#wchapters').val(n);
	$('#wdescription').text(s);
}
scale = function(){
	if($(window).width() > 700){//for PS screen
	}else{//for phone
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

$(document).ready(function(){start()});