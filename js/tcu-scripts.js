jQuery(document).ready(function($) {
  var container = $('#tcu-text-container');

  if (container.length) {
    container.sortable({
      handle: '.handle',
      items: '.tcu-text-item',
      update: function(event, ui) {
        var order = container.find('.tcu-text-item').map(function() {
          return $(this).attr('id').replace('tcu-text-', '');
        }).get().join(',');

        $.ajax({
          url: tcu_vars.ajaxurl,
          type: 'POST',
          data: {
            action: 'tcu_save_order',
            nonce: tcu_vars.nonce,
            order: order,
          },
          success: function(response) {
            console.log('Order saved');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error saving order');
          },
        });
      },
    });

    container.disableSelection();
  }

  // Delete functionality
  container.on('click', '.delete-icon', function() {
    var item = $(this).closest('.tcu-text-item');
    var id = item.attr('id').replace('tcu-text-', '');

    $.ajax({
      url: tcu_vars.ajaxurl,
      type: 'POST',
      data: {
        action: 'tcu_delete_item',
        nonce: tcu_vars.nonce,
        item_id: id,
      },
      success: function(response) {
        if (response.success) {
          item.remove();
          console.log('Item deleted');
        } else {
          console.log('Error deleting item');
        }
      },
          error: function(jqXHR, textStatus, errorThrown) {
        console.log('Error deleting item');
      },
    });
  });

  // Toggle Spotify player
  $('.spotify-dropdown-btn').on('click', function() {
    const id = $(this).data('id');
    $('#spotify-widget-container-' + id).toggle();
  });
});







document.addEventListener('DOMContentLoaded', function () {
  const scDropdownBtns = document.querySelectorAll('.sc-dropdown-btn');

  scDropdownBtns.forEach(function (btn) {
    btn.addEventListener('click', function (event) {
      event.preventDefault();
      event.stopPropagation();
      const id = btn.getAttribute('data-id');
      const scWidgetContainer = document.getElementById(`sc-widget-container-${id}`);
      if (scWidgetContainer) {
        scWidgetContainer.style.display = scWidgetContainer.style.display === 'none' ? 'block' : 'none';
      } else {
        console.error(`Element with ID "sc-widget-container-${id}" not found.`);
      }
    });
  });
});

jQuery(document).ready(function($) {
  $('.spotify-dropdown-btn').on('click', function(e) {
    e.stopPropagation();
    e.preventDefault();
    // Your existing code for showing or hiding the Spotify widget
  });
});

// Function to toggle the visibility of the SoundCloud widget
function toggleSoundCloudWidget(event) {
  event.preventDefault();
  var id = jQuery(this).data('id');
  var widgetContainer = jQuery('#soundcloud-widget-container-' + id);
  widgetContainer.slideToggle();
}

// Attach the click event listener to the sc-dropdown-btn button
jQuery(document).on('click', '.sc-dropdown-btn', toggleSoundCloudWidget);

// YouTube dropdown button click event
jQuery('.youtube-dropdown-btn').on('click', function (e) {
  e.stopPropagation();
  e.preventDefault();
  var id = jQuery(this).data('id');
  var container = jQuery('#youtube-widget-container-' + id);
  container.slideToggle();
});

