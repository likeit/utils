var inp  = [];	//Здесь будут хранится input'ы с пустыми значениями
var sel = [];	//Здесь будут хранится select'ы с пустыми значениями

var AnimateSpeed = 200;

$(document).ready(function(){
	$(".menu > li").click(function(e){
		$(".menu li").removeClass("active");
		$(".content").css("display", "none");
		$(e.target).addClass("active");
		$(".content."+e.target.id).css("display", "block");
		return false;
	});
});

function submitOnEnter (event, formElem) {
    if (event.keyCode == 13) document.login_form.submit();
}

function jumpOnEnter (event, formElem) {
	if (event.keyCode == 13) {
		var target=event.target;
		
		if (target.tagName=='INPUT'||target.tagName=='SELECT'||target.tagName=='TEXTAREA'){
			var next=target.nextSibling;
			
			while (next.tagName!='INPUT' && next.tagName!='SELECT' && next.tagName!='TEXTAREA') {
	
				if (next.nextSibling) {
					next=next.nextSibling;
				} else {
					next=next.parentNode.firstChild.nextSibling;
				};
			
			};
			
			next.focus();
		};
	};
}

/*	Проверка на заполненность.
	Пареметр container - id или класс контейнера,
	внутри которого проводить валидацию                  */

function findtitle(obj) {
	return $('#'+obj+'_label');
};
   
function validate(container){
	inp = [];
	sel = [];
	
	$('#' + container + ' input.req').each(function(i) {
		if ($(this).val()=="") {
			inp[inp.length] = this.name;
			findtitle(this.name).addClass('invalid');
		} else {
			findtitle(this.name).removeClass('invalid');
		};
	});

	$('#' + container + ' select.req').each(function() {
		if ($(this)[0].selectedIndex==0	) {
			sel[sel.length] = this.name;
			findtitle(this.name).addClass('invalid');
		} else {
			findtitle(this.name).removeClass('invalid');
		};
	});

/*	if ((inp.length==0) && (sel.length==0)) {
		$('#savebutton').removeClass('disabled');
	} else {
		$('#savebutton').addClass('disabled');
	};//*/
};

/* Включает валидацию для элементов с классом "req" */
/*function enable_validation { 
	var containers = ['tab1','tab2','tab3'];
//	$.each('#'+ container + ' input.req';
};*/

function CheckAll(container){
	validate(container);
	
	var notify = $('#notify');
	if ((inp.length==0) && (sel.length==0)) {
		notify.removeClass('failed');
		notify.addClass('success');
		notify.text('Всё гут!');
	} else {
		notify.removeClass('success');
		notify.addClass('failed');
		notify.html('Проверьте правильность заполнения полей:\n\n');
		$(inp).each(function (i){notify.append('<li>' + findtitle(inp[i]).text().slice(0,-1) + '</li>');});
		$(sel).each(function (i){notify.append('<li>' + findtitle(sel[i]).text().slice(0,-1) + '</li>');});
	};
};

function highlightInvalid() {
	$('#' + container + ' input.req').each(function(i) {
		if ($(this).val()=="") {
			inp[inp.length] = this.name;
			findtitle(this.name).addClass('invalid');
		} else {
			findtitle(this.name).removeClass('invalid');
		};
	});

	$('#' + container + ' select.req').each(function() {
		if ($(this)[0].selectedIndex==0	) {
			sel[sel.length] = this.name;
			findtitle(this.name).addClass('invalid');
		} else {
			findtitle(this.name).removeClass('invalid');
		};
	});
};