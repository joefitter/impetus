<?php
/*
Plugin Name: Get Team Members /Stories
Plugin URI: http://joefitter.com
Description: Shortcode for including team members
Version: 1.0
Author: Joe Fitter
Author URI: http://joefitter.com
*/

function get_team_members_get_posts_by_type($type, $order, $orderby, $filter = "", $value = ""){
	$args = array("post_type" => $type, "orderby" => $orderby, "order" => $order, 'posts_per_page' => '-1', $filter => $value);
	return new WP_Query($args);
}

function get_team_members($atts, $content){
	extract(shortcode_atts( array(
		'type' => 'team-member',
		'order' => 'ASC',
		'orderby' => 'title'
	), $atts ));
	$posts = get_team_members_get_posts_by_type($type, $order, $orderby);
	$return = "";
	if($posts->have_posts()) : while($posts->have_posts()) : $posts->the_post();
		$return .= 	'<div class="team-member-teaser">
						<div class="thumbnail-image">'.
							get_the_post_thumbnail()
							.'<div class="thumbnail-overlay">
								<h5>'.get_the_title().'</h5>
							</div>
						</div>
						<div class="team-member-bottom">
							<p><em>'.get_post_meta(get_the_ID(), "job_description", true).'</em><br />
							'.get_post_meta(get_the_ID(), "project_name", true).'</p>
						</div>
					</div>';
	endwhile; endif;
	wp_reset_postdata(); wp_reset_query(); rewind_posts();
	return $return;
}

function get_stories($atts, $content){
	extract(shortcode_atts(array(
		'type' => 'story',
		'order' => 'ASC',
		'orderby' => 'date'
	), $atts));
	$posts = get_team_members_get_posts_by_type($type, $order, $orderby, "story_project", "Story " . $GLOBALS['page_title']);
	$return = "";
	if($posts->have_posts()) : while($posts->have_posts()) : $posts->the_post();
		$return .= '<a class="story-teaser-main" href="'.get_permalink().'">
						<div class="story-image">
							'.get_the_post_thumbnail( $post->ID, array(286, 190)).'
							<div class="story-image-overlay">
								<h5>'.get_the_title().'</h5>
							</div>
						</div>
						<div class="story-bottom">
							<div class="story-bottom-inner">
								<p><em>'.get_the_excerpt().'</em></p>
							</div>
						</div>
						<p class="read-more" href="'.get_permalink().'">Read the story</p>
					</a>';
	endwhile; endif;
	wp_reset_postdata(); wp_reset_query(); rewind_posts();

	return $return;
}

add_shortcode( "get_team_members", "get_team_members" );
add_shortcode( "get_stories", "get_stories" );

?>