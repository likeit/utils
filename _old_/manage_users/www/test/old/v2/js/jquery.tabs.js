/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	$(".menu > li").click(function(e){
		switch(e.target.id){
			case "tab1":
				//change status & style menu
				$("#tab2").removeClass("active");
				$("#tab3").removeClass("active");
				$("#tab1").addClass("active");
				//display selected division, hide others
				$("div.tab2").css("display", "none");
				$("div.tab3").css("display", "none");
				$("div.tab1").css("display", "block");
			break;
			case "tab2":
				//change status & style menu
				$("#tab1").removeClass("active");
				$("#tab3").removeClass("active");
				$("#tab2").addClass("active");
				//display selected division, hide others
				$("div.tab1").css("display", "none");
				$("div.tab3").css("display", "none");
				$("div.tab2").css("display", "block");
			break;
			case "tab3":
				//change status & style menu
				$("#tab1").removeClass("active");
				$("#tab2").removeClass("active");
				$("#tab3").addClass("active");
				//display selected division, hide others
				$("div.tab1").css("display", "none");
				$("div.tab2").css("display", "none");
				$("div.tab3").css("display", "block");
			break;
		}
		//alert(e.target.id);
		return false;
	});
});