<?php
/*
Plugin Name: Auto Set Excerpt
Plugin URI: https://github.com/amberkayle/auto-set-excerpt
Description: Auto set the excerpt on save. Will contain the first 150 words of a post and exclude tags.
Version: 1.0
Author: Kayle
Author URI: amberkaylearmstrong.com
Author Email: amber.kayle.armstrong@gmail.com
License:

  Copyright 2012 (amberkaylearmstrong@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

class AutoSetExcerpt {
	
	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Auto Set Excerpt';
	
	const slug = 'auto-set-excerpt';
	
	const length = 150;
	 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
	
	    // Define constants used throughout the plugin
	    $this->init_plugin_constants();
		
		add_filter( 'wp_insert_post_data' , array( $this, 'set_post_excerpt' ) );
		add_filter( 'excerpt_length', array( $this, 'set_excerpt_length' ) );

	} // end constructor
	
	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/
	
	/**
	 *
	 */
	function set_post_excerpt( $data, $postarr = '' ) {
		if( isset( $data['post_content'] )  ){
			$content = $data['post_content'];
			$content_no_tags = strip_tags( $content );
			$excerpt = wp_trim_excerpt( $content_no_tags );
			
			$data['post_excerpt'] = $excerpt ;
		}
		
		return $data;
	} // end set_post_excerpt
	
	
	

	function set_excerpt_length( $length ) {
		return $this->length;
	}

	

 
	/*--------------------------------------------*
	 * Private Functions
	 *---------------------------------------------*/
   
	/**
	 * Initializes constants used for convenience throughout 
	 * the plugin.
	 */
	private function init_plugin_constants() {
		
		/* 
		 * Define this as the name of your plugin. This is what shows
		 * in the Widgets area of WordPress.
		 * 
		 * For example: WordPress Widget Boilerplate.
		 */
		if ( !defined( 'Auto Set Excerpt' ) ) {
		  define( 'Auto Set Excerpt', self::name );
		} // end if
		
		/* 
		 * this is the slug of your plugin used in initializing it with
		 * the WordPress API.
		 
		 * This should also be the
		 * directory in which your plugin resides. Use hyphens.
		 * 
		 * For example: wordpress-widget-boilerplate
		 */
		if ( !defined( 'auto-set-excerpt' ) ) {
		  define( 'auto-set-excerpt', self::slug );
		} // end if
	
	} // end init_plugin_constants
	

  
} // end class
// TODO: update the instantiation call of your plugin to the name given at the class definition
new AutoSetExcerpt();
?>