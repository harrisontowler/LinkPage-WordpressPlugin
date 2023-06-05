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
        </div>
        <div class="button-container">
          <input type="submit" name="biu-submit-image" style="border-radius:15px;" value="' . __('Apply Image', 'background-image-uploader') . '">
          <input type="submit" name="biu-submit-color" style="border-radius:15px;" value="' . __('Apply Color', 'background-image-uploader') . '">
        </div>
        <div class="color-btn" >
          <label for="biu-color">' . __('Select Color', 'background-image-uploader') . '</label>
          <input type="color" name="biu-color" id="biu-color">
      
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
         <input class="color1" id="biu-color" type="color" name="color1" value="#ff0000">
  <input class="color2" id="biu-color2" type="color" name="color2" value="#ffff00">
  
<script>
  var css = document.querySelector("h3");
var color1 = document.querySelector(".color1");
var color2 = document.querySelector(".color2");
var body = document.getElementById("gradient");
var button = document.querySelector("button");

function setGradient(){
  body.style.background = "linear-gradient(to right, " + color1.value + ", " + color2.value + ")";
  css.textContent = body.style.background + ";"
};

function randomGradient(){
  var x1 = Math.floor(Math.random() * 256);
  var y1 = Math.floor(Math.random() * 256);
  var z1 = Math.floor(Math.random() * 256);

  var x2 = Math.floor(Math.random() * 256);
  var y2 = Math.floor(Math.random() * 256);
  var z2 = Math.floor(Math.random() * 256);

  var bgColor1 = "rgb(" + x1 + "," + y1 + "," + z1 + ")";
  var bgColor2 = "rgb(" + x2 + "," + y2 + "," + z2 + ")";

  body.style.background = "linear-gradient(to right, " + bgColor1 + ", " + bgColor2 + ")";
  css.textContent = body.style.background + ";"
}

color1.addEventListener("input", setGradient);
color2.addEventListener("input", setGradient);
button.addEventListener("click", randomGradient);
  </script>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
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
    wp_send_json_success($color);
  } elseif (!empty($_FILES['biu-image']['tmp_name'])) {
    $uploadedfile = $_FILES['biu-image'];

    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

    if ($movefile && !isset($movefile['error'])) {
      update_user_meta($user_id, 'biu_background_image', $movefile['url']);
      delete_user_meta($user_id, 'biu_background_color'); // Delete the background color if an image is uploaded
      wp_send_json_success($movefile['url']);
    } else {
      wp_send_json_error($movefile['error']);
    }
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
  } else {
    // Get the current user ID when viewing their own profile
    $current_user_id = get_current_user_id();
    // Get the profile user ID when viewing another user's profile
    $profile_user_id = get_query_var('author');

    // Use the profile user ID if it exists, otherwise use the current user ID
    $user_id = $profile_user_id ? $profile_user_id : $current_user_id;

    $background_image = get_user_meta($user_id, 'biu_background_image', true);
    $background_color = get_user_meta($user_id, 'biu_background_color', true);
  }

  $output = '';

  if ($background_image) {
    // Preload the background image
    $output .= '<link rel="preload" href="' . esc_url($background_image) . '" as="image" />';

    // Generate the inline styles in the header
    $output .= '<style>
                   body {
                     background-image: url("' . esc_url($background_image) . '");
                     background-size: cover;
                     background-attachment: fixed; // Added this line
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
