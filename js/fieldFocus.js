/*
*
*  JQuery fieldFocus 1.0
*  
*  http://wdevblog.net.ru
*
*/


$.fn.fieldFocus = function(){
  function formCheeck(form,field,val){
    $(form).bind('submit',function(){
      if($(field).val()==val){
        $(field).val('');
      }
      return true;
    });
  }
  function findForm(elem){
    var form = $(elem).parent();
    if($(form).is('form')==false){
      return findForm(form);
    }else{
      return form;
    }
  }
  $(this).each(function(i){
    var value = $(this).attr('title');
    if($(this).is(':password')){
      var passInput = $(this);
      var inputStyle = $(this).attr('style') ? $(this).attr('style') : '';
      $(passInput).after('<input type="text" class="'+$(passInput).attr('class')+'" value="'+value+'" title="'+$(passInput).attr('title')+'" style="'+inputStyle+'">');
      var textInput = $(this).next();
      if($(passInput).val()==''){
        $(passInput).val("").hide();
      }else{
        $(textInput).hide();
      }
      $(textInput).focus(function(){
        if($(this).val()==value || $(this).val()==''){
          $(passInput).show().focus();
          $(this).hide();
        }
      });
      $(passInput).blur(function(){
        if($(this).val()==""){
          $(this).hide();
          $(textInput).show();
        }
      });
    }else{
      if($(this).val()=='')
        $(this).val(value);
      $(this)
      .focus(function(){
        if($(this).val()==value || $(this).val()==''){
          $(this).val("");
        }
      })
      .blur(function(){
        if($(this).val()=="")
          $(this).val(value);
      });
    }
    var thisForm = findForm($(this));
    formCheeck(thisForm,$(this),value);
  });
  return this;
}