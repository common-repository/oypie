<?php

/**
 * SHORTCODE OUTPUT
 */
function oypo_album($atts) {

    // Extract shortcode
    extract(shortcode_atts(array('type' => '','id' => '','wl' => '','trans' => '','nonav' => '','css' => '','colors' => '','lang' => '','pref' => ''), $atts));

    // Check if preferences are applicable
    if($pref == '1') {
      global $wpdb;
      $preferences = $wpdb->get_var( "SELECT option_value FROM $wpdb->options WHERE option_name = 'oypie_pref'");
      $preferences = explode('\/', $preferences);

      if($preferences[1] != NULL){
        $colors = $preferences[1];
      }
      if($preferences[2] != NULL){
        $css = $preferences[2];
      }
      if($preferences[3] != NULL){
        $wl = $preferences[3];
      }
      if($preferences[4] != NULL){
        $trans = $preferences[4];
      }
      if($preferences[5] != NULL){
        $lang = $preferences[5];
      }
   }

   // START WITH BUILDING THE CODE
   $shortcode = "<script type='text/javascript'>" . "\r\n";

   // Setup script
   if($type == "map"){
     $shortcode .= "var mode='map';\r\n";
     $shortcode .= "var mapid='".$id."';\r\n";
   }elseif($type == "user"){
     $shortcode .= "var mode='user';\r\n";
     $shortcode .= "var userid='".$id."';\r\n";
   }

   // Add transparency
   if($trans == 1) {
    $shortcode .= "var transparency=1;\r\n";
   }

   // Add whitelabel sending
   if($wl != null) {
    $shortcode .= "var wl='".$wl."';\r\n";
   }

   // No map navigation
   if($nonav == 1 &&  $type == 'map'){
    $shortcode .= "var nonav=1;\r\n";
   }

   // Preset language
   if($lang == "auto"){
       $lang_auto = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
       if($lang_auto == 'nl' || $lang_auto == 'fr' || $lang_auto == 'de'){
         $shortcode .= "var taal='".$lang_auto."';\r\n";
       }else{
         $shortcode .= "var taal='en';\r\n";
       }
    }elseif($lang == 'en' || $lang == 'nl' || $lang == 'fr' || $lang == 'de'){
      $shortcode .= "var taal='".$lang."';\r\n";
    }

    // Add custom css url
    if($css != null){
      $shortcode .= "var css='".$css."';\r\n";
    }

    // Custom colors
    if($colors != null){
      $colors = explode(' ', $colors);

      $shortcode .= "var kleur1='#".$colors[0]."';\r\n";
      $shortcode .= "var kleur2='#".$colors[1]."';\r\n";
      $shortcode .= "var kleur3='#".$colors[2]."';\r\n";
      $shortcode .= "var kleur4='#".$colors[3]."';\r\n";
      $shortcode .= "var kleur5='#".$colors[4]."';\r\n";
      $shortcode .= "var kleur6='#".$colors[5]."';\r\n";
    }

    $shortcode .= "</script>\r\n";
    $shortcode .= "<script type='text/javascript' src='//www.oypo.nl/pixxer/api/templates/1607/oypo.js'></script>\r\n";
    $shortcode .= "<div id='pixxer_iframe'></div>";

    return $shortcode;
}

function oypo_price($atts) {

  // Extract shortcode
  extract(shortcode_atts(array('id' => '','type' => '','price' => '','css' => ''), $atts));

  // START WITH BUILDING THE CODE
  $shortcode = "<script type='text/javascript'>" . "\r\n";
  $shortcode .= "var profileid='".$id."';\r\n";
  $shortcode .= "var showtype='".$type."';\r\n";
  $shortcode .= "var prices='".$price."';\r\n";
  $shortcode .= "</script>\r\n";
  $shortcode .= "<script type='text/javascript' src='//www.oypo.nl/pixxer/api/templates/productinfo.js'></script>\r\n";
  $shortcode .= "<div id='pixxer_products'></div>";

  if($css == 1) {
    $shortcode .= "<link rel='stylesheet' href='".plugins_url()."oypie/css/price.css' type='text/css' media='all' />\r\n";
  }

  return $shortcode;

}

add_shortcode('oypo', 'oypo_album');
add_shortcode('oypo_price', 'oypo_price');

?>
