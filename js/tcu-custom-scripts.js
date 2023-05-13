function tcu_update_preview() {
  var fontFamily = jQuery("#tcu-font-family").val();
  var color = jQuery("#tcu-color").val();
  var bgColor = jQuery("#tcu-div-bg-color").val();
  var borderColor = jQuery("#tcu-border-color").val();
  var borderRadius = jQuery("#tcu-border-radius").val();

  var previewElement = jQuery("#tcu-preview-element");

  previewElement.css({
    "font-family": fontFamily,
    "color": color,
    "background-color": bgColor,
    "border-color": borderColor,
    "border-radius": borderRadius + "px"
  });
}

// Call tcu_update_preview on page load to set initial styles
jQuery(document).ready(function () {
  tcu_update_preview();
});
