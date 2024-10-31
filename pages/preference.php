    <?php
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style( 'wp-color-picker' );

    function color_standard($post, $stand){
        if($post == null){
            return $stand;
        }else{
            return $post;
        }
    }

    function oypie_checked($var, $stand, $normal){
        if($var == $stand){
            return 'checked=""';
        }elseif($normal == 'true'){
            return 'checked=""';
        }
    }

    function oypie_style($var, $stand, $normal){
        if($var == $stand){
            return 'table-row';
        }elseif($normal == 'true' && !$var){
            return 'table-row';
        }else{
            return 'none';
        }
    }

    $wl_check = isset($_POST['wl_check']) ? $_POST['wl_check'] : '';
    $wl = isset($_POST['wl']) ? $_POST['wl'] : '';
    $colors = isset($_POST['colors']) ? $_POST['colors'] : '';
    $style = isset($_POST['style']) ? $_POST['style'] : '';
    $css = isset($_POST['css']) ? $_POST['css'] : '';
    $trans = isset($_POST['trans']) ? $_POST['trans'] : '';
    $lang = isset($_POST['lang']) ? $_POST['lang'] : '';
    $output = isset($output) ? $output : '';
$notice = isset($notice) ? $notice : '';


if($_POST){

    /**
     * WHITELABEL SENDING
     */
    if($wl){
        $output = $output.' wl="'.$wl.'"';
    }

    /**
     * DESIGN SETTINGS
     */
    if($style == 'colors'){
        $colors = $_POST['kleur1'].' '.$_POST['kleur2'].' '.$_POST['kleur3'].' '.$_POST['kleur4'].' '.$_POST['kleur5'].' '.$_POST['kleur6'];
        $colors = str_replace("#", "", $colors);
        $output = $output.' colors="'.$colors.'"';
    }elseif($style == 'css'){
        $output = $output.' css="'.$css.'"';
    }

    if($trans == 1) {
        $output = $output.' trans="1"';
    }

    /**
     * LANGUAGE SETTINGS
     */
    if($lang){
        $output = $output.' lang="'.$lang.'"';
    }

    /**
     * AND WE'RE DONE
     */
global $wpdb;
$result = $wpdb->replace(
	$wpdb->options,
	array(
		'option_name' => 'oypie_pref',
		'option_value' => $output.'\/'.$colors.'\/'.$css.'\/'.$wl.'\/'.$trans.'\/'.$lang
	),
	array(
		'%s',
		'%s'
	)
);
if ($result) {
    $notice = '<div class="alert-message alert-message-success"><p><b>Gelukt!</b> Uw instellingen zijn opgeslagen. </p></div>';
} else {
    $notice = '<div class="alert-message alert-message-danger"><p><b>Mislukt!</b> We konden uw instellingen niet opslaan. </p></div>';
}
}