document.addEventListener('DOMContentLoaded', function() {
  const tcuForm = document.getElementById('tcu-form');
  const tcuText = document.getElementById('tcu-text');
  const tcuUrl = document.getElementById('tcu-url');
  const tcuColor = document.getElementById('tcu-color');
  const tcuBorderColor = document.getElementById('tcu-border-color');
  const tcuDivBgColor = document.getElementById('tcu-div-bg-color');
  const tcuBorderRadius = document.getElementById('tcu-border-radius');
  const tcuPreviewElement = document.getElementById('tcu-preview-element');

  if (tcuForm) {
    // Update the preview element styles based on user input
    const updatePreviewStyles = () => {
      tcuPreviewElement.style.color = tcuColor.value;
      tcuPreviewElement.style.borderColor = tcuBorderColor.value;
      tcuPreviewElement.style.borderWidth = '2px'; // Add this line
      tcuPreviewElement.style.borderStyle = 'solid'; // Add this line
      tcuPreviewElement.style.borderRadius = tcuBorderRadius.value + 'px';
      tcuPreviewElement.style.backgroundColor = tcuDivBgColor.value;
      tcuPreviewElement.innerHTML = tcuText.value || 'Text preview';
    };

    // Set initial preview styles
    updatePreviewStyles();

    // Add event listeners to the form inputs
    tcuText.addEventListener('input', updatePreviewStyles);
    tcuColor.addEventListener('input', updatePreviewStyles);
    tcuBorderColor.addEventListener('input', updatePreviewStyles);
    tcuDivBgColor.addEventListener('input', updatePreviewStyles);
    tcuBorderRadius.addEventListener('input', updatePreviewStyles);

    // Get the button element
    const button1 = document.getElementById('button1');

    if (button1) {
        button1.addEventListener('click', function() {
            // Set the input values to the styles you want
            tcuText.value = '';
            tcuColor.value = '#000000';
            tcuBorderColor.value = '#000000';
            tcuDivBgColor.value = '#FFFFFF';
            tcuBorderRadius.value = '10';

            // Dispatch an 'input' event on each of the input elements
            tcuText.dispatchEvent(new Event('input'));
            tcuColor.dispatchEvent(new Event('input'));
            tcuBorderColor.dispatchEvent(new Event('input'));
            tcuDivBgColor.dispatchEvent(new Event('input'));
            tcuBorderRadius.dispatchEvent(new Event('input'));
        });
    }
  }
});


jQuery(document).ready(function($) {
    // Force cursor to be after the "hutl.ink/" text
    $('#tcu-url').on('click', function() {
        if (this.selectionStart < 9) {
            this.selectionStart = this.selectionEnd = 9;
        }
    });

    // Prevent deletion of "hutl.ink/" text
    $('#tcu-url').on('keydown', function(e) {
        if (this.selectionStart <= 9 && (e.key === 'Backspace' || e.key === 'Delete')) {
            e.preventDefault();
        }
    });

    // Prevent the cursor from going before the "hutl.ink/" text
    $('#tcu-url').on('keyup', function() {
        if (this.selectionStart < 9) {
            this.selectionStart = this.selectionEnd = 9;
        }
    });
});









jQuery(document).ready(function() {
    jQuery(document).on('click', '.twitter-dropdown-btn', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var id = jQuery(this).data('id');
        var container = jQuery('#twitter-widget-container-' + id);

        if (container.is(':visible')) {
            container.slideUp();
        } else {
            container.slideDown();
        }
    });
});



// Initial counter setup
let linkCounters = new Map();

document.querySelectorAll('.tcu-text-item').forEach((item, index) => {
    // Initialize counter for this item or retrieve from localStorage
    let currentCount = localStorage.getItem(`counter${index}`);
    linkCounters.set(index, currentCount ? parseInt(currentCount) : 0);
  
    // Create a span element to display the click count
    let countSpan = document.createElement('span');
    countSpan.id = `counter${index}`;
    countSpan.style.marginLeft = '10px';
    countSpan.innerText = currentCount ? currentCount : 0;
    item.parentNode.insertBefore(countSpan, item.nextSibling);
  
    // Add click event listener
    item.addEventListener('click', function(e) {
        // Increment counter and update the display
        let count = linkCounters.get(index);
        linkCounters.set(index, ++count);
        localStorage.setItem(`counter${index}`, count); // store the updated counter value in localStorage
        document.getElementById(`counter${index}`).innerText = count;
    });
});





// Attach event listeners for updating the live preview

document.getElementById('tcu-text').addEventListener('input', tcu_update_preview);
document.getElementById('tcu-color').addEventListener('change', tcu_update_preview);
document.getElementById('tcu-border-color').addEventListener('change', tcu_update_preview);
document.getElementById('tcu-border-radius').addEventListener('input', tcu_update_preview);
