$(document).ready(function(){	
	$(".menuitem A").hover(function() {
		parentID = parseInt( $(this).attr("rel") );
		$(".child-menu").hide();
		
		$("#child-"+parentID).show();
	},
	function() {
		$(".child-menu").hide();
	}
	);
	$(".child-menu").hover(function() {
		$(this).show();
	},
	function() {
		$(this).hide();
	})
	
	if($("#in_menu").val() == "0")
		$("#in_menu").removeAttr("checked");
	
	$("#in_menu").click(function(){
		if($(this).is(":checked"))
			$("#inmenu").val("1");
		else
			$("#inmenu").val("0");
	});
        
        if($("#in_main").val() == "0")
		$("#in_main").removeAttr("checked");
	
	$("#in_main").click(function(){
		if($(this).is(":checked"))
			$("#main").val("1");
		else
			$("#main").val("0");
	});
	
	
	// ����� ����
	function toggleMenu(obj) {
		parentID = parseInt( $(obj).attr("rel") );
		if( $('#child-left-'+parentID).css('display') == 'none'){
			$(obj).addClass("active");
			$('#child-left-'+parentID).show();
		}else{
			$(obj).removeClass("active");
			$('#child-left-'+parentID).hide();
		}
	
		return false;
	}
	
	$(".menu-left-main").click(function() {
		return toggleMenu(this);
	});
	
	$(".menu-left-main").each(function() {
		if($(this).hasClass("active")){
			toggleMenu(this);
		}
	});
// ����� ����

	$('.plus_parent').live('click',function(){
		if($(this).attr('rel')=='plus'){
			$(this).attr('rel','minus');
			$(this).attr('src','/images/admin/munes.gif');
			$(this).parent().parent().find('ul').hide();
		}
		else{
			$(this).attr('rel','plus');
			$(this).attr('src','/images/admin/plus.gif');
			$(this).parent().parent().find('ul:eq(0)').show();
		}
	});
	
	$('#topmenu a span').hover(
		function(){
			$('#topmenu a').removeClass('active');
			$(this).parent('a').addClass('active');
		},
		function(){
			$('#topmenu a').removeClass('active');
			$('#topmenu a').each(function(){
				if($(this).attr('rel_active')=='active') $(this).addClass('active');
			});		
		}
	);
	$('#child-container .child-menu').hover(
		function(){
			var rel = $(this).attr('rel');
			$('#topmenu a').removeClass('active');
			$('#topmenu a').each(function(){
				if($(this).attr('rel')==rel) $(this).addClass('active');
			});
		},
		function(){
			$('#topmenu a').removeClass('active');
			$('#topmenu a').each(function(){
				if($(this).attr('rel_active')=='active') $(this).addClass('active');
			});		
		}
	);
	
});