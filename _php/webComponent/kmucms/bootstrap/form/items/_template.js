(function ($) {

  function inputToArea($input, $area) {

  }

  function areaToInput($input, $area) {

  }

  function appendEventsOne($item) {
    var $input = $item.find('.§-input');
    var $area = $item.find('.§-area');
    $area.html('');
  }

  function appendEvents($region) {
    $region.find('.§-').each(function () {
      appendEventsOne($(this));
    });
  }

  $(document).ready(function () {
    appendEvents($('body'));
  });

})(jQuery);



