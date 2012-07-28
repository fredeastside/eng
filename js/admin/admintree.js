function toObj(str){
	var arr = str.split(";");
	var obj = {};
	for(var i=0;i<arr.length;i++){
		var tmp = arr[i].split(":");
		obj[tmp[0]] = tmp[1];
	}
	return obj;
}
function setGeneralParent(from,to){
	
	// выставить одного родителя
	from = toObj(from);
	to = toObj(to);
	xajax_setGeneralParent(from['id'],to['id']);
	
}

function setParent(child,parent){
	// выставить родителя
	parent = toObj(parent);
	child = toObj(child);
	xajax_setParent(child['id'],parent['id']);
}

$(document).ready(function(){	
	
	// наведение 
	$("#tree li div").hover(function(){
		$(this).addClass("hover-li");
	},function(){
		$(this).removeClass("hover-li");
	});
	
	// драг 
	// для ie если сейчас какой то объект движется
	nowDraggable = false;
	$(".draggable").draggable({
		//containment: '#center',
		opacity: 0.9,
		handle: '.cursor-move',
		addClasses: "hide-action",
		helper: function(event, ui) {
			//if(nowDraggable){
				//$(this).remove();
			//	return;
			//}
			nowDraggable = !nowDraggable;
			return $(this).clone().find("div").eq(0).addClass("hide-action");
		},
		stop: function(event, ui) {
			//nowDraggable = false;
			;
		},
		tolerance: 'pointer' 
	}).disableSelection();
	
	$(".droppable div").droppable({
		hoverClass: 'ui-state-active-div',
		greedy: true,
		drop: function(event, ui) {
			nowDraggable = false;
			setGeneralParent(ui.draggable.attr("rel"),$(this).parent().attr("rel"));
			$(this).parent().after(ui.draggable);
		}
	});
	$(".droppable_inner").droppable({
		hoverClass: 'ui-state-active',
		greedy: true,
		drop: function(event, ui) {
			nowDraggable = false;
			setParent(ui.draggable.attr("rel"),$(this).parent().parent().attr("rel"));
			$(this).parent().parent().find(".children").eq(0).append(ui.draggable);
		}
	});
	
});