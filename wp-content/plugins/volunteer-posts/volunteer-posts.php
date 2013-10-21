<?php
/*
Plugin Name: Volunteer Posts
Plugin URI: http://joefitter.com
Description: Shortcode for including volunteer posts in a post
Version: 1.0
Author: Joe Fitter
Author URI: http://joefitter.com
*/

function volunteer_posts_get_jobs_by_project($project, $order){
	$args = array("post_type" => "volunteer", "order_by" => "date", "order" => $order, 'job_tags' => $project);
	return new WP_Query($args);
}

function volunteer_posts($atts, $content){
	extract(shortcode_atts( array(
		'project' => 'ASpire',
		'order' => 'ASC'
	), $atts ));
	$return = "";
	$posts = volunteer_posts_get_jobs_by_project($project, $order);
	$return .= '<ul class="volunteer-tabs">';
	if($posts->have_posts()) : while($posts->have_posts()) : $posts->the_post();
		$return .= 	'<li><a class="job-teaser" href="' . get_permalink() . '">' . get_the_title() . '</a></li>';

	endwhile; 
	else : $return .= 'Sorry, there are currently no vacancies for this project';
	$return .= "</ul>";
	endif;
	return $return;
}

add_shortcode( "volunteer", "volunteer_posts" );

?>
