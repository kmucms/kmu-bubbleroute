(function ($) {

  function uloadFile($button, $fileInput, endpointUrl, $resultInput, $image)
  {
    $button.on('click', function () {
      $fileInput.trigger('click');
    });
    $fileInput.on('change', function () {
      $button.addClass('loading');
      var file = $fileInput.get(0).files[0],
              formData = new FormData();

      formData.append('file', file);
      $.ajax({
        url: endpointUrl,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        data: formData,
        xhr: function ()
        {
          var jqXHR = null;
          if (window.ActiveXObject)
          {
            jqXHR = new window.ActiveXObject("Microsoft.XMLHTTP");
          } else
          {
            jqXHR = new window.XMLHttpRequest();
          }
          //Upload progress
          jqXHR.upload.addEventListener("progress", function (evt)
          {
            if (evt.lengthComputable)
            {
              var percentComplete = Math.round((evt.loaded * 100) / evt.total);
              //Do something with upload progress
              console.log('Uploaded percent', percentComplete);
            }
          }, false);
          //Download progress
          jqXHR.addEventListener("progress", function (evt)
          {
            if (evt.lengthComputable)
            {
              var percentComplete = Math.round((evt.loaded * 100) / evt.total);
              //Do something with download progress
              console.log('Downloaded percent', percentComplete);
              //$resultInput.val(percentComplete);
            }
          }, false);
          return jqXHR;
        },
        success: function (data)
        {
          //var result = JSON.parse(data);
          //Do something success-ish
          //console.log('Completed.');
          $resultInput.val(data);
          $button.removeClass('loading');
          $image.attr('src', data);
        }
      });
    });
  }

  function appendEvents($region) {

    $region.find('.§-').each(function () {
      var $input = $(this);
      uloadFile(
              $input.find(".§-upload"),
              $input.find(".§-file"),
              $input.attr("data-upload"),
              $input.find(".§-result"),
              $input.find(".§-img")
              );
    });
  }

  $(document).ready(function () {
    appendEvents($('body'));
  });

})(jQuery);



