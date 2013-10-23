<?php

add_theme_support( 'post-thumbnails' );

add_action("init", "create_tab_taxonomies", 0);
add_action("init", "create_volunteer_taxonomies", 0);
add_action("init", "create_story_taxonomies", 0);
register_sidebar();

function create_tab_taxonomies(){
	$labels = array(
		'name' 				=> _x('Pages', 'taxonomy general name'),
		'singular_name' 	=> _x('Page', 'taxonomy singular name'),
		'search_items' 		=> __('Search Pages'),
		'add_items'			=> __('All Pages'),
		'parent_item'		=> __('Parent Page'),
		'parent_item_colon'	=> __('Parent Page:'),
		'edit_item'			=> __('Edit Page'),
		'update_item'		=> __('Update Page'),
		'add_new_item'		=> __('Add New Page'),
		'new_item_name'		=> __('New Page Name'),
		'menu_name'			=> __('Page')
	);

	$args = array(
		'hierarchical'		=> true,
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column' => true,
		'query_var'			=> true,
		'rewrite'			=> array('slug', 'page'),
	);

	register_taxonomy( 'tab_page', array('tab'), $args );
}

function create_story_taxonomies(){
	$labels = array(
		'name' 				=> _x('Projects', 'taxonomy general name'),
		'singular_name' 	=> _x('Project', 'taxonomy singular name'),
		'search_items' 		=> __('Search Projects'),
		'add_items'			=> __('All Projects'),
		'parent_item'		=> __('Parent Project'),
		'parent_item_colon'	=> __('Parent Project:'),
		'edit_item'			=> __('Edit Project'),
		'update_item'		=> __('Update Project'),
		'add_new_item'		=> __('Add New Project'),
		'new_item_name'		=> __('New Project Name'),
		'menu_name'			=> __('Project')
	);

	$args = array(
		'hierarchical'		=> true,
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column' => true,
		'query_var'			=> true
	);

	register_taxonomy( 'story_project', array('story'), $args );

	$labels = array(
		'name' 				=> _x('Tags', 'taxonomy general name'),
		'singular_name' 	=> _x('Tag', 'taxonomy singular name'),
		'search_items' 		=> __('Search Tags'),
		'add_items'			=> __('All Tags'),
		'parent_item'		=> __('Parent Tag'),
		'parent_item_colon'	=> __('Parent Tag:'),
		'edit_item'			=> __('Edit Tag'),
		'update_item'		=> __('Update Tag'),
		'add_new_item'		=> __('Add New Tag'),
		'new_item_name'		=> __('New Project Tag'),
		'menu_name'			=> __('Tag')
	);

	$args = array(
		'hierarchical'		=> false,
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column' => true,
		'query_var'			=> true
	);

	register_taxonomy( 'story_tag', array('story'), $args );
}

function create_volunteer_taxonomies(){
	$labels = array(
		'name' 				=> _x('Tags', 'taxonomy general name'),
		'singular_name' 	=> _x('Tag', 'taxonomy singular name'),
		'search_items' 		=> __('Search Tags'),
		'add_items'			=> __('All Tags'),
		'parent_item'		=> __('Parent Tag'),
		'parent_item_colon'	=> __('Parent Tag:'),
		'edit_item'			=> __('Edit Tag'),
		'update_item'		=> __('Update Tag'),
		'add_new_item'		=> __('Add New Tag'),
		'new_item_name'		=> __('New Tag Name'),
		'menu_name'			=> __('Tag')
	);

	$args = array(
		'hierarchical'		=> true,
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column' => true,
		'query_var'			=> true,
		'rewrite'			=> array('slug', 'tag'),
	);

	register_taxonomy( 'job_tags', array('volunteer'), $args );
}

