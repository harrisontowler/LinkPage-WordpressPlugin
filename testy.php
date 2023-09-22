<?php
/*
Plugin Name: Text Color Uploader
Plugin URI: https://www.example.com/text-color-uploader
Description: hello
Version: 1.0
Author: Your Name
Author URI: https://www.example.com
License: GPL2
Text Domain: text-color-uploader
*/







function tcu_create_form() {  
  if (is_user_logged_in()) {  
  // Get the current user's ID  
  $current_user_id = get_current_user_id();  

  // Get the profile user's ID  
  if (function_exists('dokan_get_current_user_id') && function_exists('dokan_get_current_profile_id')) {  
  $profile_user_id = dokan_get_current_profile_id();  
  } else {  
  $profile_user_id = get_query_var('author');  
  }  

  // Display the form only if the current user is the profile user  
  if ($current_user_id == $profile_user_id) {  
 
 
   
 
  $form = '<form id="tcu-form" method="post" enctype="multipart/form-data">  
 
  
<div class="input-group">
    <label for="tcu-image-upload">Upload Image:</label>
    <input type="file" name="tcu-image-upload" id="tcu-image-upload" accept="image/*">
    <div id="tcu-image-preview" style="margin-top: 10px; height: 150px; width: 150px; border: 1px solid #ccc;">
        <img id="tcu-image-preview-img"  alt="Image Preview" style="max-height: 100%; max-width: 100%;">
    </div>
</div>
<div id="tcu-preview" style="">  
  <h4>' . __('Link preview', 'text-color-uploader') . '</h4>  
  <div id="tcu-preview-element" style="padding: 15px;  margin-bottom: 10px; height:60px; text-align: center; display: block; align-items: center; justify-content: center;"></div>  

  </div>  
 
 
 
 
 
  <div class="input-group">


<input type="submit" name="tcu-update-all" style="border-radius:5px; background-color:#006e9f; color:white;" value="' . __('Update All', 'text-color-uploader') . '">



 </div>
 
 
   <div class="input-group">
   <input type="submit" name="tcu-submit-text"```php
  style="border-radius:5px; background-color:#1ab8ff; color:white;" value="' . __('Apply Link', 'text-color-uploader') . '">  
  </div>
 
 
 
 
  <label for="tcu-text">' . __('', 'text-color-uploader') . '</label>  
 <textarea name="tcu-text" id="tcu-text" maxlength="80" style="resize: none;" placeholder="Your text here"></textarea>

 
  <label for="tcu-url">' . __('', 'text-color-uploader') . '</label>  
  <input type="url" name="tcu-url" id="tcu-url" class="linkurl"  placeholder="Your links here">  
  <div class="input-row" style="">  
 
 
 
 
 
 
 
 
  <div class="input-group">  
  <label for="tcu-color">' . __('Text', 'text-color-uploader') . '</label>  
  <input type="color" name="tcu-color" id="tcu-color">  
  </div>  


<div class="input-group">  
  <label for="tcu-div-bg-color">' . __('Background', 'text-color-uploader') . '</label>  
 <input type="color" name="tcu-div-bg-color" id="tcu-div-bg-color" value="#ffffff" onchange="tcu_update_preview()" />  
 </div>
























  <div class="input-group">  
  <label for="tcu-border-color">' . __('Border', 'text-color-uploader') . '</label>  
  <input type="color" name="tcu-border-color" id="tcu-border-color">  
  </div>  
 
 
 
 <div class="input-group">
  <label for="tcu-div-bg-color-checkbox">' . __('Transparent', 'text-color-uploader') . '</label>  
  <label class="switch">
    <input type="checkbox" name="tcu-div-bg-color" id="tcu-div-bg-color-checkbox" value="" onchange="tcu_update_preview()" />
    <span class="slider round"></span>
  </label>  
</div>



 
 
 
 
 
 
 
  </div>  
 
 
 
    <div class="input-group">  
  <label for="tcu-box-shadow">' . __('Box Shadow', 'text-color-uploader') . '</label>  
  <input type="text" name="tcu-box-shadow" id="tcu-box-shadow" placeholder="6px 8px black" onchange="tcu_update_preview()" />  
</div>


 
<div class="input-group">
    <label for="tcu-font-style">' . __('Font Style', 'text-color-uploader') . '</label>
    <select name="tcu-font-style" id="tcu-font-style" class="tcu-font-style" style="border-radius: 5px;
    padding-bottom: 2.5px; padding-top:2.5px;" onchange="tcu_update_preview()" >
        <option value="Arial">Arial</option>
        <option value="Courier New">Courier New</option>
        <option value="Georgia">Georgia</option>
        <option value="Times New Roman">Times New Roman</option>
        <option value="Verdana">Verdana</option>
        <option value="Italic">Italic</option>
     
    </select>
</div>


 
 
 
 
 
 
  <label for="tcu-border-radius">' . __('Border Radius', 'text-color-uploader') . '</label>  
 <input type="range" name="tcu-border-radius" id="tcu-border-radius" min="0" max="30" step="1" value="0" list="tcu-border-radius-steps">  

  <datalist id="tcu-border-radius-steps">  
  <option value="0">  
  <option value="5">  
  <option value="10">  
  <option value="15">  
  <option value="20">  
  <option value="25">  
  <option value="30">
 
  </datalist>  
 
 


 
 
 
 <button id="viewTemplatesButton" type="button">View Templates</button>

<div id="templateButtons" style="display: none; max-height: 100px; overflow-y: auto; ">
  <button id="button3" class="class2button" style="background-color:#FFFFFF!important;border-radius:0px!important;border:2px solid black!important;outline:none!important;display:block;margin-bottom:10px; width:100%" type="button">Template</button>
  <button id="button1" class="class1button" style="background-color:#FFFFFF!important;border-radius:10px!important;border:2px solid black!important;outline:none!important;display:block;margin-bottom:10px; width:100%" type="button">Template</button>
  <button id="button2" class="class2button" style="background-color:#FFFFFF!important;border-radius:30px!important;border:2px solid black!important;outline:none!important;display:block;margin-bottom:10px; width:100%" type="button">Template</button>
</div>

<script>
document.getElementById("viewTemplatesButton").onclick = function() {
  var templateButtons = document.getElementById("templateButtons");
  if (templateButtons.style.display === "none") {
    templateButtons.style.display = "block";
  } else {
    templateButtons.style.display = "none";
  }
};
</script>
<script>
document.getElementById("tcu-image-upload").addEventListener("change", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("tcu-image-preview-img").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>


  </form>

   <script>
  document.getElementById("button1").addEventListener("click", function() {
    document.getElementById("tcu-color").value = "#000000"; // Pink
    document.getElementById("tcu-div-bg-color").value = "#FFFFFF"; // White
    document.getElementById("tcu-border-color").value = "#FFFFFF"; //
    document.getElementById("tcu-border-radius").value = 30; // 30px

    // Handle the tcu-div-bg-color separately
    var divBgColorInput = document.getElementById("tcu-div-bg-color");
    divBgColorInput.style.backgroundColor = "transparent";
  });
  </script>

  ';  

  return $form;  
  }  
  }  
  return '';  
 }  

 add_shortcode('tcu_form', 'tcu_create_form');








function tcu_save_data() {
  if (isset($_POST['tcu-submit-text']) || isset($_POST['tcu-submit-bg-color']) || isset($_POST['tcu-update-all'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'text_color_data';

    $text = isset($_POST['tcu-text']) ? sanitize_textarea_field($_POST['tcu-text']) : '';
    $color = isset($_POST['tcu-color']) ? sanitize_hex_color($_POST['tcu-color']) : '';
    $border_color = isset($_POST['tcu-border-color']) ? sanitize_hex_color($_POST['tcu-border-color']) : '';
    $border_radius = isset($_POST['tcu-border-radius']) ? intval($_POST['tcu-border-radius']) : 0;
    $div_bg_color = isset($_POST['tcu-div-bg-color']) ? sanitize_hex_color($_POST['tcu-div-bg-color']) : '';
    $font_style = isset($_POST['tcu-font-style']) ? sanitize_text_field($_POST['tcu-font-style']) : 'Arial';
    $url = isset($_POST['tcu-url']) ? esc_url_raw($_POST['tcu-url']) : '';
    $box_shadow = isset($_POST['tcu-box-shadow']) ? sanitize_text_field($_POST['tcu-box-shadow']) : '0 0 0 #000000';
    $user_id = get_current_user_id();

    if (isset($_POST['tcu-update-all'])) {
      // Get the new color, new background color, new border color, new font style, new border radius, and new box shadow
      $new_color = isset($_POST['tcu-color']) ? sanitize_hex_color($_POST['tcu-color']) : '';
      $new_bg_color = isset($_POST['tcu-div-bg-color']) ? sanitize_hex_color($_POST['tcu-div-bg-color']) : '';
      $new_border_color = isset($_POST['tcu-border-color']) ? sanitize_hex_color($_POST['tcu-border-color']) : '';
      $new_font_style = isset($_POST['tcu-font-style']) ? sanitize_text_field($_POST['tcu-font-style']) : 'Arial';
      $new_border_radius = isset($_POST['tcu-border-radius']) ? intval($_POST['tcu-border-radius']) : 0;
      $new_box_shadow = isset($_POST['tcu-box-shadow']) ? sanitize_text_field($_POST['tcu-box-shadow']) : '0 0 0 #000000';

      // Update the color, bg_color, border_color, font_style, border_radius, and box_shadow in all rows for the current user
      $wpdb->query(
        $wpdb->prepare(
          "UPDATE $table_name SET color = %s, bg_color = %s, border_color = %s, font_style = %s, border_radius = %d, box_shadow = %s WHERE user_id = %d",
          $new_color,
          $new_bg_color,
          $new_border_color,
          $new_font_style,
          $new_border_radius,
          $new_box_shadow,
          $user_id
        )
      );
    } else if (isset($_POST['tcu-submit-text'])) {
      
    // Handle the uploaded image and save it to the media library
    
    if (isset($_FILES['tcu-image-upload']) && !empty($_FILES['tcu-image-upload']['tmp_name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        
        $uploaded_image = $_FILES['tcu-image-upload'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploaded_image, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $image_path = $movefile['url'];
        } else {
            // Log error but don't exit early
            error_log("Image Upload Error: " . $movefile['error']);

    $status_message = '';
    if ($movefile && !isset($movefile['error'])) {
        $status_message = 'Image successfully uploaded: ' . esc_html($image_path);
    } else {
        $status_message = 'Image Upload Error: ' . esc_html($movefile['error']);
    }
    echo '<div class="tcu-upload-status">' . $status_message . '</div>';


    echo '<script>';
    if ($movefile && !isset($movefile['error'])) {
        echo 'console.log("Image successfully uploaded: " + "' . esc_js($image_path) . '");';
    } else {
        echo 'console.log("Image Upload Error: " + "' . esc_js($movefile['error']) . '");';
    }
    echo '</script>';

            $image_path = '';
        }
    }

    

    if (isset($_FILES['tcu-image-upload']) && !empty($_FILES['tcu-image-upload']['tmp_name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        
        $uploaded_image = $_FILES['tcu-image-upload'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploaded_image, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $image_path = $movefile['url'];
        } else {
            // Handle error here
            error_log($movefile['error']);
        }
    }

      // Insert the new text data
      $wpdb->insert(
        $table_name,
        array(
          'user_id' => $user_id,
          'text' => $text,
          'color' => $color,
          'border_color' => $border_color,
          'border_radius' => $border_radius,
          'bg_color' => $div_bg_color,
          'font_style' => $font_style,
          'url' => $url,
          'box_shadow' => $box_shadow,
          'image_path' => $image_path  // Add the image path to the insert
        ),
        array('%d', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s')
      );
    } else {
      // Update the background color
      $wpdb->update(
        $table_name,
        array('bg_color' => $div_bg_color),
        array('user_id' => $user_id),
        array('%s'),
        array('%d')
      );

      // Update the background color in user meta
      update_user_meta($user_id, 'tcu_body_bg_color', $div_bg_color);
    }

    // Redirect to the same page without form data
    $url = remove_query_arg(array('tcu-submit-text', 'tcu-submit-bg-color', 'tcu-update-all'));
    wp_safe_redirect($url);
    exit;
  }
}

add_action('wp_loaded', 'tcu_save_data');









function tcu_create_table() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'text_color_data';
  $charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  user_id bigint(20) NOT NULL,
  text text NOT NULL,
  color varchar(7) NOT NULL,
  border_color varchar(7) NOT NULL,
  border_radius int(11) NOT NULL,
  bg_color varchar(7) NOT NULL,
  font_style varchar(20) NOT NULL DEFAULT 'Arial',
  url varchar(255) NOT NULL,
  box_shadow varchar(255) NOT NULL DEFAULT '0 0 0 #000000',
  image_path varchar(255) DEFAULT '',
  
) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}

register_activation_hook(__FILE__, 'tcu_create_table');



















function tcu_show_text() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'text_color_data';
    $output = '';

    // Get the user ID from the currently viewed profile
    if (function_exists('dokan_get_current_user_id') && function_exists('dokan_get_current_profile_id')) {
        $profile_user_id = dokan_get_current_profile_id();
        } else {
            $profile_user_id = get_query_var('author');
        }

    // Check if the user is viewing their own profile
    $is_own_profile = (get_current_user_id() == $profile_user_id) ? 'own-profile' : '';

    $results = $wpdb->get_results($wpdb->prepare("SELECT id, text, color, border_color, border_radius, bg_color, font_style, url, box_shadow, image_path FROM $table_name WHERE user_id = %d", $profile_user_id));
   

if ($results) {
    $sorted_results = array();
    $order = get_user_meta($profile_user_id, 'tcu_text_order', true);

    if (!empty($order)) {
        $order = explode(',', $order);
        foreach ($order as $id) {
            foreach ($results as $key => $result) {
                if ($result->id == $id) {
                    $sorted_results[] = $result;
                    unset($results[$key]);
                    break;
                }
        }
}


$sorted_results = array_merge($sorted_results, $results);
} else {


$sorted_results = $results;
}
// Include the $is_own_profile variable in the class attribute of the container div
$output .= '<div id="tcu-text-container" class="' . $is_own_profile . '">';
foreach ($sorted_results as $result) {
if (!empty($result->text) && !empty($result->color)) {

$output .= '<div id="tcu-text-' . esc_attr($result->id) . '" class="tcu-text-item" style="box-shadow: 0px 0px 0px ' . esc_attr($result->box_shadow) . ';"><span class="handle">&#x2630;</span><span class="delete-icon" data-id="' . esc_attr($result->id) . '">&#x2715;</span>';


$output .= '<a href="' . esc_url($result->url) . '" class="aref" style="text-decoration: none;"><div id="aref1" style="font-weight: 600; background-color: ' . esc_attr($result->bg_color) . '; color: ' . esc_attr($result->color) . '!important; border: 2px solid ' . esc_attr($result->border_color) . '; border-radius: ' . esc_attr($result->border_radius) . 'px; padding-top: 16px;
    padding-bottom: 16px; padding-left:15px; padding-right:15px; margin-bottom: 16px; text-align: center;  align-items: center;  align-items: center; justify-content: center; font-family:' . esc_attr($result->font_style) . '; box-shadow: ' . esc_attr($result->box_shadow) . ';">';


    // Display the image if the image_path is not empty
if (!empty($result->image_path)) {
    $output .= '<div class="tcu-image-container">';
   $output .= '<img src="' . esc_url($result->image_path) . '" alt="Uploaded Image" id="img-thumb" style="max-width:53px; height:53px; position: absolute;
   
top: 50%;
left: 5px;
transform: translateY(-50%);
font-size: 18px;
cursor: move; display:inline-block; vertical-align:middle; float:left!important; border-radius: ' . esc_attr($result->border_radius) . 'px;">';

    $output .= '</div>';  // Closing tcu-image-container

}


// Append the text after the image
$output .= esc_html($result->text);


if (preg_match('/(?:soundcloud\.com|snd\.sc)\/[^.]+$/i', $result->url)) {
$output .= '<button class="sc-dropdown-btn" data-id="' . esc_attr($result->id) . '"><i class="fas fa-caret-down"></i></button>';
}

// Add the button for YouTube URLs
if (preg_match('/(?:youtube\.com|youtu\.be)/i', $result->url)) {
$output .= '<button class="youtube-dropdown-btn" data-id="' . esc_attr($result->id) . '"><i class="fas fa-caret-down"></i></button>';
}


// Add the button for Twitter URLs
if (preg_match('/(?:twitter\.com\/\w+\/status\/\d+)/i', $result->url)) {
$output .= '<button class="twitter-dropdown-btn" data-id="' . esc_attr($result->id) . '"><i class="fas fa-caret-down"></i></button>';
}


if (preg_match('/(?:twitter\.com\/\w+\/status\/\d+)/i', $result->url)) {
$output .= '<div id="twitter-widget-container-' . esc_attr($result->id) . '" class="twitter-widget-container" style="display: none; margin-top:-10px; text-align:center;"><blockquote class="twitter-tweet" data-dnt="true"><a href="' . esc_attr($result->url) . '"></a></blockquote><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>';
}



if (preg_match('/(?:open\.spotify\.com)/i', $result->url)) {
$output .= '<button class="spotify-dropdown-btn" data-id="' . esc_attr($result->id) . '"><i class="fas fa-caret-down"></i></button>';
$output .= '<div id="spotify-widget-container-' . esc_attr($result->id) . '" class="spotify-widget-container" style="display: none; margin-top:0px;"><iframe id="spotify-widget-' . esc_attr($result->id) . '" src="https://open.spotify.com/embed?uri=' . urlencode($result->url) . '" frameborder="no" allow="autoplay; encrypted-media" allowtransparency="true" style="width:100%; height:80px;"></iframe></div>';
}




$output .= '</div></a>';
if (preg_match('/(?:soundcloud\.com|snd\.sc)\/[^.]+$/i', $result->url)) {
if (strpos($result->url, '/sets/') !== false) {

// It's a playlist
$output .= '<div id="sc-widget-container-' . esc_attr($result->id) . '" class="sc-widget-container" style="display: none; margin-top:-10px;"><iframe id="sc-widget-' . esc_attr($result->id) . '" src="https://w.soundcloud.com/player/?url=' . urlencode($result->url) . '&auto_play=false&buying=true&liking=true&download=true&sharing=true&show_artwork=true&show_comments=false&show_playcount=true&show_user=true&hide_related=true&visual=false&start_track=0&callback=true" frameborder="no" scrolling="no" style="width:100%; height:400px;"></iframe></div>';
} else {

// It's a single track
$output .= '<div id="sc-widget-container-' . esc_attr($result->id) . '" class="sc-widget-container" style="display: none; margin-top:-10px;"><iframe id="sc-widget-' . esc_attr($result->id) . '" src="https://w.soundcloud.com/player/?url=' . urlencode($result->url) . '&auto_play=false&buying=true&liking=true&download=true&sharing=true&show_artwork=true&show_comments=false&show_playcount=true&show_user=true&hide_related=true&visual=false&start_track=0&callback=true" frameborder="no" scrolling="no" style="width:100%;"></iframe></div>';
}

}


if (preg_match('/(?:youtube\.com|youtu\.be)/i', $result->url)) {
// Extract the video ID from the URL
preg_match('/(?:v=|youtu\.be\/)([^&]+)/', $result->url, $video_id_matches);
$video_id = isset($video_id_matches[1]) ? $video_id_matches[1] : '';

$output .= '<div id="youtube-widget-container-' . esc_attr($result->id) . '" class="youtube-widget-container" style="display: none; margin-top:-10px;  "><iframe id="youtube-widget-' . esc_attr($result->id) . '" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%; height:100%; border: 2px solid white; border-radius:12px;"></iframe></div>';
}


$output .= '</div>';
}
}
$output .= '</div>';

}

return $output;
}

add_shortcode('tcu_show_text', 'tcu_show_text');
























































































function hide_colophon_if_logged_out() {
  if ( ! is_user_logged_in() ) {
    echo '<style>
      footer#colophon {
        display: none;
      }
    </style>';
  }
}
add_action('wp_footer', 'hide_colophon_if_logged_out');




function hutl_ink_logo() {
    $logo_url = plugin_dir_url(__FILE__) . 'logo.png';
    $black_logo_url = plugin_dir_url(__FILE__) . 'logo-black.png';
    $html = '<a href="https://www.hutl.ink/" target="_blank"><img id="hutl-ink-logo" src="' . $logo_url . '" class="hutl-ink-logo" /></a>';
    $html .= <<<SCRIPT
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var logoElement = document.getElementById('hutl-ink-logo');
            var bodyStyle = window.getComputedStyle(document.body);
            var bodyBgColor = bodyStyle.backgroundColor;

            var rgb = bodyBgColor.replace(/[^\d,]/g, '').split(',');
            var r = parseInt(rgb[0]);
            var g = parseInt(rgb[1]);
            var b = parseInt(rgb[2]);
           
            // Calculate the brightness value to determine if it's a light or dark color
            var brightness = (r * 299 + g * 587 + b * 114) / 1000;
           
            if (brightness < 128) { // Dark background
                logoElement.src = '$logo_url';
            } else { // Light background
                logoElement.src = '$black_logo_url';
            }
        });
    </script>
SCRIPT;

    return $html;
}

add_shortcode('hutl_ink_logo', 'hutl_ink_logo');


















// Enqueue scripts and styles
function tcu_enqueue_scripts() {
  wp_enqueue_style('tcu-styles', plugin_dir_url(__FILE__) . 'css/tcu-styles.css');
  wp_enqueue_script('jquery-ui-sortable');
  wp_enqueue_script('jquery-ui-touch-punch', plugin_dir_url(__FILE__) . 'js/jquery.ui.touch-punch.min.js', array('jquery', 'jquery-ui-sortable'), '0.2.3', true);
  wp_enqueue_script('tcu-scripts', plugin_dir_url(__FILE__) . 'js/tcu-scripts.js', array('jquery', 'jquery-ui-sortable', 'jquery-ui-touch-punch'), '1.0.0', true);
    wp_enqueue_script('soundcloud-api', 'https://w.soundcloud.com/player/api.js', array(), null, true);

  // Pass variables to JavaScript
  $tcu_vars = array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('tcu_save_order'),
  );
  wp_localize_script('tcu-scripts', 'tcu_vars', $tcu_vars);
}

add_action('wp_enqueue_scripts', 'tcu_enqueue_scripts');



function tcu_save_order() {
  check_ajax_referer('tcu_save_order', 'nonce');

  if (isset($_POST['order']) && !empty($_POST['order'])) {
    $order = sanitize_text_field($_POST['order']);
    $user_id = get_current_user_id();

    update_user_meta($user_id, 'tcu_text_order', $order);
  }

  wp_send_json_success();
}

add_action('wp_ajax_tcu_save_order', 'tcu_save_order');

function tcu_delete_text() {
  check_ajax_referer('tcu_delete_text', 'nonce');





















  if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $user_id = get_current_user_id();

    global $wpdb;
    $table_name = $wpdb->prefix . 'text_color_data';

    // Verify that the text belongs to the user before deleting it
    $text_owner = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM $table_name WHERE id = %d", $id));
    if ($text_owner == $user_id) {
      $wpdb->delete($table_name, array('id' => $id), array('%d'));
      wp_send_json_success();
    } else {
      wp_send_json_error(array('message' => 'You are not allowed to delete this item.'));
    }
  }
}

add_action('wp_ajax_tcu_delete_text', 'tcu_delete_text');

function tcu_delete_item() {
  check_ajax_referer('tcu_save_order', 'nonce');

  if (isset($_POST['item_id']) && !empty($_POST['item_id'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'text_color_data';
    $item_id = intval($_POST['item_id']);
    $user_id = get_current_user_id();

    $result = $wpdb->delete($table_name, array('id' => $item_id, 'user_id' => $user_id), array('%d', '%d'));

    if ($result) {
      wp_send_json_success();
    } else {
      wp_send_json_error();
    }
  }
}

add_action('wp_ajax_tcu_delete_item', 'tcu_delete_item');

















function vendor_store_link_shortcode($atts) {
    // Get current logged in user
    $user = wp_get_current_user();

    if($user->exists()){
        // If Dokan plugin is installed and active
        if ( class_exists( 'WeDevs_Dokan' ) ) {
            // Get the vendor info by the user id
            $vendor = dokan()->vendor->get( $user->ID );

            if ( $vendor ) {
                // Get the store URL
                $store_url = $vendor->get_shop_url();

                // Create a link with FontAwesome house icon
                // Make sure FontAwesome is loaded on your site
                $output = '<a href="' . esc_url( $store_url ) . '"><i class="fa fa-home" ></i></a>';
               
                return $output;
            } else {
                return 'This user is not a vendor.';
            }
        } else {
            return 'Dokan is not active.';
        }
    } else {
        return 'User is not logged in.';
    }
}
add_shortcode('vendor_store_link', 'vendor_store_link_shortcode');








































function enqueue_confetti_script() {
    // Enqueue external library
    wp_enqueue_script( 'js-confetti', 'https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js', array(), null, true );

    // Enqueue custom JavaScript code
    wp_add_inline_script( 'js-confetti', '
        document.addEventListener("DOMContentLoaded", function() {
            var jsConfetti = new JSConfetti();
            var button = document.querySelector("input[name=\'tcu-update-all\']");

            button.addEventListener("click", function(e) {
                // Set a flag in the local storage
                localStorage.setItem("showConfetti", "true");
            });

            // Check for the flag when the page loads
            if (localStorage.getItem("showConfetti") === "true") {
                // Clear the flag
                localStorage.removeItem("showConfetti");

                // Show the confetti
                jsConfetti.addConfetti();
            }
        });
    ' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_confetti_script' );










function tcu_search_username_field() {
  $search_field = '
    <div id="tcu-search-username" style="position: relative; display: inline-block;">
      <label for="search-username-field" id="search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);">' . __('Hutl.ink/', 'text-color-uploader') . '</label>
      <input type="text" id="search-username-field" name="search-username" class="usernameUrl" style="padding-left:75px;border-radius:5px;"/>
      <button type="button" id="search-username-btn" style="border-radius:30px;">' . __('Search', 'text-color-uploader') . '</button>
      <span id="search-username-result"></span>
    </div>
  ';

  return $search_field;
}



add_shortcode('search_username', 'tcu_search_username_field');

function tcu_search_username() {
  check_ajax_referer('tcu_search_username', 'nonce');

  if (isset($_POST['username']) && !empty($_POST['username'])) {
    $username = sanitize_user($_POST['username']);
    $user = get_user_by('login', $username);

   if ($user) {
      wp_send_json_success(__('<i class="fa fa-check" style="color:green;"></i>', 'text-color-uploader'));
    } else {
      wp_send_json_success(__('<i class="fa fa-close" style="color:red;"></i>', 'text-color-uploader'));
    }
  }
}

add_action('wp_ajax_tcu_search_username', 'tcu_search_username');
add_action('wp_ajax_nopriv_tcu_search_username', 'tcu_search_username');

function tcu_enqueue_search_username_scripts() {
  wp_enqueue_script('tcu-search-username-scripts', plugin_dir_url(__FILE__) . 'js/tcu-search-username.js', array('jquery'), '1.0.0', true);

  $search_username_vars = array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('tcu_search_username'),
  );

  wp_localize_script('tcu-search-username-scripts', 'search_username_vars', $search_username_vars);
}

add_action('wp_enqueue_scripts', 'tcu_enqueue_search_username_scripts');
