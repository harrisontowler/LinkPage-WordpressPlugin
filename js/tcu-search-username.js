jQuery(document).ready(function($) {
  $('#search-username-btn').on('click', function() {
    var username = $('#search-username-field').val();
    if (username) {
      $.ajax({
        url: search_username_vars.ajaxurl,
        type: 'post',
        data: {
          action: 'tcu_search_username',
          nonce: search_username_vars.nonce,
          username: username,
        },
        beforeSend: function() {
          $('#search-username-result').html('');
        },
        success: function(response) {
          $('#search-username-result').html(response.data);
        },
        error: function() {
          $('#search-username-result').html('Error');
        },
      });
    }
  });
});