function projects_post_type() {
	$labels = array(
		'name'               => _x( 'Projects', 'post type general name' ),
		'singular_name'      => _x( 'Project', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Project' ),
		'edit_item'          => __( 'Edit Project' ),
		'new_item'           => __( 'New Project' ),
		'all_items'          => __( 'All Projects' ),
		'view_item'          => __( 'View Projects' ),
		'search_items'       => __( 'Search Projects' ),
		'not_found'          => __( 'No projects found' ),
		'not_found_in_trash' => __( 'No projects found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Projects'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our projects and project specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'has_archive'   => true,
		'rewrite'		=> array( 'slug' => 'projects')
	);
	register_post_type( 'project', $args );	
}
add_action( 'init', 'projects_post_type' );

function stories_post_type() {
	$labels = array(
		'name'               => _x( 'Stories', 'post type general name' ),
		'singular_name'      => _x( 'Story', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Story' ),
		'edit_item'          => __( 'Edit Story' ),
		'new_item'           => __( 'New Story' ),
		'all_items'          => __( 'All Stories' ),
		'view_item'          => __( 'View Stories' ),
		'search_items'       => __( 'Search Stories' ),
		'not_found'          => __( 'No stories found' ),
		'not_found_in_trash' => __( 'No stories found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Stories'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our stories and story specific data',
		'public'        => true,
		'show_ui' 		=> true,
		'menu_position' => 6,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => false,
	);
	register_post_type( 'story', $args );	
}
add_action( 'init', 'stories_post_type' );

function tabs_post_type() {
	$labels = array(
		'name'               => _x( 'Tabs', 'post type general name' ),
		'singular_name'      => _x( 'Tab', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Tab' ),
		'edit_item'          => __( 'Edit Tab' ),
		'new_item'           => __( 'New Tab' ),
		'all_items'          => __( 'All Tabs' ),
		'view_item'          => __( 'View Tabs' ),
		'search_items'       => __( 'Search Tabs' ),
		'not_found'          => __( 'No tabs found' ),
		'not_found_in_trash' => __( 'No tabs found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Tabs'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our tabs and tab specific data',
		'public'        => false,
		'show_ui' 		=> true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'has_archive'   => false
	);
	register_post_type( 'tab', $args );	
}
add_action( 'init', 'tabs_post_type' );

function jobs_post_type() {
	$labels = array(
		'name'               => _x( 'Jobs', 'post type general name' ),
		'singular_name'      => _x( 'Job', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Job' ),
		'edit_item'          => __( 'Edit Job' ),
		'new_item'           => __( 'New Job' ),
		'all_items'          => __( 'All Jobs' ),
		'view_item'          => __( 'View Jobs' ),
		'search_items'       => __( 'Search Jobs' ),
		'not_found'          => __( 'No jobs found' ),
		'not_found_in_trash' => __( 'No jobs found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Jobs'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our jobs and jobs specific data',
		'public'        => false,
		'show_ui' 		=> true,
		'menu_position' => 8,
		'supports'      => array( 'title', 'editor'),
		'has_archive'   => false
	);
	register_post_type( 'job', $args );	
}
add_action( 'init', 'jobs_post_type' );

function volunteer_post_type() {
	$labels = array(
		'name'               => _x( 'Volunteer Positions', 'post type general name' ),
		'singular_name'      => _x( 'Volunteer Position', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Volunteer Position' ),
		'edit_item'          => __( 'Edit Volunteer Position' ),
		'new_item'           => __( 'New Volunteer Position' ),
		'all_items'          => __( 'All Volunteer Positions' ),
		'view_item'          => __( 'View Volunteer Positions' ),
		'search_items'       => __( 'Search Volunteer Positions' ),
		'not_found'          => __( 'No volunteer positions found' ),
		'not_found_in_trash' => __( 'No volunteer positions found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Volunteer Positions'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our volunteer positions and volunteer position specific data',
		'public'        => true,
		'show_ui' 		=> true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor'),
		'has_archive'   => false,
		'rewrite'		=> array( 'slug' => 'volunteer-vacancies')
	);
	register_post_type( 'volunteer', $args );	
}
add_action( 'init', 'volunteer_post_type' );

function team_post_type() {
	$labels = array(
		'name'               => _x( 'Team Members', 'post type general name' ),
		'singular_name'      => _x( 'Team Member', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Team Member' ),
		'edit_item'          => __( 'Edit Team Member' ),
		'new_item'           => __( 'New Team Member' ),
		'all_items'          => __( 'All Team Members' ),
		'view_item'          => __( 'View Team Members' ),
		'search_items'       => __( 'Search Team Members' ),
		'not_found'          => __( 'No team members' ),
		'not_found_in_trash' => __( 'No team members found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Team Members'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our team members and team member specific data',
		'public'        => false,
		'show_ui' 		=> true,
		'menu_position' => 8,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => false
	);
	register_post_type( 'team-member', $args );	
}

if( class_exists( 'kdMultipleFeaturedImages' ) ) {

        $args = array(
                'id' => 'featured-image-2',
                'post_type' => 'project',
                'labels' => array(
                    'name'      => 'Featured image 2',
                    'set'       => 'Set featured image 2',
                    'remove'    => 'Remove featured image 2',
                    'use'       => 'Use as featured image 2',
                )
        );

        new kdMultipleFeaturedImages( $args );
}

add_action( 'init', 'team_post_type' );

function get_featured_post_by_cat($cat){
	$args = array("post_type"=>"post", "orderby" => "rand", "posts_per_page" => "1", "tag" => "Featured", "category_name" => $cat);
	return new WP_Query($args);
}

function get_featured_story_by_project($project){
	$args = array("post_type"=>"story", "orderby" =>"rand", "posts_per_page" => "1", "story_project"=>"Story " . $project, "story_tag" => "Featured");
	return new WP_Query($args);
}

function get_posts_by_type($type, $order = "ASC", $filter = "", $value = "", $cat = ""){
	$args = array("post_type" => $type, "orderby" => "date", "order" => $order, $filter => $value, "category_name" => $cat);
	return new WP_Query($args);
}

function get_tag_cloud_text($count){
	return $count . " posts.";
}

function get_tabs_by_page($page){
	$args = array("post_type" => "tab", 'tab_page' => $page, 'orderby' => "date", "order" => "ASC");
	return new WP_Query($args);
}

function get_permalink_from_page_name($page_name){
	return esc_url( get_permalink( get_page_by_title($page_name) ) );
}

function name_to_id($name){
	return str_replace(" ", "-", (strtolower($name)));
}

function get_right_arrow_html() {
	return '<img class="right-arrow" src="' . get_bloginfo("stylesheet_directory") . '/img/arrow-right.png"/>';
}

function get_subtitle($id) {
	return get_post_meta($id, "subtitle", true);
}

function get_tab_label($id) {
	return get_post_meta($id, "tab_label", true);
}

function get_the_number($id) {
	return get_post_meta($id, "number", true);
}

function get_project_id($id) {
	return get_post_meta($id, "project_id", true);
}

function get_content_by_ID($id) {
	$page_data = get_page($id);
	return do_shortcode($page_data->post_content);
}

function get_featured_image_url($id){
	return wp_get_attachment_url( get_post_thumbnail_id( $id ) );
}

function get_the_secondary_title($id){
	return get_post_meta( $id, "alternate_name", true );
}

function get_layout($id){
	$layout = get_post_meta($id, "tab_layout", true);
	switch($layout){
		case "left":
			return "fl";
			break;
		case "right":
			return "fr";
			break;
		case "full":
			return "full";
			break;
		default:
			return "fl";
			break;
	}
}

$callToActions = array(	
	"get-help" => array(
		"text" => "Get help from",
		"url" => get_permalink_from_page_name("Get Help")
	),
	"volunteer" => array(
		"text" => "Volunteer for",
		"url" => get_permalink_from_page_name("Volunteer")
	),
	"donate" => array(
		"text" => "Donate to",
		"url" => get_permalink_from_page_name("Donate")
	),
	"projects" => array(
		"text" => "Learn more about",
		"url" => get_permalink_from_page_name("Projects")
	)
);

function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function get_call_to_action_buttons($page){
	switch ($page) {
		case 'Get Support':
			$link1 = "Donate";
			$text1 = "Donate to";
			$link2 = "Volunteer";
			$text2 = "Volunteer for";
			break;
		case 'Donate':
			$link1 = "Get Support";
			$text1 = "Get support with";
			$link2 = "Volunteer";
			$text2 = "Volunteer for";
			break;
		case 'Volunteer':
			$link1 = "Get Support";
			$text1 = "Get support with";
			$link2 = "Donate";
			$text2 = "Donate to";
			break;
		default:
			$link1 = "Donate";
			$text1 = "Donate to";
			$link2 = "Volunteer";
			$text2 = "Volunteer for";
			break;
	}

	return '<a href="' . get_permalink_from_page_name($link1) .'" class="call-to-action">
				<span>'.$text1.'</span> 
				<span class="charityName">Impetus</span>
				' . get_right_arrow_HTML() . '
			</a>
			<a href="' . get_permalink_from_page_name($link2) .'" class="call-to-action">
				<span>'.$text2.'</span> 
				<span class="charityName">Impetus</span>
				' . get_right_arrow_HTML() . '
			</a>';
}

function add_custom_box_for_projects(){
	add_meta_box("custom_box_for_projects", "Project Info", "custom_box_for_projects", "project", "side");
}

function custom_box_for_projects($post){
	wp_nonce_field("custom_box_for_projects", "custom_box_for_projects_nonce");

	$call_to_action_left = get_post_meta($post->ID, "call_to_action_left", true);
	$call_to_action_right = get_post_meta($post->ID, "call_to_action_right", true);
	$overlay_subtitle = get_post_meta($post->ID, "overlay_subtitle", true);
	$alternate_name = get_post_meta( $post->ID, "alternate_name", true);

	echo '<p class="description">Alternate Name</p>
	<input type="text" class="widefat" name="alternate_name" id="alternate_name" value="' .esc_attr( $alternate_name ) . '" />
	<p class="description">Call to action - Left</p>
	<input type="text" class="widefat" name="call_to_action_left" id="call_to_action_left" value="' .esc_attr( $call_to_action_left ) . '" />
	<p class="description">Call to action - Right</p>
	<input type="text" class="widefat" name="call_to_action_right" id="call_to_action_right" value="' .esc_attr( $call_to_action_right ) . '" />
	<p class="description">Overlay subtitle</p>
	<textarea class="widefat" rows="7" name="overlay_subtitle" id="overlay_subtitle">' .esc_attr( $overlay_subtitle ) . '</textarea>';
}

add_action("add_meta_boxes", "add_custom_box_for_projects");

function custom_box_for_projects_save($post_id){
	if(!isset($_POST['custom_box_for_projects_nonce'])){
		return $post_id;
	}

	$nonce = $_POST["custom_box_for_projects_nonce"];

	if(! wp_verify_nonce( $nonce, 'custom_box_for_projects' )){
		return $post_id;
	}

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
		return $post_id;
	}

	if("page" == $_POST["post_type"]){
		if(! current_user_can( "edit_page", $post_id )){
			return $post_id;
		}
	} else {
		if(! current_user_can("edit_post", $post_id)){
			return $post_id;
		}
	}

	$call_to_action_left = sanitize_text_field( $_POST["call_to_action_left"] );
	$call_to_action_right = sanitize_text_field( $_POST["call_to_action_right"] );
	$overlay_subtitle = sanitize_text_field( $_POST["overlay_subtitle"] );
	$alternate_name = sanitize_text_field( $_POST["alternate_name"] );

	update_post_meta($post_id, "call_to_action_left", $call_to_action_left);
	update_post_meta($post_id, "call_to_action_right", $call_to_action_right);
	update_post_meta($post_id, "overlay_subtitle", $overlay_subtitle);
	update_post_meta($post_id, "alternate_name", $alternate_name);
}

add_action("save_post", "custom_box_for_projects_save");


function add_custom_box_for_team(){
	add_meta_box("custom_box_for_team", "Team Member Info", 'custom_box_for_team', 'team-member', "side");
}

function custom_box_for_team($post){
	wp_nonce_field('custom_box_for_team', 'custom_box_for_team_nonce');

	$job_description = get_post_meta($post->ID, "job_description", true);
	$project_name = get_post_meta($post->ID, "project_name", true);

	echo '<p class="description">Job Title</p>
		<input type="text" class="widefat" name="job_description" id="job_description" value="'.esc_attr($job_description).'" />
		<p class="description">Project (if applicable)</p>
		<input type="text" class="widefat" name="project_name" id="project_name" value="'.esc_attr($project_name).'" />';
}

add_action("add_meta_boxes", "add_custom_box_for_team");

function custom_box_for_team_save($post_id){
	if(!isset($_POST['custom_box_for_team_nonce'])){
		return $post_id;
	}

	$nonce = $_POST["custom_box_for_team_nonce"];

	if(! wp_verify_nonce( $nonce, 'custom_box_for_team' )){
		return $post_id;
	}

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
		return $post_id;
	}

	if("page" == $_POST["post_type"]){
		if(! current_user_can( "edit_page", $post_id )){
			return $post_id;
		}
	} else {
		if(! current_user_can("edit_post", $post_id)){
			return $post_id;
		}
	}

	$job_description = sanitize_text_field( $_POST["job_description"] );
	$project_name = sanitize_text_field( $_POST["project_name"] );

	update_post_meta($post_id, "job_description", $job_description);
	update_post_meta($post_id, "project_name", $project_name);
}

add_action("save_post", "custom_box_for_team_save");



function add_custom_box_for_tabs(){
	add_meta_box("custom_box_for_tabs", "Tab Info", 'custom_box_for_tabs', 'tab', "side");
}

function custom_box_for_tabs($post){
	wp_nonce_field('custom_box_for_tabs', 'custom_box_for_tabs_nonce');

	$project_id = get_post_meta($post->ID, "project_id", true);
	$tab_label = get_post_meta($post->ID, "tab_label", true);
	$phone_number = get_post_meta($post->ID, "number", true);
	$tab_layout = get_post_meta($post->ID, "tab_layout", true);

	if(!$tab_layout){
		$tab_layout = "left";
	}

	$res = '<p class="description">Project ID</p>
	<input type="text" class="widefat" name="project_id" id="project_id" value="' .esc_attr( $project_id ) . '" />
	<p class="description">Tab Label (uses Project ID if blank)</p>
	<input type="text" class="widefat" name="tab_label" id="tab_label" value="' .esc_attr( $tab_label ) . '" />
	<p class="description">Phone Number</p>
	<input type="text" class="widefat" name="phone_number" id="phone_number" value="' .esc_attr( $phone_number ) . '" /><br >
	<p class="description">Tab Layout</p>
	<input type="radio" name="tab_layout" value="left" id="layout_left" ';
	if($tab_layout === "left"){
		$res.= "checked";
	}
	$res.= ' /><label for="layout_left">Float left</label><br />
	<input type="radio" name="tab_layout" value="right" id="layout_right" ';
	if($tab_layout === "right"){
		$res.= "checked";
	}
	$res.= ' /><label for="layout_right">Float right</label><br />
	<input type="radio" name="tab_layout" value="full" id="layout_full" ';
	if($tab_layout === "full"){
		$res.="checked";
	}
	$res.= ' /><label for="layout_full">Full width</label>';

	echo $res;
}

add_action("add_meta_boxes", "add_custom_box_for_tabs");

function custom_box_for_tabs_save($post_id){
	if(!isset($_POST['custom_box_for_tabs_nonce'])){
		return $post_id;
	}

	$nonce = $_POST["custom_box_for_tabs_nonce"];

	if(! wp_verify_nonce( $nonce, 'custom_box_for_tabs' )){
		return $post_id;
	}

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
		return $post_id;
	}

	if("page" == $_POST["post_type"]){
		if(! current_user_can( "edit_page", $post_id )){
			return $post_id;
		}
	} else {
		if(! current_user_can("edit_post", $post_id)){
			return $post_id;
		}
	}

	$project_id = sanitize_text_field( $_POST["project_id"] );
	$tab_label = sanitize_text_field( $_POST["tab_label"] );
	$phone_number = sanitize_text_field( $_POST["phone_number"] );
	$tab_layout = sanitize_text_field( $_POST["tab_layout"] );

	update_post_meta($post_id, "project_id", $project_id);
	update_post_meta($post_id, "tab_label", $tab_label);
	update_post_meta($post_id, "number", $phone_number);
	update_post_meta($post_id, "tab_layout", $tab_layout);
}

add_action("save_post", "custom_box_for_tabs_save");

function add_custom_box_for_pages() {
	add_meta_box( "custom_meta_for_pages", "Page Info", 'custom_box_for_pages', 'page' );
}

function custom_box_for_pages($post){
	wp_nonce_field('custom_box_for_pages', 'custom_box_for_pages_nonce');

	$subtitle = get_post_meta($post->ID, "subtitle", true);
	$overlay_subtitle = get_post_meta($post->ID, "overlay_subtitle", true);

	echo '<p class="description">Subtitle</p>
	<textarea class="widefat" name="subtitle" id="subtitle">' . esc_attr( $subtitle ) . '</textarea>
	<p class="description">Overlay Subtitle (overlay hidden if empty)</p>
	<textarea class="widefat" name="overlay_subtitle" id="overlay_subtitle">' . esc_attr($overlay_subtitle) . '</textarea>';
}

add_action("add_meta_boxes", "add_custom_box_for_pages");

function custom_box_for_pages_save($post_id){
	if(!isset($_POST['custom_box_for_pages_nonce'])){
		return $post_id;
	}

	$nonce = $_POST["custom_box_for_pages_nonce"];

	if(! wp_verify_nonce( $nonce, 'custom_box_for_pages' )){
		return $post_id;
	}

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
		return $post_id;
	}

	if("page" == $_POST["post_type"]){
		if(! current_user_can( "edit_page", $post_id )){
			return $post_id;
		}
	} else {
		if(! current_user_can("edit_post", $post_id)){
			return $post_id;
		}
	}

	$subtitle = sanitize_text_field( $_POST["subtitle"] );
	$overlay_subtitle = sanitize_text_field( $_POST["overlay_subtitle"] );

	update_post_meta($post_id, "subtitle", $subtitle);
	update_post_meta($post_id, "overlay_subtitle", $overlay_subtitle);
}

add_action("save_post", "custom_box_for_pages_save");

function add_custom_box_for_jobs() {
	$screens = array("job", "volunteer");

	foreach($screens as $screen){
		add_meta_box(
			"myplugin_sectionid",
			__("Job Info", "myplugin_textdomain"),
			'myplugin_inner_custom_box',
			$screen
		);
	}
}

add_action("add_meta_boxes", "add_custom_box_for_jobs");

function myplugin_inner_custom_box($post){
	wp_nonce_field('myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce');

	$job_hours = get_post_meta($post->ID, '_job_hours', true);
	$job_salary = get_post_meta($post->ID, '_job_salary', true);
	$job_status = get_post_meta($post->ID, '_job_status', true);
	$job_closing_date = get_post_meta($post->ID, '_job_closing_date', true);
	$job_interviews = get_post_meta($post->ID, '_job_interviews', true);

	echo '
		<p>
			<label for="job_hours">Hours</label>
			<textarea class="widefat" id="job_hours" name="job_hours">' . esc_attr($job_hours) . '</textarea>
		</p>
		<p>
			<label for="job_salary">Salary</label>
			<textarea class="widefat" id="job_salary" name="job_salary">' . esc_attr($job_salary) . '</textarea>
		</p>
		<p>
			<label for="job_status">Status</label>
			<textarea class="widefat" id="job_status" name="job_status">' . esc_attr($job_status) . '</textarea>
		</p>
		<p>
			<label for="job_closing_date">Closing date</label>
			<textarea class="widefat" id="job_closing_date" name="job_closing_date">' . esc_attr($job_closing_date) . '</textarea>
		</p>
		<p>
			<label for="job_interviews">Interviews</label>
			<textarea class="widefat" id="job_interviews" name="job_interviews">' . esc_attr($job_interviews) . '</textarea>
		</p>';
}

function myplugin_save_postdata($post_id){
	if(!isset($_POST['myplugin_inner_custom_box_nonce'])){
		return $post_id;
	}

	$nonce = $_POST["myplugin_inner_custom_box_nonce"];

	if(! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' )){
		return $post_id;
	}

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
		return $post_id;
	}

	if("page" == $_POST["post_type"]){
		if(! current_user_can( "edit_page", $post_id )){
			return $post_id;
		}
	} else {
		if(! current_user_can("edit_post", $post_id)){
			return $post_id;
		}
	}

	$job_hours = sanitize_text_field( $_POST["job_hours"] );
	$job_salary = sanitize_text_field( $_POST["job_salary"] );
	$job_status = sanitize_text_field( $_POST["job_status"] );
	$job_closing_date = sanitize_text_field( $_POST["job_closing_date"] );
	$job_interviews = sanitize_text_field( $_POST["job_interviews"] );

	update_post_meta($post_id, "_job_hours", $job_hours);
	update_post_meta($post_id, "_job_salary", $job_salary);
	update_post_meta($post_id, "_job_status", $job_status);
	update_post_meta($post_id, "_job_closing_date", $job_closing_date);
	update_post_meta($post_id, "_job_interviews", $job_interviews);
}

add_action("save_post", "myplugin_save_postdata");