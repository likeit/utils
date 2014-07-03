/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@Co-author: Vladimir "megadozz" Kalinichev
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	$(".menu > li").click(function(e){
		$(".menu li").removeClass("active");
		$(".content").css("display", "none");
		$(e.target).addClass("active");
		$(".content."+e.target.id).css("display", "block");
		return false;
	});
});