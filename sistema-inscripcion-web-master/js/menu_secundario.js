$(document).ready(function() {
	$(".menu1").hide();
	$(".menu2").hide();
	$(".menu3").hide();
	$(".menu4").hide();
	$(".menu5").hide();

	$(".p1").click(function(){
    	$(".menu1").slideToggle();
	});

	$(".p2").click(function(){
    	$(".menu2").slideToggle();
	});

	$(".p3").click(function(){
    	$(".menu3").slideToggle();
	});

	$(".p4").click(function(){
    	$(".menu4").slideToggle();
	});

	$(".p5").click(function(){
    	$(".menu5").slideToggle();
	});
})
