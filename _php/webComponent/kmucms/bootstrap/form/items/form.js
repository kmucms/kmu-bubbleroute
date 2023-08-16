(function ($) {

  function inputToArea($input, $area, $item) {
    var elems;
    try {
      elems = JSON.parse($input.val());
    } catch (e) {
      elems = {};
    }
    for (var x in elems) {
      var $new = $('.jstemplate .§-item').clone();
      for (var y in elems[x]) {
        if ($new.find('[data-name=' + y + ']').attr('type') === "checkbox") {
          $new.find('[data-name=' + y + ']').prop("checked", elems[x][y] === 1);
        } else {
          $new.find('[data-name=' + y + ']').val(elems[x][y]);
        }
      }
      $area.append($new);
      $new.find('select.§-type').trigger( "change" );
    }
  }

  function areaToInput($input, $area) {
    var $items = $area.find('.§-item');
    var res = [];
    $items.each(function () {
      var item = {};
      $(this).find('input,select,textarea').each(function () {
        var $input = $(this);
        if ($input.attr('type') === 'checkbox') {
          item[$input.attr('data-name')] = $input.is(':checked')?1:0;
        } else {
          item[$input.attr('data-name')] = $input.val();
        }
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
    var $addButton = $item.find('.§-add');
    $area.sortable();
    $area.on("sortupdate", function (event, ui) {
      areaToInput($input, $area);
    });
    $addButton.click(function () {
      var $new = $itemTemplate.clone();
      $new.find('[data-name=id]').val('id' + Date.now());
      $area.append($new);
      areaToInput($input, $area);
    });
    $area.on("click", ".§-remove", function () {
      $(this).closest('.§-item').remove();
      areaToInput($input, $area);
    });
    $area.on("change", "input,select,textarea", function () {
      areaToInput($input, $area);
    });
    $area.on("change", "select.§-type", function () {
      if(['select','multiselect'].includes($(this).val())){
        $(this).closest('.§-item').find('.§-options').show();
      }else{
        $(this).closest('.§-item').find('.§-options').hide();
      }
    });
    inputToArea($input, $area, $item);
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



