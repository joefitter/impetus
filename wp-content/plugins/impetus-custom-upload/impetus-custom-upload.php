<?php
/*
Plugin Name: Custom File Upload for Impetus
Plugin URI: http://joefitter.com
Description: Add functionality for including custom uploads in posts
Version: 1.0
Author: Joe Fitter
Author URI: http://joefitter.com
*/

function add_custom_file_upload_box_for_jobs(){
	add_meta_box( "job_application_pack_upload", "Upload Application Pack", "wp_custom_attachment", "job", 'side');
	add_meta_box( "job_application_pack_upload", "Upload Application Pack", "wp_custom_attachment", "volunteer", 'side');
}

add_action("add_meta_boxes", "add_custom_file_upload_box_for_jobs");

function wp_custom_attachment($post){
	wp_nonce_field( plugin_basename(__FILE__), "wp_custom_attachment_nonce" );

	$uploadedFile = get_post_meta( $post->ID, "wp_custom_attachment", true );


	if($uploadedFile){
		echo '<div style="border-bottom:1px solid #dfdfdf;"><p class="description">Current application pack:</p>
		<ul><li>' . $uploadedFile["url"] . '</li></ul></div>';
	}

	echo '<div style="border-top: 1px solid #ffffff;"><p class="description">Upload your .zip application pack here.</p>
		<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" size="25" /></div>';
}

function save_custom_file_upload($id) {
	if(!wp_verify_nonce( $_POST["wp_custom_attachment_nonce"], plugin_basename( __FILE__ ))){
		return $id;
	}

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE){
		return $id;
	}

	if('page' == $_POST["post_type"]){
		if(!current_user_can( "edit_page", $id )){
			return $id;
		}
	} else {
		if(!current_user_can( "edit_post", $id )){
			return $id;
		}
	}

	if(!empty($_FILES["wp_custom_attachment"]["name"])){
		$supportedTypes = array("application/zip");

		$arr_file_type = wp_check_filetype( basename($_FILES["wp_custom_attachment"]["name"]));

		$uploaded_type = $arr_file_type["type"];

		if(in_array($uploaded_type, $supportedTypes)){
			$upload = wp_upload_bits( $_FILES["wp_custom_attachment"]["name"], null, file_get_contents($_FILES["wp_custom_attachment"]["tmp_name"]));

			if(isset($upload["error"]) && $upload["error"] != 0){
				wp_die("There was an error uploading your file. The error is" . $upload['error']);
			} else {
				add_post_meta( $id, "wp_custom_attachment", $upload );
				update_post_meta( $id, "wp_custom_attachment", $upload);
			}
		} else {
			wp_die("The file type you uploaded is not a ZIP.");
		}
	}
}

add_action("save_post", "save_custom_file_upload");

function update_edit_form(){
	echo ' enctype="multipart/form-data"';
}

add_action("post_edit_form_tag", "update_edit_form");

?>