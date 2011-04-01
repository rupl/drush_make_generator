/* 
js for http://drushmake.me
*/

// scopeless vars!
lastval = $('#fs-version :radio:checked').val();

$(function(){

  // UI
  
  // slide to on-page anchors
  $.localScroll({
    duration: 425,
    hash: true
  });
  
  // release drop-downs are disabled until you check each module
  $('input[type="checkbox"]').change(function(e){
    if (this.checked){
      $(this).siblings('select').attr('disabled','');
    }else{
      $(this).siblings('select').attr('disabled','disabled');
    }
  });

  // download type == cvs; disable URL input
  $('.download select.type').live('change',function(){
    if ($(this).val() == 'drupal'){
      $(this).siblings('input.url').attr('disabled','disabled');
    } else {
      $(this).siblings('input.url').attr('disabled','');    
    }
  });

  // prevent live drop-down clicks from bubbling up to the checkbox event
  $('label select').click(function(){return false; });
  
  // prevent spellcheck in makefile textarea
  $('#makefile').attr('spellcheck',false);
  
  
  // add another item
  $('.modules + a.another').live('click',function(){
    var obj = $(this);
    $.get('ajax.php?ask=modules',function(data){
      obj.siblings('.downloads').append(data);
    });
  });
  $('.themes + a.another').live('click',function(){
    var obj = $(this);
    $.get('ajax.php?ask=themes',function(data){
      obj.siblings('.downloads').append(data);
    });
  });
  $('.libraries + a.another').live('click',function(){
    var obj = $(this);
    $.get('ajax.php?ask=libraries',function(data){
      obj.siblings('.downloads').append(data);
    });
  });
  $('.includes + a.another').live('click',function(){
    var obj = $(this);
    $.get('ajax.php?ask=includes',function(data){
      obj.siblings('.downloads').append(data);
    });
  });
  
  // help keep focus when form elements are clicked
  $('input.url, select.type').live('focus',function(e){
    return false;
  });
  
  
  // remove this item
  $('a.remove').live('click',function(){
    $(this).parent().fadeOut(240,function(){$(this).remove();});
  });
  
  
  // alter name attributes as the user updates the "unique" field of each download
  $('.download .unique').live('change',function(){

    var unique = $(this).val();    
    console.log(unique);

    $(this)
      .attr('name',$(this).attr('name').replace(/\|(.*?)\|/,'|'+unique+'|'))            // this works for the CURRENT element only
      .siblings('input,select').each(function(){                                        
        $(this).attr('name',$(this).attr('name').replace(/\|(.*?)\|/,'|'+unique+'|'));  // this does each sibling, preserving the last index of each name attr
      });
      
  });
  
  
  // Major Version - form refresh
  // lastval is a scopeless var
  $('#fs-version :radio').click(function(){
    var $this = $(this);
    
    if ($this.val() != lastval && confirm('If you switch versions, your current progress will be lost! No undos..')) {      
      $.get(
        '/ajax.php?ask=all&v='+$this.val(),
        function(data){
          $('#generator').fadeOut(160,function(){
            $(this).html(data).fadeIn(240);
            $.scrollTo('#generate',425);
            lastval = $this.val();
        });
      });
    }
  });
  
  
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





















