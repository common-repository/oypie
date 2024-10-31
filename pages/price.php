    <?php

    function oypie_checked($var, $stand, $normal){
        if($var == $stand){
            return 'checked=""';
        }elseif($normal == 'true'){
            return 'checked=""';
        }
    }

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $style = isset($_POST['style']) ? $_POST['style'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $output = isset($output) ? $output : '';

if($_POST){


    /**
     * SET TYPE AND ID
     */
    if($id){
        $output = '[oypo_price type="'.$type.'" id="'.$id.'" price="'.$price.'"';
    }
    /**
     * OPTIONAL CSS
     */
    if($style == 1){
        $output = $output.' css="1"';
    }

    /**
     * AND WE'RE DONE
     */

     $output = $output.']';
}
?>
        <div id="fb-root"></div>
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
				<h2>Toon je prijzen</h2>
				<p class="message">Je klanten informeren over je prijzen zonder dat er direct een fotoalbum aangekoppeld wordt is steeds meer gezien. Nederlanders willen graag weten wat ze ze betalen.</p>
				<p>Het begint met <code>[oypo_price]</code> die je prijslijst inlaadt in je website. Met de aanvullende optie's past de prijslijst nog beter je website.</p>
			</div>

			<div class="oypie-home-column">
				<h3>Wist je dat?</h3>
                <p>Er is ook een shortcode generator verwerkt in de WYSISWYG-editor bij elke pagina en bericht. Zo kun je nog gemakkelijker een shortcode voor je prijslijst maken. Je herkent hem aan:
                <span class="dashicons dashicons-camera"></span><small><span class="dashicons dashicons-arrow-down"></span></small></p>
                <h3>Handige links</h3>
                <ul>
					<li><a target="_blank" href="http://oypie.sanderonlinemedia.nl/#price">Documentatie shortcode</a></li>
					<li><a target="_blank" href="https://www.oypo.nl/content.asp?path=eanbaokb&f=1&f2=0">OYPO Verkoopprofielen</a></li>
				    <li><a target="_blank" href="http://sanderonlinemedia.nl/">SanderOnline Media</a></li>
				</ul>
			</div>
		</div>
	</div>
    <div class="postbox oypie-postbox">
    <div class="inside">
    <h2>Generator</h2>
    <p>Genereer hier je <code>[oypo_price]</code> shortcode voor jouw prijslijst / assortiment in te laden.</p>
    <form id="theForm" action="#price" method="POST">
        <table>
            <tr>
                <td><label>Fotoverkoopprofiel ID</label></td>
                <td colspan="3">
                    <input name="id" type="text" placeholder="Je verkoopprofiel-ID" value="<?php echo $id?>" />
                </td>
            </tr>
            <tr>
                <td style="min-width: 150px;"><label>Type</label></td>
                <td style="width: 25%;"><input type="radio" name="type" value="1" <?php echo oypie_checked($type, 1, true)?> /> Compact</td>
                <td colspan="2" style="width: 25%;"><input type="radio" name="type" value="0" <?php echo oypie_checked($type, 0, false)?>/> Uitgebreid</td>
            </tr>
            <tr>
                <td><label>Prijzen weergeven</label></td>
                <td style="width: 25%;"><input type="radio" name="price" value="0" <?php echo oypie_checked($price, 0, true)?> /> Ja</td>
                <td colspan="2" style="width: 25%;"><input type="radio" name="price" value="1" <?php echo oypie_checked($price, 1, false)?>/> Nee</td>

            </tr>
            <tr>
                <td><label>Aanvullende opmaak</label></td>
                <td style="width: 25%;"><input type="radio" name="style" value="1" <?php echo oypie_checked($style, 1, false)?> /> Ja</td>
                <td style="width: 25%;"><input type="radio" name="style" value="0" <?php echo oypie_checked($style, 0, true)?>/> Nee</td>
                <td><small>De aanvullende opmaak haalt de OYPO-reclame weg, en de overige opmaak waardoor de prijslijst zich aanpast aan uw layout.</small></td>
            </tr>
            <tr><td colspan="4"><input type="submit" name="submit" id="submit" class="button button-primary" value="Maak code"  /></td></tr>
        </table>
    </form>
    </div>
    </div>

    <?php if($output) {?>
    <div class="postbox oypie-postbox">
    <div class="inside">
    <h2>Uw shortcode</h2>
        <code><?php echo $output;?></code><br>
    <p>Deze shortcode kan u op elke pagina, nieuwsbericht en dergelijke plakken. Of gebruik de versimpelde shortcode generator in de WYSIWYG-editor.</p>
    </div>
    </div>
    <?php } ?>
</div>
