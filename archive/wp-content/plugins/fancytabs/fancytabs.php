<?php
/*
Plugin Name: FancyTabs
Plugin URI: https://github.com/GhostToast/FancyTabs
Description: Shortcode driven in-page jQuery tab navigation DO NOT UPDATE
Version: 1.0.2 - DO NOT UPDATE
Author: Gustave F. Gerhardt modified for Impetus by Joe Fitter - DO NOT UPDATE
Author URI: http://www.morningstarmediagroup.com
*/

function fancytabs_styles() {
        if ( is_readable( plugin_dir_path( __FILE__ ) . 'fancytabs.css' ) ) {
            wp_enqueue_style( 'Fancy-Tabs-Styles', plugin_dir_url( __FILE__ ) . 'fancytabs.css', array(), '0.1', 'screen' );
        }
}
add_action( 'wp_enqueue_scripts', 'fancytabs_styles' );

function fancytabs_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'fancytabs_scripts');

add_shortcode( 'fancytabs', 'fancytabs_group' );
function fancytabs_group( $atts, $content ){
	$GLOBALS['tab_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['tabs'] ) ){
		$is_project = is_singular( "project" );
		$float_left = $is_project ? " left-side" : "";
		$int = 1;
		$color_on = '#97c947';
		$color_off = '#2f97dd';
		foreach( $GLOBALS['tabs'] as $tab ){
			$ids[] = "\"" . $tab['id'] . "\"";
			$names[] = "\"" . $tab["name"] . "\"";
			$code[] = '$("#tabs-link-'.$tab["id"].'").click (function (event) {
							$(".link-catch-all").css("background-color", "'.$color_off.'");
							$("#tabs-link-'.$tab["id"].'").css("background-color", "'.$color_on.'");
							$(".tabs-catch-all").hide();
							$("#tabs-'.$tab["id"].'").show();
							activeTab = "'.$tab["id"].'";
							parent.location.hash = activeTab;
							$("span.charityName").html("'.$tab["name"].'");
							$("input[name=\"subject\"]").val("Contact Form - '.$tab["name"].'");
							$("a.call-to-action:not(.no-change)").each(function(){
								var $this = $(this);
								var href = $this.attr("href");
								href = href.substring(0, href.indexOf("#"));
								$this.attr("href", href + "#'.$tab["id"].'");
							});
			});';
			$tabs[] = '<li><a class="link-catch-all" id="tabs-link-'.$tab["id"].'">'.$tab['title'].'</a></li>';
			$line = '<div id="tabs-'.$tab["id"].'" class="tabs-catch-all"><h1 class="tab-title">'.$tab['displaytitle'];
			if(!$is_project){
				$line .= '<span class="call-direct">Call direct <a class="number" href="tel:'.$tab["number"].'">'.$tab["number"].'</a><img class="phone" src="'.get_bloginfo("stylesheet_directory").'/img/phone.png"></span>';
			}
			$line .= '</h1><div class="tab-inner' . $float_left . '">'.do_shortcode($tab['content']).'</div></div>'."\n";
			$panes[] = $line;
			
			$int++;
		}
		$return = 	'<script type ="text/javascript">
						var activeTab, activeTabName;
						var ids = [' . implode($ids, ",") . '];
						var names = [' . implode($names, ",") . '];
						$(document).ready(function() {
							if(window.location.hash){
								activeTab = window.location.hash.replace("#", "");
							}
							if(ids.indexOf(activeTab) == -1){
								activeTab = null;
							} else {
								activeTabName = names[ids.indexOf(activeTab)];
							}
							activeTab = activeTab || "'.$GLOBALS['tabs'][0]['id'].'";
							activeTabName = activeTabName || "'.$GLOBALS['tabs'][0]["name"].'";
							$(".link-catch-all").css("background-color", "'.$color_off.'");
							$("#tabs-link-" + activeTab).css("background-color", "'.$color_on.'");
							$(".tabs-catch-all").hide();
							$("#tabs-" + activeTab).show();
							$("span.charityName").html(activeTabName);
							$("input[name=\"subject\"]").val("Contact Form - " + activeTabName);
							$("a.call-to-action:not(.no-change)").each(function(){
								var $this = $(this);
								var href = $this.attr("href");
								if($this.hasClass("no-hash")){
									$this.attr("href", href + activeTab);
								} else {
									$this.attr("href", href + "#" + activeTab);
								}
								
							});
							'.implode( "\n", $code ).'
						});
					</script>
					<div id="fancy-tabs">
						<ul class="tabs">'.implode( "\n", $tabs ).'</ul>
					</div></div></div></div><div class="fancy-tabs-line"></div><div class="wrapper">'."\n"
					.implode( "\n", $panes )
					.'';
	}
	return $return;
}

add_shortcode( 'tab', 'fancy_tab' );
function fancy_tab( $atts, $content ){
	extract(shortcode_atts(array(
			'title' => 'Tab %d', 'displaytitle' => '[Enter Title]', 'id' => '[Enter ID]', 'name' => '[Enter Nice Name]', 'number' => '[Enter contact number]'), $atts) );
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'displaytitle' => $displaytitle, 'id' => $id, 'name' =>$name, 'number' => $number, 'content' => $content );
	$GLOBALS['tab_count']++;
}
?>