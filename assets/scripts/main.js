(function ($) {
  'use strict';

	$('form').submit(function(e) {
      e.preventDefault();

      var $form = $(this);
      var $btn = $('button[type="submit"]', $form);
      var btnTxt = $btn.text();

      //show some response on the button
      $btn.prop('type','button' );
      $btn.text('Sending ...');

      $('#error_message').hide();

      $.ajax({
              type: 'POST',
              url: $form.attr('action'),
              data: $form.serialize(),
              dataType: 'json'
          })
          .done(function (data) {
              $('#error_message').hide();
              $('#success_message').text(data.message).show();
              $form.hide();
          })
          .fail(function (data, foo) {
              $('#success_message').hide();
              $('#error_message').text(data.responseJSON.message).show();

              $btn.text(btnTxt);
              $btn.prop('type', 'submit');
          });

    });


})(jQuery);
