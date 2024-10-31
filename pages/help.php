  <div class="wrap">
    <h1>OYPie <span class="title-count theme-count oypie-title-count">
        versie 1.2.7</span></h2>  </h1>
	<div class="oypie-home">
		<div class="oypie-home-column-container">
			<div class="oypie-home-column">
				<h1>Gemakkelijker je foto's verkopen</h1>
				<p class="message">Foto's verkopen via WordPress, maar dan gemakkelijk!</p>
				<p>Ga direct aan de aan de slag met OYPie toe te voegen aan je website. Je vindt de shortcode generators in de WYSIWYG-editors en in het menu.</p>
			</div>

			<div class="oypie-home-column">
        <h3>Direct aan de slag</h3>
				<ul>
					<li><a href="<?php echo get_admin_url();?>/admin.php?page=oypie_album">Maak een gallerij shortcode</a></li>
                    <li><a href="<?php echo get_admin_url();?>/admin.php?page=oypie_price">Maak een prijslijst shortcode</a></li>
                    <li><a href="<?php echo get_admin_url();?>/admin.php?page=oypie_price">Stel je voorkeuren in</a></li>
                </ul>
                <h3>Handige links</h3>
                <ul>
					<li><a href="http://oypie.sanderonlinemedia.nl/">OYPie Documentatie</a></li>
					<li><a target="_blank" href="https://www.oypo.nl/content.asp?path=eanbaokb">OYPO Dashboard</a></li>
					<li><a href="https://wordpress.org/plugins/oypie/">Plugin Repository</a></li>
				    <li><a href="http://sanderonlinemedia.nl/">SanderOnline Media</a></li>
				</ul>    </div>
			</div>
		</div>
    <div class="postbox oypie-postbox">
        <div class="inside">
            <h2>Nieuw in versie 1.2.5</h2>
            <p>De code van de shortcodes zijn herschreven en geoptimaliseerd volgens de nieuwste PHP code. De automatische taalherkenner is bijgewerkt en de interface in het admin paneel is bijgewerkt.</p>
            <h2>Nieuw in versie 1.2.6</h2>
            <p>Een bugfix voor het gebruik van je eigen kleuren in de website.</p>
            <h2>Nieuw in versie 1.2.7</h2>
            <p>Een bugfix voor het inladen van de hoofd albumpagina voor gebruikers.</p>

        </div>
    </div>
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
    ?>

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
    <div class="postbox oypie-postbox">
    <div class="inside">
    <h2 id="colors">Kleurengenerator</h2>
    <hr />
    <p>Hieronder kan u de kleuren kiezen voor uw OYPie albums. Door het onderstaande toe te voegen aan uw shortcodes krijgt de gallerij de kleuren naar uw keuze.</p>
    <form action="#colorpicker" method="POST">
        <table>
            <tr>
                <td>Kleur 1</td>
                <td><input name="kleur1" type="text" id="colorpicker1" value="<?php echo color_standard(isset($_POST['kleur1']), '#ffffff');?>" data-default-color="#ffffff"></td>
                <td>Achtergrond <small>Kleur maakt niet uit als u transparant heeft ingeschakeld</small></td>
            </tr>
            <tr>
                <td>Kleur 2</td>
                <td><input name="kleur2" type="text" id="colorpicker2" value="<?php echo color_standard(isset($_POST['kleur2']), '#f0f0f0');?>" data-default-color="#f0f0f0"></td>
                <td>Achtergrondkleur van de blokken</td>
            </tr>
                        <tr>
                <td>Kleur 3</td>
                <td><input name="kleur3" type="text" id="colorpicker3" value="<?php echo color_standard(isset($_POST['kleur3']), '#666666');?>" data-default-color="#666666"></td>
                <td>Kleur van de tekts</td>
            </tr>
            <tr>
                <td>Kleur 4</td>
                <td><input name="kleur4" type="text" id="colorpicker4" value="<?php echo color_standard(isset($_POST['kleur4']), '#00bbff');?>" data-default-color="#00bbff"></td>
                <td>Kleur van de links en buttons</td>
            </tr>
            <tr>
                <td>Kleur 5</td>
                <td><input name="kleur5" type="text" id="colorpicker5" value="<?php echo color_standard(isset($_POST['kleur5']), '#54544f');?>" data-default-color="#54544f"></td>
                <td>Achtergrondkleur van de titelbalken</td>
            </tr>
            <tr>
                <td>Kleur 6</td>
                <td><input name="kleur6" type="text" id="colorpicker6" value="<?php echo color_standard(isset($_POST['kleur6']), '#ffffff');?>" data-default-color="#ffffff"></td>
                <td>Voorgrondkleur van de titelbalken</td>
            </tr>
            <tr><td colspan="3"><?php submit_button( 'Maak code' ); ?></td></tr>
        </table>
    </form>
    <?php if(isset($_POST['kleur1']) != '') {
        $output = $_POST['kleur1'].' '.$_POST['kleur2'].' '.$_POST['kleur3'].' '.$_POST['kleur4'].' '.$_POST['kleur5'].' '.$_POST['kleur6'];
        $output = str_replace("#", "", $output);
        echo "<strong>Uw code:</strong></br>";
        echo "<code>colors=\"".$output."\"</code><br />";
        echo "Deze code kan u toevoegen aan uw shortcode voor een album, albumoverzicht of inlogpagina.";
    }?>
    </div>
    </div>
</div>
