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
    } else if (submitType === 'biu-submit-image' && $('#biu-image').val()) {
      console.log($('#biu-image')[0].files[0]); // Debugging statement to check the file object
      formData.append('biu-image', $('#biu-image')[0].files[0]);
    } else if (submitType === 'biu-submit-gradient' && $('#biu-color1').val() && $('#biu-color2').val()) {
      formData.append('biu-color1', $('#biu-color1').val());
      formData.append('biu-color2', $('#biu-color2').val());
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
              console.log('Color applied successfully!');
              $('body').css('background', response.data);
              location.reload();
            } else if (submitType === 'biu-submit-gradient') {
              console.log('Gradient applied successfully!');
              location.reload();
            } else if (submitType === 'biu-submit-image') {
              console.log('Image uploaded successfully!');
              location.reload();
            }
          } else if (response.data && response.data.error) {
            console.log('Error: ' + response.data.error);
          } else {
            console.log('An error occurred while processing the request. Please try again later.');
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText); // Debugging information
          console.log(status); // Debugging information
          console.log(error); // Debugging information
          if (submitType === 'biu-submit-gradient' && xhr.status !== 200) {
            console.log('An error occurred while applying the gradient. Please check the input values and try again.');
          } else {
            console.log('An error occurred while processing the request. Please try again later.');
          }
        }
      });
    }
  });

  // Add an event listener for the color input field's input event
  $('#biu-color').on('input', function() {
    // Remove the gradient background if it exists
    $('body').css('background', 'none');

    // Change the background color of the body to the selected color
    $('body').css('background-color', $(this).val());
  });

  // Add event listeners for the color inputs of the gradient
  $('#biu-color1, #biu-color2').on('input', function() {
    var color1 = $('#biu-color1').val();
    var color2 = $('#biu-color2').val();
    var gradientValue = 'linear-gradient(to bottom, ' + color1 + ', ' + color2 + ')';

    // If there is an original background image, remove it
    if (originalBgImage !== '') {
      $('body').css('background-image', 'none');
    }

    // Remove the background color if it exists
    $('body').css('background-color', 'transparent');

    // Apply the gradient background to the body
    $('body').css('background', gradientValue);
  });
});
