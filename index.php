<?php 
/*
Plugin Name: ALT Lab Progress Book 
Plugin URI:  https://github.com/
Description: Works with ACF to inform student progress
Version:     1.0
Author:      ALT Lab
Author URI:  http://altlab.vcu.edu
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


add_action('wp_enqueue_scripts', 'progress_book_load_scripts');

function progress_book_load_scripts() {                           
    $deps = array('jquery');
    $version= '1.0'; 
    $in_footer = true;    
    wp_enqueue_script('progress-book-main-js', plugin_dir_url( __FILE__) . 'js/progress-book-main.js', $deps, $version, $in_footer); 
    wp_enqueue_style( 'progress-book-main-css', plugin_dir_url( __FILE__) . 'css/progress-book-main.css');
}


function progress_book_user_view(){
	return get_progress_by_user();
}

add_shortcode( 'progress-book', 'progress_book_user_view' );

function get_progress_by_user(){
		$html = '';
		if( have_rows('progress') ):
	 	// loop through the rows of data
		$html .= '<div id="your-progress" class="progress-row"><div class="progress-title">Name</div><div class="progress-title">Assignment</div><div class="progress-title">Score</div></div>';
	    while ( have_rows('progress') ) : the_row();
	    	if (current_user_can('admin') || get_current_user_id() === get_sub_field('student')){
		    	$stu_id = get_sub_field('student');
		    	$name =  get_userdata(get_sub_field('student'))->display_name;
		    	$safe_name =  sanitize_title(get_userdata(get_sub_field('student'))->display_name);
		    	$safe_assign = sanitize_title(get_sub_field('assignment'));
		        // display a sub field value
		        $html .= '<div class="progress-row ' . $safe_name . ' ' . $safe_assign .'">';
		        $html .= '<div class="progress-student" data-student="' . $safe_name . '">' . $name . '</div>';
		        $html .= '<div class="progress-assignment" data-assign="' . $safe_assign . '">' . get_sub_field('assignment') . '</div>';
		        $html .= '<div class="progress-grade">' . get_sub_field('grade') . '</div>';
		        $html .= '</div>';
		    }

	    endwhile;

	    return $html;

	else :

	    // no rows found

	endif;

}