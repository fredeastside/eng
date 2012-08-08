$(document).ready(function(){
	$('input.fieldfocus,textarea.fieldfocus').fieldFocus();
	
        //$( "#datepicker" ).datepicker();
});

function setSearch(){
    $('form#search').submit();
}

function getDate(obj){
    $("#select_date").html('<input name="filter[event_date]" value="" id="datepicker" />');
    //$("#datepicker").focus(function(){ $("#datepicker").datepicker('show'); });
    $("#datepicker").datepicker();
    $("#datepicker").datepicker('show');
}
