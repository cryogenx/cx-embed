<?php
/*
Plugin Name: CX-embed
Plugin URI: http://gwelsted.com
Description: This plugin adds a shortcode to insert content of a page of specified ID into another page. Usage: [cx_insert page='<<PAGE ID>>']
Version: 0.5
Author: George Welsted
Author URI: http://gwelsted.com
License: GPL2
*/

/*
CX-Embed (Wordpress Plugin)
Copyright (C) 2012 George Welsted
Contact me at http://www.gwelsted.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Create a shortcode to insert content of a page of specified ID
 *
 * @param    array        attributes of shortcode
 * @return   string       $output        Content of page specified, if no page id specified output = null
 */


function cx_insertPage($atts, $content = null) {
	// Default output if no pageid given
	$output = NULL;
	// extract atts and assign to array
	extract(shortcode_atts(array(
	"page" => '' // default value could be placed here
	), $atts));
	// if a page id is specified, then run query
	if (!empty($page)) {
		$pageContent = new WP_query();
		$pageContent->query(array('page_id' => $page));
		while ($pageContent->have_posts()) : $pageContent->the_post();
		// assign the content to $output
			$output = get_the_content();
		endwhile;
	}
	return $output;
}
add_shortcode('cx_insert', 'cx_insertPage');

?>