global $wpdb;
$prefs = $wpdb->get_var( "SELECT option_value FROM $wpdb->options WHERE option_name = 'oypie_pref'");
$prefs = explode('\/', $prefs);
?>        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.3&appId=511881472190380";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
<div class="wrap">
    <h2>OYPie <span class="title-count theme-count oypie-title-count">
        versie 1.2.7</span></h2>
        <div class="oypie-home">
		<div class="oypie-home-column-container">
				<div class="oypie-home-column">
				<h2>Maak het makkelijk</h2>
				<p class="message">Je albums moeten er precies zo uitzien dat het precies past in je website. Maar elke keer weer opnieuw deze instellingen opzoeken kost tijd. Daarom kun je hier je voorkeuren opstellen. Deze komen dan bij alle albums waar <code>pref="1"</code> is ingesteld.</p>
			</div>

			<div class="oypie-home-column">
				<h3>Wist je dat?</h3>
                <p>Je alle albums met <code>pref="1"</code> ook later nog kan updaten met een nieuwe stijl en instellingen?</p>
                <h3>Handige links</h3>
                <ul>
					<li><a target="_blank" href="http://oypie.sanderonlinemedia.nl/#albums">Documentatie</a></li>
				    <li><a target="_blank" href="http://sanderonlinemedia.nl/">SanderOnline Media</a></li>
				</ul>
			</div>
		</div>
	</div>
    <div class="postbox oypie-postbox">
    <div class="inside">
    <h2>Voorkeuren</h2>
    <?php echo $notice;?>
    <p>Stel hier je voorkeuren in zodat het maken van shortcodes nog gemakkelijker wordt.</p>
    <strong>Huidige voorkeursinstellingen:</strong><br />
    <code><?php echo $prefs[0];?></code>
    <div class="alert-message alert-message-warning"><p><b>Let op!</b> De instellingen die hier worden opgeslagen gelden voor alle shortcodes waar <code>pref="1"</code> is gebruikt. Ook overschrijven de voorkeursinstellingen de instellingen die in de shortcode worden gespecificeerd.</p></div>
    <form id="theForm" action="#album" method="POST">
        <table>
            <tr id="wl">
                <td><label>Whitelabel verzending</label></td>
                <td style="width: 25%;"><input type="radio" name="wl_check" id="opt6" value="1" <?php echo oypie_checked($wl_check, 1, false)?> /> Ja</td>
                <td colspan="2" style="width: 25%;"><input type="radio" name="wl_check" id="opt7" value="0" <?php echo oypie_checked($wl_check, 0, true)?>/> Nee</td>
            </tr>
            <tr id="wl_true" style="display: <?php echo oypie_style($wl_check, 1, false)?>;">
                <td><label>Whitelabel-id</label></td>
                <td colspan="3"><input id="wl" type="text" name="wl" value='<?php echo $wl;?>'/></td>
            </tr>
            <tr id="wl_no"></tr>
            <tr>
                <td><label>Opmaak</label></td>
                <td style="width: 25%;"><input type="radio" name="style" value="stand" id="opt4" <?php echo oypie_checked($style, 'stand', true)?> /> Standaard opmaak</td>
                <td style="width: 25%;"><input type="radio" name="style" value="colors" id="opt8" <?php echo oypie_checked($style, 'colors', false)?>/> Kleuren aanpassen</td>
                <td style="width: 25%;"><input type="radio" name="style" value="css" id="opt5" <?php echo oypie_checked($style, 'css', false)?>/> Eigen CSS-bestand</td>
            </tr>
            <tr id="css_true" style="display: <?php echo oypie_style($style, 'css', false)?>;">
                <td><label>Eigen CSS-bestand</label></td>
                <td colspan="3"><input id="css" type="text" name="css" placeholder="Plak hier de link naar het CSS-bestand" value='<?php echo $css;?>'/></td>
            </tr>
            <tr id="css_no">
            </tr>
            <tr id="colors_1" style="display: <?php echo oypie_style($style, 'colors', false)?>;">
                <td>Kleur 1</td>
                <td><input name="kleur1" type="text" id="colorpicker1" value="<?php echo color_standard($_POST['kleur1'], '#ffffff');?>" data-default-color="#ffffff"></td>
                <td colspan="2">Achtergrond <small>Kleur maakt niet uit als u transparant heeft ingeschakeld</small></td>
            </tr>
            <tr id="colors_2" style="display: <?php echo oypie_style($style, 'colors', false)?>;">
                <td>Kleur 2</td>
                <td><input name="kleur2" type="text" id="colorpicker2" value="<?php echo color_standard($_POST['kleur2'], '#f0f0f0');?>" data-default-color="#f0f0f0"></td>
                <td colspan="2">Achtergrondkleur van de blokken</td>
            </tr>
            <tr id="colors_3" style="display: <?php echo oypie_style($style, 'colors', false)?>;">
                <td>Kleur 3</td>
                <td><input name="kleur3" type="text" id="colorpicker3" value="<?php echo color_standard($_POST['kleur3'], '#666666');?>" data-default-color="#666666"></td>
                <td colspan="2">Kleur van de tekts</td>
            </tr>
            <tr id="colors_4" style="display: <?php echo oypie_style($style, 'colors', false)?>;">
                <td>Kleur 4</td>
                <td><input name="kleur4" type="text" id="colorpicker4" value="<?php echo color_standard($_POST['kleur4'], '#00bbff');?>" data-default-color="#00bbff"></td>
                <td colspan="2">Kleur van de links en buttons</td>
            </tr>
            <tr id="colors_5" style="display: <?php echo oypie_style($style, 'colors', false)?>;">
                <td>Kleur 5</td>
                <td><input name="kleur5" type="text" id="colorpicker5" value="<?php echo color_standard($_POST['kleur5'], '#54544f');?>" data-default-color="#54544f"></td>
                <td colspan="2">Achtergrondkleur van de titelbalken</td>
            </tr>
            <tr id="colors_6" style="display: <?php echo oypie_style($style, 'colors', false)?>;">
                <td>Kleur 6</td>
                <td><input name="kleur6" type="text" id="colorpicker6" value="<?php echo color_standard($_POST['kleur6'], '#ffffff');?>" data-default-color="#ffffff"></td>
                <td colspan="2">Voorgrondkleur van de titelbalken</td>
            </tr>
            <tr>
                <td><label>Transparant</label></td>
                <td style="width: 25%;"><input value="1" type="radio" name="trans" <?php echo oypie_checked($trans, 1, false)?>/> Ja</td>
                <td colspan="2" style="width: 25%;"><input value="0" type="radio" name="trans" <?php echo oypie_checked($trans, 0, true)?> /> Nee</td>
            </tr>
            <tr>
                <td><label>Taal</label></td>
                <td colspan="2">
                <select name="lang">
                   <option value="auto" <?php echo oypie_checked($lang, 'auto', false)?>>Automatisch</option>
                    <option value="nl" <?php echo oypie_checked($lang, '', false)?>>Nederlands</option>                    <option value="en" <?php echo oypie_checked($lang, 'en', false)?>>Engels</option>                    <option value="de" <?php echo oypie_checked($lang, 'de', false)?>>Duits</option>                    <option value="fr" <?php echo oypie_checked($lang, 'fr', false)?>>Frans</option>

                </select>
                <td><small>Selecteer de taal van het album.</small></td>
            </tr>
            <tr><td colspan="4"><input type="submit" name="submit" id="submit" class="button button-primary" value="Maak code"  /></td></tr>
        </table>
    </form>
    </div>
    </div>

    <?php if($output) {?>
    <div class="postbox oypie-postbox">
    <div class="inside">
    <h2>Resultaat</h2>
    De instellingen die worden toegevoegd aan je shortcodes zijn:<br />
    <code><?php echo $output;?></code>
<br />
    Wanneer je in de shortcode <code>[oypo pref="1"]</code> gebruikt zullen deze instellingen worden toegepast.
    </div>
    </div>
    <?php } ?>
