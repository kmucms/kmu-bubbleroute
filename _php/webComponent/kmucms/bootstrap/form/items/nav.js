(function ($) {

  function inputToArea($input, $area) {
    var elems;
    try {
      elems = JSON.parse($input.val());
    } catch (e) {
      elems = {};
    }
    for (var x in elems) {
      var $item = $('.jstemplate .§-item').clone();
      for (var y in elems[x]) {
        $item.find('[data-name=' + y + ']').val(elems[x][y]);
      }
      $area.append($item);
    }
  }

  function areaToInput($input, $area) {
    var $items = $area.find('.§-item');
    var res = [];
    $items.each(function () {
      var item = {};
      $(this).find('input,select,textarea').each(function () {
        var $input = $(this);
        item[$input.attr('data-name')] = $input.val();
      });
      res.push(item);
    });
    $input.val(JSON.stringify(res));
  }

  function appendEventsOne($item) {
    var $input = $item.find('.§-input');
    var $area = $item.find('.§-area');
    var $itemTemplate = $('.§-item');
    $area.html('');
    inputToArea($input, $area);
    var $addButton = $item.find('.§-add');
    $area.sortable();
    $area.on( "sortupdate", function( event, ui ) {areaToInput($input, $area);} );
    $addButton.click(function () {
      var $new = $itemTemplate.clone();
      $new.find('.§-remove').click(function () {
        //$(this).closest('.§-item').remove()
      });
      $area.append($new);
    });
    $area.on("click", ".§-remove", function () {
      $(this).closest('.§-item').remove();
      areaToInput($input, $area);
    });
    $area.on("change", "input,select,textarea", function () {
      areaToInput($input, $area);
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



