//index.js
main = function(){
	$(document).scroll(function(){
		scroll = $(this).scrollTop();
		$('#logo').css('margin-top',scroll/3);
		$('#sitename').css('margin-bottom' ,-scroll/1+200+'px');
		hbtr = (1/$(window).height())* scroll *3
		$('header').css('background','rgba(70,70,70,'+hbtr+')');
	});
}
$(document).ready(function(){main()});