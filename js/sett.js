//sett.js 
//script to controll and saving sattings
savingsettings = function(){
	console.log('save strt');
	//vars
	n = $('#sett-name').val();
	e = $('#sett-email').val();
	p1 = $('#sett-pass1').val();
	p2 = $('#sett-pass2').val();
	if(p1.length <1 || p2.length < 1){
		p1 = '';
		p2 = '';
	}
	if($('#sett-name').willValidate == true && $('#sett-email').willValidate == true){
		console.log('GO!');		
	}
}