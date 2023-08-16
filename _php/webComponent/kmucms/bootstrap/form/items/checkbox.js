(function ($) {

 
  function appendEvents($region) {

    $region.find('.§-').each(function () {
      var $input = $(this);
      var $checkbox = $input.find('.§-checkbox');
      var $value = $input.find('.§-value');
      $checkbox.change(function(){
          if($checkbox.is(':checked')){
              $value.val(1);
          }else{
              $value.val(0);
          }
      });
    });
  }

  $(document).ready(function () {
    appendEvents($('body'));
  });

})(jQuery);



