<?php
/*
Plugin Name: Further Reading
Description: Display related content for further reading in most common ways to lower bounce rate of your site
Version: 4.3.???
Author: Victor Glushenkov
Author URI: http://artplastika.ru/en/
License: MIT

Copyright 2014 Victor Glushenkov (email: dev@artplastika.ru )

Permission is hereby granted, free of charge, to any person obtaining a 
copy of this software and associated documentation files (the 
"Software"), to deal in the Software without restriction, including 
without limitation the rights to use, copy, modify, merge, publish, 
distribute, sublicense, and/or sell copies of the Software, and to 
permit persons to whom the Software is furnished to do so, subject to 
the following conditions: 

The above copyright notice and this permission notice shall be included 
in all copies or substantial portions of the Software. 

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS 
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 

*/
class wpfurtherreading {

	private static $BEHAVIOURS = array(
		"slidebox-specified" => "Slide box with specified post",
		"slidebox-custom" => "Slide box with custom HTML content",
		"slidebox-similar" => "Slide box with similar post (in development)",
		"slidebox-prevnext" => "Slide boxes with previous and next posts (in development)",
		"links-prevnext" => "Links to previous and next posts (in development)",
		"list-specified" => "List of specified posts at the end  (in development)",
		"list-similar" => "List of similar posts at the end  (in development)",
		"widget-similar" => "Widget with similar posts (in development)",	
		"nothing" => "Do nothing",
	);
	
	private static $SUPPORTED_BEHAVIOURS = array("slidebox-specified", "slidebox-custom", "nothing");

	function wpfurtherreading() {
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		add_filter('the_content', array(&$this, 'add_further_reading_navigation'));
		add_action('admin_init', array($this, 'plugin_admin_init'));
		add_action('admin_menu', array(&$this, 'add_admin_menu'));
	}
	
	public function enqueue_scripts() {
		wp_enqueue_script(
			'further-reading',
			plugins_url('wp-further-reading.js', __FILE__),
			array('jquery')
		);
	}
	
	public function add_further_reading_navigation($content = '') {
		return $content;
	} 
	
	public function plugin_admin_init() {
		register_setting('wp_further_reading_options', 'wp_further_reading_options');
	}
	
	public function add_admin_menu() {
		add_options_page('Further Reading', 'Further Reading', 'manage_options', basename(__FILE__), array($this, 'add_plugin_options_page'));
	}
	
	public function add_plugin_options_page() {
		$options = get_option('wp_further_reading_options');
		?>
		<div class="wrap">
			<h2>Further Reading Options</h2>
			<form id="further-reading-options-form" method="post" action="options.php">
				<?php settings_fields('wp_further_reading_options'); ?>
				<label for="further-reading-options-form">Default behaviour:</label>
				<select name="wp_further_reading_options[behaviour]">
				<?php foreach (self::$BEHAVIOURS as $key => $value) { ?>
						<option value="<?php echo $key?>" <?php if (!in_array($key, self::$SUPPORTED_BEHAVIOURS)) echo 'disabled'; if ($key == $options['behaviour']) echo 'selected'; ?>><?php echo $value?></option>
				<?php } ?>
				</select>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php 
	}
}

$wpfurtherreading = new wpfurtherreading();	