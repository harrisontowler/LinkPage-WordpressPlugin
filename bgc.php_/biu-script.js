jQuery(document).ready(function($) {
  var submitType = '';
  var originalBgImage = ''; // Keep track of the original background image

  // Attach a click event handler to the buttons
  $('#biu-form input[type=submit]').click(function() {
    // Update the submitType variable with the name of the clicked button
    submitType = $(this).attr('name');
  });

  $('#biu-form').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData();
    formData.append('action', 'biu_save_data');
    formData.append('nonce', biu_vars.nonce);

    if (submitType === 'biu-submit-color' && $('#biu-color').val()) {
      formData.append('biu-color', $('#biu-color').val());
    }

    if (submitType === 'biu-submit-image' && $('#biu-image').val()) {
      console.log($('#biu-image')[0].files[0]); // Debugging statement to check the file object
      formData.append('biu-image', $('#biu-image')[0].files[0]);
    }

    if (submitType) {
      formData.append('biu-submit-type', submitType);

      $.ajax({
        url: biu_vars.ajax_url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          console.log(response); // Debugging information
          if (response.success) {
            if (submitType === 'biu-submit-color') {
              alert('Color selected successfully!');
              location.reload();
            } else if (submitType === 'biu-submit-image') {
              alert('Image uploaded successfully!');
              location.reload();
            }
          } else {
            alert('Error: ' + response.data);
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText); // Debugging information
          console.log(status); // Debugging information
          console.log(error); // Debugging information
        }
      });
    }
  });

  // Add an event listener for the color input field's input event
  $('#biu-color').on('input', function() {
    // If there is a background image, save it and remove it
    if ($('body').css('background-image') !== 'none') {
      originalBgImage = $('body').css('background-image');
      $('body').css('background-image', 'none');
    }

    // Change the background color of the body to the selected color
    $('body').css('background-color', $(this).val());
  });
});