</div>
<script type='text/javascript'>//<![CDATA[
window.onload=function(){

function css(one, two, three, four, five, six, seven, eight) {
    document.getElementById(one).style.display = 'table-row';
    document.getElementById(two).style.display = 'none';
    document.getElementById(three).style.display = 'none';
    document.getElementById(four).style.display = 'none';
    document.getElementById(five).style.display = 'none';
    document.getElementById(six).style.display = 'none';
    document.getElementById(seven).style.display = 'none';
    document.getElementById(eight).style.display = 'none';
}

function colors(one, two, three, four, five, six, seven, eight) {
    document.getElementById(one).style.display = 'none';
    document.getElementById(two).style.display = 'none';
    document.getElementById(three).style.display = 'table-row';
    document.getElementById(four).style.display = 'table-row';
    document.getElementById(five).style.display = 'table-row';
    document.getElementById(six).style.display = 'table-row';
    document.getElementById(seven).style.display = 'table-row';
    document.getElementById(eight).style.display = 'table-row';
}

document.getElementById('opt4').addEventListener('click',function(e){
    css('css_no','css_true', 'colors_1', 'colors_2', 'colors_3', 'colors_4', 'colors_5', 'colors_6');
});
document.getElementById('opt5').addEventListener('click',function(e){
    css('css_true','css_no', 'colors_1', 'colors_2', 'colors_3', 'colors_4', 'colors_5', 'colors_6');
});

document.getElementById('opt6').addEventListener('click',function(e){
    css('wl_true','wl_no');
});

document.getElementById('opt7').addEventListener('click',function(e){
    css('wl_no','wl_true');
});

document.getElementById('opt8').addEventListener('click',function(e){
    colors('css_no','css_true', 'colors_1', 'colors_2', 'colors_3', 'colors_4', 'colors_5', 'colors_6');
});

}//]]>
</script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#colorpicker1').wpColorPicker();
        $('#colorpicker2').wpColorPicker();
        $('#colorpicker3').wpColorPicker();
        $('#colorpicker4').wpColorPicker();
        $('#colorpicker5').wpColorPicker();
        $('#colorpicker6').wpColorPicker();
    });
    </script>
    <?php

    ?>
