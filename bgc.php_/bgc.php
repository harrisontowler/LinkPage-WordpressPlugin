<?php
/*
Plugin Name: Background Image Uploader
Plugin URI: https://www.example.com/background-image-uploader
Description: Allows users to upload and set a background image for the webpage where the shortcode is applied.
Version: 1.0
Author: Your Name
Author URI: https://www.example.com
License: GPL2
Text Domain: background-image-uploader
*/

function biu_create_form() {
  if (is_user_logged_in()) {
    $current_user_id = get_current_user_id();
    $profile_user_id = get_query_var('author');

    if ($current_user_id == $profile_user_id) {
      $form = '
      <form id="biu-form" method="post" enctype="multipart/form-data" style="text-align: center;">
        <div class="upload-btn">
          <input style="display: none;" type="file" name="biu-image" id="biu-image">
          <label for="biu-image" style="cursor:pointer; border-radius:50%; padding: 10px; background-color: #ccc;">➕</label>
        </div><br>
        <div class="button-container">
          <input type="submit" name="biu-submit-image" style="border-radius:15px;" value="' . __('Apply Image', 'background-image-uploader') . '">
          <input type="submit" name="biu-submit-color" style="border-radius:15px;" value="' . __('Apply Color', 'background-image-uploader') . '">
          <input type="submit" name="biu-submit-gradient" style="border-radius:15px;" value="' . __('Apply Gradient', 'background-image-uploader') . '">
        </div>
        <div class="color-btn">
          <label for="biu-color">' . __('Solid Color', 'background-image-uploader') . '</label>
          <input type="color" name="biu-color" id="biu-color">
        </div>
        <div class="color-btn">
        
          <label for="biu-color2">' . __('Gradient Bottom', 'background-image-uploader') . '</label>
          <input type="color" name="biu-color2" id="biu-color2">
          <label for="biu-color1">' . __('Gradient Top', 'background-image-uploader') . '</label>
          <input type="color" name="biu-color1" id="biu-color1">
        
        </div>
        <input type="hidden" name="biu-user-id" value="' . $current_user_id . '">
        ' . wp_nonce_field('biu_upload_data', 'biu_data_nonce', true, false) . '
      </form>';
    } else {
      $form = ''; // Empty form if viewing another user's page
    }

    return $form;
  }
  return '';
}

add_shortcode('biu_form', 'biu_create_form');

function biu_save_data() {
  check_ajax_referer('biu_upload_data', 'nonce');

  $user_id = is_user_logged_in() ? get_current_user_id() : -1; // Set a default user ID for logged out users
  if (isset($_POST['biu-user-id']) && current_user_can('edit_user', $_POST['biu-user-id'])) {
    $user_id = $_POST['biu-user-id'];
  }

  if (isset($_POST['biu-color'])) {
    $color = sanitize_hex_color($_POST['biu-color']);
    update_user_meta($user_id, 'biu_background_color', $color);
    delete_user_meta($user_id, 'biu_background_image'); // Delete the background image if a color is selected
    delete_user_meta($user_id, 'biu_background_color1'); // Delete the gradient colors
    delete_user_meta($user_id, 'biu_background_color2');
    wp_send_json_success($color);
  } elseif (!empty($_FILES['biu-image']['tmp_name'])) {
    $uploadedfile = $_FILES['biu-image'];

    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

    if ($movefile && !isset($movefile['error'])) {
      update_user_meta($user_id, 'biu_background_image', $movefile['url']);
      delete_user_meta($user_id, 'biu_background_color'); // Delete the background color if an image is uploaded
      delete_user_meta($user_id, 'biu_background_color1'); // Delete the gradient colors
      delete_user_meta($user_id, 'biu_background_color2');
      wp_send_json_success($movefile['url']);
    } else {
      wp_send_json_error($movefile['error']);
    }
  } elseif (isset($_POST['biu-color1']) && isset($_POST['biu-color2'])) {
    $color1 = sanitize_hex_color($_POST['biu-color1']);
    $color2 = sanitize_hex_color($_POST['biu-color2']);
    update_user_meta($user_id, 'biu_background_color1', $color1);
    update_user_meta($user_id, 'biu_background_color2', $color2);
    delete_user_meta($user_id, 'biu_background_image'); // Delete the background image if a gradient is selected
    delete_user_meta($user_id, 'biu_background_color'); // Delete the background color

    $gradient_data = array(
      'color1' => $color1,
      'color2' => $color2
    );

    wp_send_json_success($gradient_data);
  }

  wp_die();
}


add_action('wp_ajax_biu_save_data', 'biu_save_data');

function biu_show_background($atts) {
  $user_id = is_user_logged_in() ? get_current_user_id() : -1; // Set a default user ID for logged out users
  if (isset($atts['user_id']) && is_numeric($atts['user_id'])) {
    $author_id = $atts['user_id'];
    $background_image = get_user_meta($author_id, 'biu_background_image', true);
    $background_color = get_user_meta($author_id, 'biu_background_color', true);
    $background_color1 = get_user_meta($author_id, 'biu_background_color1', true);
    $background_color2 = get_user_meta($author_id, 'biu_background_color2', true);
  } else {
    // Get the current user ID when viewing their own profile
    $current_user_id = get_current_user_id();
    // Get the profile user ID when viewing another user's profile
    $profile_user_id = get_query_var('author');

    // Use the profile user ID if it exists, otherwise use the current user ID
    $user_id = $profile_user_id ? $profile_user_id : $current_user_id;

    $background_image = get_user_meta($user_id, 'biu_background_image', true);
    $background_color = get_user_meta($user_id, 'biu_background_color', true);
    $background_color1 = get_user_meta($user_id, 'biu_background_color1', true);
    $background_color2 = get_user_meta($user_id, 'biu_background_color2', true);
  }

  $output = '';

  if ($background_image) {
    // Preload the background image
    $output .= '<link rel="preload" href="' . esc_url($background_image) . '" as="image" />';

    // Generate the inline styles in the header
    $output .= '<style>
                   body::before {
                     content: "";
                     position: fixed; 
                     top: 0;
                     left: 0;
                     height: 100vh; 
                     width: 100vw; 
                     z-index: -1; 
                     background-image: url("' . esc_url($background_image) . '");
                     background-size: cover;
                     background-position: center;
                   }
                 </style>';
  }

  if ($background_color) {
    $output .= '<style>
                   body {
                     background-color: ' . esc_attr($background_color) . ';
                   }
                 </style>';
  }

  if ($background_color1 && $background_color2) {
    $output .= '<style>
                   body {
                     background: linear-gradient(to bottom, ' . esc_attr($background_color1) . ', ' . esc_attr($background_color2) . ');
                   }
                 </style>';
  }

  return $output;
}

add_shortcode('biu_show_background', 'biu_show_background');

function biu_enqueue_scripts() {
  wp_enqueue_script('biu-script', plugins_url('biu-script.js', __FILE__), array('jquery'), '1.0', true);
  wp_localize_script('biu-script', 'biu_vars', array(
    'background_image' => get_user_meta(get_current_user_id(), 'biu_background_image', true),
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('biu_upload_data')
  ));
}

add_action('wp_enqueue_scripts', 'biu_enqueue_scripts');
