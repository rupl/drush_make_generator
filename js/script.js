/* 
Drushmake.me jQuery
*/

$(function(){

  // UI
  
  // release drop-downs are disabled until you check each module
  $('input[type="checkbox"]').change(function(e){
    if (this.checked){
      $(this).siblings('select').attr('disabled','');
    }else{
      $(this).siblings('select').attr('disabled','disabled');
    }
  });

  // prevent live drop-down clicks from bubbling up to the checkbox event
  $('label select').click(function(){return false; });
  
  // prevent spellcheck in makefile textarea
  $('#makefile').attr('spellcheck',false);
  
  
  // Validation
  
  // you have to select a core at the very least. all other config is optional.
  $('#generateForm').submit(function(e){
    var n = $('.fs-core input:checked').length;
    if(n == 0){
      alert('You forgot to select a core! ');
      e.preventDefault();
    }
  });
  
});





















