(function ($) {


  function appendEventsOne($item) {
    $item.on("click", ".§-cover",function(){
        $item.find(".§-container").html($item.attr('data-yt'));
    });
  }

  function appendEvents($region) {
    $region.find('.§-area').each(function () {
      appendEventsOne($(this));
    });
  }

  $(document).ready(function () {
    appendEvents($('body'));
  });

})(jQuery);




