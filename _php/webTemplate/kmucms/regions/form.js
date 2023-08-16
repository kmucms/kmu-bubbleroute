(function ($) {


  function appendEventsOne($item) {
    $item.find('.§-submit').on("click", function (ev) {
      $.post($item.find('form').attr('action'), $item.find('form').serialize(), function (res) {
        $item.find('.§-error').html(res);
        if (res === '') {
          $item.find('.§-success').show();
          $item.find('.§-error').hide();
          $item.find('.§-submit').hide();
        } else {
          $item.find('.§-error').show();
        }
      });
      ev.stopPropagation();
      return false;
    });
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
