<?php
/**
 * 
 * EPS 301 REDIRECTS
 * 
 * 
 * 
 * This plugin creates a nice Wordpress settings page for creating 301 redirects on your Wordpress 
 * blog or website. Often used when migrating sites, or doing major redesigns, 301 redirects can 
 * sometimes be a pain - it's my hope that this plugin helps you seamlessly create these redirects 
 * in with this quick and efficient interface.
 * 
 * PHP version 5
 *
 *
 * @package    EPS 301 Redirects
 * @author     Shawn Wernig ( shawn@eggplantstudios.ca )
 * @version    1.4.0
 */

 
/*
Plugin Name: Eggplant 301 Redirects
Plugin URI: http://www.eggplantstudios.ca
Description: Create your own 301 redirects using this powerful plugin.
Version: 1.4.0
Author: Shawn Wernig http://www.eggplantstudios.ca
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define ( 'EPS_REDIRECT_PATH', plugin_dir_path(__FILE__) );
define ( 'EPS_REDIRECT_URL', plugin_dir_url( __FILE__ ) );
define ( 'EPS_REDIRECT_VERSION', '1.4.0');

register_activation_hook(__FILE__, array('EPS_Redirects', 'eps_redirect_activation'));
register_deactivation_hook(__FILE__, array('EPS_Redirects', 'eps_redirect_deactivation'));


class EPS_Redirects {
    
    static $option_slug = 'eps_redirects';
    static $option_section_slug = 'eps_redirects_list';
    static $page_slug = 'eps_redirects';
    static $page_title = '301 Redirects';


    public function __construct(){
        if(is_admin()){
            add_action('admin_menu', array($this, 'add_plugin_page'));
            add_action('admin_init', array($this, '_save'));
            add_action('wp_ajax_eps_redirect_get_new_entry',  array($this, 'ajax_get_blank_entry') ); 
            add_action('init', array($this, 'enqueue_resources'));
            add_action('admin_footer_text',  array($this, 'set_ajax_url'));
        }
        add_action('wp_footer',  array($this, 'set_ajax_url'));
        add_action('init', array($this,'do_redirect'), 1); // Priority 1 for redirects.
    }
    
    public static function eps_redirect_activation() {
            self::check_version();
    }
    public static function eps_redirect_deactivation() {
            //update_option( self::$option_slug, null );
            //update_option( 'eps_redirects_version', null );        
    }
    
    
     /**
     * 
     * CHECK VERSION
     * 
     * This function will check the current version and do any fixes required
     * 
     * @return html string
     * @author epstudios
     *      
     */
    public function check_version() {
        $version = get_option( 'eps_redirects_version' );
        
        if ( !isset($version) || empty( $version ) ) {
            // no version is set. versions started being stored at 1.3.1
            // because in 1.3.1 we did a big database storage change, we need to fix old versions storage

            $redirects = get_option( self::$option_slug );
            if (empty($redirects)) return false; // no redirects anyways, so dont do anything.

            foreach ($redirects as $to => $from ) {
                $new_redirects[$from] = $to;
            }
            update_option( self::$option_slug, $new_redirects );
        }
        
        switch( $version ) {
            case '1.3.2':
                // do stuff
            default:
                break;   
        }
        update_option( 'eps_redirects_version', EPS_REDIRECT_VERSION );
        return EPS_REDIRECT_VERSION;
    }
    
    
    /**
     * 
     * ENQUEUE_RESOURCES
     * 
     * This function will queue up the javascript and CSS for the plugin.
     * 
     * @return html string
     * @author epstudios
     *      
     */
    public function enqueue_resources(){
        wp_enqueue_script('jquery');
        wp_enqueue_script('eps_redirect_script', EPS_REDIRECT_URL .'/js/scripts.js');
        wp_enqueue_style('eps_redirect_styles', EPS_REDIRECT_URL .'css/eps_redirect.css');
    }
    
    /**
     * 
     * ADD_PLUGIN_PAGE
     * 
     * This function initialize the plugin page.
     * 
     * @return html string
     * @author epstudios
     *      
     */
    public function add_plugin_page(){
        add_options_page('301 Redirects', 'EPS 301 Redirects', 'manage_options', self::$page_slug, array($this, 'do_admin_page'));
    }
    
    /**
     * 
     * DO_REDIRECT
     * 
     * This function will redirect the user if it can resolve that this url request has a redirect.
     * 
     * @author epstudios
     *      
     */
    public function do_redirect() {
        $redirects = get_option( self::$option_slug );
        if (empty($redirects)) return false;
            
        // Get current url
        $url_request = self::get_url();

        foreach ($redirects as $from => $to ) {
            $from = urldecode($from);
            $to = urldecode($to);
            
            if( rtrim($url_request,'/') == self::format_from_url($from) ) {
                // Match, this needs to be redirected
                header ('HTTP/1.1 301 Moved Permanently');
                header ('Location: ' . $to, true, 301);
                exit();
            } 
        }
    }
    private function rawurlencode_parts( $uri ) {
            $parts = explode('/', $uri);
            for ($i = 0; $i < count($parts); $i++) {
              $parts[$i] = rawurlencode($parts[$i]);
            }
            return implode('/', $parts);
    }
    
    private function format_from_url( $string ) {
        $from = get_option('home') . '/' . $string;
        return rtrim($from,'/');    
    }
    /**
     * 
     * GET_URL
     * 
     * This function returns the current url.
     * 
     * @return URL string
     * @author epstudios
     *      
     */
    function get_url() {
        $protocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? 'https' : 'http';
        return urldecode( $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
    }
        
        
    /**
     * 
     * DO_ADMIN_PAGE
     * 
     * This function will create the admin page.
     * 
     * @author epstudios
     *      
     */
    public function do_admin_page(){
        include ( EPS_REDIRECT_PATH . 'templates/admin.php'  );
    }
    
    /**
     * 
     * _SAVE
     * 
     * This function will list out all the current entries.
     * 
     * @return html string
     * @author epstudios
     *      
     */
    public function _save(){
       
        if ( isset( $_POST['eps_redirect_submit'] ) && wp_verify_nonce( $_POST['eps_redirect_nonce_submit'], 'eps_redirect_nonce') ) 
             $this->_save_redirects();

       if ( isset( $_POST['eps_redirect_settings_submit'] ) && wp_verify_nonce( $_POST['eps_redirect_setting_nonce_submit'], 'eps_redirect_setting_nonce') )
            $this->_save_settings();
    }
    
    private function _save_settings() {
        update_option( 'eps_redirect_settings', $_POST['eps_redirect_settings'] );
    }
    private function _save_redirects() {
       $total_redirects = count( $_POST[self::$option_slug]['to'] ); 
       $redirects = array();
       
       for($i = 0; $i < $total_redirects; $i ++) {
            $to = trim(  $_POST[self::$option_slug]['to'][$i] );
            $to = self::rawurlencode_parts( $to );
            $to = filter_var( $to, FILTER_SANITIZE_URL);
            
            $from = trim( $_POST[self::$option_slug]['from'][$i] );
            $from = self::rawurlencode_parts( $from );
            $from = filter_var( $from, FILTER_SANITIZE_URL);
            $from = ltrim($from, '/');
            
            if( empty($to) ) $to = home_url() . '/'; // default
            
            // If this is a valid entry, add it to the save array.
            if ( !empty($from)) $redirects[$from] = $to;
       }
       // If we then have a valid array - save
       update_option( self::$option_slug, $redirects );
    }
    
    /**
     * 
     * DO_INPUTS
     * 
     * This function will list out all the current entries.
     * 
     * @return html string
     * @author epstudios
     *      
     */
    public function do_inputs(){
        $redirects = get_option( self::$option_slug );
        
        if (empty($redirects)) return false;
        
        foreach ($redirects as $from => $to ) {
            $dfrom = urldecode($from);
            $dto = urldecode($to);  
            
            
                
            $html .= '
            <tr class="redirect-entry">
                <td><span class="eps-grey-text">'.get_bloginfo('home').'/&nbsp;</span><input class="eps-request-url" type="text" name="'.self::$option_slug.'[from][]" value="'. $dfrom .'" > &rarr;</td>
                <td>
                    <input type="text" class="eps-redirect-url" name="'.self::$option_slug.'[to][]"  value="'.$dto.'" >';
                    
            $html .= $this->get_testing_results($from, $dto);      
                    
            $html .='<a class="eps-text-link" href="'.self::format_from_url( $from ).'" target="_blank">Test</a>
                    <a class="eps-text-link remove" href="#" class="eps-redirect-remove">&times;</a>
                </td>
            </tr>';
        }
        return $html;
    }

    
    private static function url_esc_spaces( $url ) {
        return str_replace(' ', '%20', $url);
    }
    /**
     * 
     * GET_BLANK_ENTRY
     * AJAX_GET_BLANK_ENTRY
     * 
     * This function will return a blank row ready for user input.
     * 
     * @return html string
     * @author epstudios
     *      
     */
    public static function get_blank_entry() {
        return '<tr class="redirect-entry">
                    <td><span class="eps-grey-text">'.get_bloginfo('home').'/&nbsp;</span><input class="eps-request-url" type="text" name="'.self::$option_slug.'[from][]" value="" > &rarr;</td>
                    <td>'.self::get_type_select().'</td>
                </tr>';
    }
    public static function ajax_get_blank_entry() {
        echo self::get_blank_entry(); exit();
    }
    
    
     /**
     * 
     * GET_TYPE_SELECT
     * 
     * This function will initialze a series of html form elements so a user can narrow down their redirect destination.
     * 
     * @return html string
     * @author epstudios
     *      
     */
    private function get_type_select(){
        
        // Get a list of primary destinations.
        $post_types = get_post_types(array('public'=>true),'objects'); 
        $html = '<select class="type-select">';
        $html .= '<option value="eps-redirect-url" selected default>Custom</option>';
        foreach ($post_types as $post_type ) {
          $html .= '<option value="'.$post_type->name.'">'. $post_type->labels->singular_name. '</option>';
        }
        $html .= '<option value="term">Term Archive</option>';
        $html .= '</select>';
        
        // The default input, javascript will populate this input with the final URL for submission.
        $html .= '<input class="eps-redirect-url" type="text" name="'.self::$option_slug.'[to][]"  value="" placeholder="'.get_bloginfo('home').'"/>';
        
        // Get all the post type select boxes.
        foreach ($post_types as $post_type )
            $html .=  self::get_post_type_select($post_type->name);
        
        // Get the term select box.
        $html .= self::get_term_archive_select();
        return $html;
    }
    
    
    
     /**
     * 
     * GET_PARENT_INDEX
     * 
     * Scans a custom array of posts to find a parent's position in the array. Used in GET_POST_TYPE_SELECT
     * 
     * @return html string
     * @param $post_type = the post type slug.
     * @author epstudios
     *      
     */
    function find_parent_index( $id, $entries ){
        foreach($entries as $k => $entry ) {
            if ( $entry->ID == $id ) return( $k );
        }
        return false;
    }
    /**
     * 
     * GET_PARENT_INDEX
     * 
     * Scans a custom array of posts to find a parent's position in the array. Used in GET_POST_TYPE_SELECT
     * 
     * @return html string
     * @param $post_type = the post type slug.
     * @author epstudios
     *      
     */
    function get_post_depth( $id ){
        global $wpdb;
        $depth = 0;
        $parent_id = $id;
        while ($parent_id > 0) {
            $parent_id = $wpdb->get_var( "SELECT post_parent FROM $wpdb->posts WHERE ID = $parent_id" );
            $depth ++;
        }
        return $depth;
    }
    
    /**
     * 
     * GET_POST_TYPE_SELECT
     * 
     * This function will output a select box with all the posts in a given post_type.
     * Post types with archives will have an All Posts link.
     * 
     * @return html string
     * @param $post_type = the post type slug.
     * @author epstudios
     *      
     */
    private function get_post_type_select( $post_type ){
        global $wpdb;
        $entries = $wpdb->get_results("SELECT ID, post_title, post_parent 
                    FROM $wpdb->posts
                    WHERE post_status = 'publish' 
                    AND post_type = '$post_type' 
                    ORDER BY  post_title ASC"); 
                    
                    
        if (!$entries) return false;

        // create heirarchy
        
        // get depths
        $max_depth = 0;
        foreach($entries as $k => $entry ) {
            $entry->depth = self::get_post_depth( $entry->post_parent );
            if($entry->depth > $max_depth)  $max_depth = $entry->depth;
        }
        
        // Nest arrays as parent >> children
        for( $i = $max_depth; $i >= 0; $i -- ) {
            foreach( $entries as $k => $entry ) {
                if ( $entry->depth == $i ) {
                    if ( $entry->post_parent > 0 ) {
                    $entry->post_title = '&nbsp;' . str_repeat("-", $depth). ' ' . $entry->post_title;
                    $parent_index = self::find_parent_index( $entry->post_parent, $entries );
                    
                    $entries[$parent_index]->children[] = $entry;
                    unset($entries[$k]);
                    }
                }
            }
        }

        // Start the select.
        $html = '<select class="'.$post_type.' url-selector" style="display:none;">';
        $html .= '<option value="" selected default>...</option>';
        
        // Get the correct archive link
        switch( $post_type ) {
            case 'post': break; // no archive
            case 'page': break; // no archive
            case 'attachment': break; // no archive
            default:
                $html .= '<option value="'.get_post_type_archive_link($post_type).'">All '.eps_prettify($post_type).'s</option>';
        }

        
        // Get all entries and insert them as options.
        foreach ($entries as $entry ) {
           $html .= self::do_post_heirarchy_selects( $entry );
        }
        $html .= '</select>';
        return $html;
    }
    
    function do_post_heirarchy_selects( $entry ) {
         $html .= '<option value="'.get_permalink($entry->ID).'">'. str_repeat("-", $entry->depth) . $entry->post_title . '</option>';
            
            if(  isset( $entry->children ) && !empty(  $entry->children ) ) {
                foreach ($entry->children as $child ) {
                    $html .= self::do_post_heirarchy_selects($child);
                }
            }
        return $html;
    }
    
    /**
     * 
     * GET_TERM_ARCHIVE_SELECT
     * 
     * This function will output a select box with all the taxonomies and terms.
     * 
     * @return html string
     * @author epstudios
     *      
     */
    private function get_term_archive_select(){
        $taxonomies = get_taxonomies( '', 'objects' );
        
        if (!$taxonomies) return false;
        
        // Start the select.
        $html = '<select class="term url-selector" style="display:none;">';
        $html .= '<option value="" selected default>...</option>';
        
        // Loop through all taxonomies.
        foreach ($taxonomies as $tax ) {
            $terms = get_terms( $tax->name, array('hide_empty' => false) ); // show empty terms.
            $html .= '<option value="'.get_permalink($entry->ID).'" disabled>'. $tax->labels->singular_name. '</option>';
            
            // Loop through all terms in this taxonomy and insert them as options.
            foreach($terms as $term)
                $html .= '<option value="'.get_term_link($term).'">&nbsp;&nbsp;- '. $term->name. '</option>';
            
        }
        $html .= '</select>';
        return $html;
    }
    
    /**
     * 
     * SET_AJAX_URL
     * 
     * This function will output a variable containing the admin ajax url for use in javascript.
     * 
     * @author epstudios
     *      
     */
    public static function set_ajax_url() {
        echo '<script>var eps_redirect_ajax_url = "'. admin_url( 'admin-ajax.php' ) . '"</script>';
    }
    
    
    public static function filter_from( $string ) {
        $string = esc_attr($string);
        // If string does not start with a slash, add it
        if( substr($string, 0, 1) != '/') $string = '/' . $string;
        
        return $string;
    }
    
    
    /**
     * 
     * 
     * 
     * Get the testing results for this redirect.
     * 
     */
    private function get_testing_results($from, $to) {
        $settings = get_option( 'eps_redirect_settings' );
        $test_urls = $settings['test_urls'];
        if( isset($test_urls) && $test_urls == 'on' ) {
            
                $redirect_response_code = self::get_response( self::format_from_url( $from ) );
                $redirect_class = ( $redirect_response_code == 301 ) ? 'valid' : 'invalid';
                
                $destination_response_code = self::get_response( self::url_esc_spaces( $to ) );
                $destination_class = ( $destination_response_code == 200 ) ? 'valid' : 'invalid';
                
                return '<span class="eps-text-link eps-notification-area '.$redirect_class.'">'.eps_prettify($redirect_response_code).'</span> &rarr;
                          <span class="eps-text-link eps-notification-area '.$destination_class.'">'.eps_prettify($destination_response_code).'</span>';
        }  
    }
    /**
     * 
     * 
     * Gets the status code for this url.
     * 
     */
    private static function get_response( $url ) {
        // returns int responsecode, or false (if url does not exist or connection timeout occurs)
        // NOTE: could potentially take up to 0-30 seconds , blocking further code execution (more or less depending on connection, target site, and local timeout settings))
        
        if( !$url || !is_string($url)) return false;

        $ch = @curl_init($url);
        
        if($ch === false) return false;

        @curl_setopt($ch, CURLOPT_HEADER         ,true);    // we want headers
        @curl_setopt($ch, CURLOPT_NOBODY         ,true);    // dont need body
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);    // catch output (do NOT print!)
        @curl_exec($ch);

        if( @curl_errno($ch) ) {   // should be 0
            @curl_close($ch);
            return false;
        } else {
            $code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); 
            @curl_close($ch);
            return $code;
        }
        
    }
}



/**
 * Outputs an object or array in a readable form.
 *
 * @return void
 * @param $string = the object to prettify; Typically a string.
 * @author epstudios
 */
function eps_prettify( $string ) {
    return ucwords( str_replace("_"," ",$string) );
}




// Run the plugin.
$EPS_Redirects = new EPS_Redirects();
?>