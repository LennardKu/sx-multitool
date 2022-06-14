<?php

add_action( 'init', 'github_plugin_updater_test_init' );
function github_plugin_updater_test_init() {

	define( 'WP_GITHUB_FORCE_UPDATE', true );
	global $sx_plugin_name;
	
		/*
		*   Update getter
		*/
		if (is_admin()) {   
			$config = array(
				'slug' => plugin_basename(__FILE__),
				'proper_folder_name' => $sx_plugin_name, 
				'api_url' => 'https://api.github.com/repos/LennardKu/sx-multitool', // the GitHub API url of your GitHub repo
				'raw_url' => 'https://raw.github.com/LennardKu/sx-multitool/master', // the GitHub raw url of your GitHub repo
				'github_url' => 'https://github.com/LennardKu/sx-multitool', // the GitHub url of your GitHub repo
				'zip_url' => 'https://github.com/LennardKu/sx-multitool/zipball/master', // the zip url of the GitHub repo
				'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
				'requires' => '1.4', // which version of WordPress does your plugin require?
				'tested' => '1.4', // which version of WordPress is your plugin tested up to?
				'readme' => 'README.md', // which file to use as the readme for the version number
				'access_token' => '', // Access private repositories by authorizing under Plugins > GitHub Updates when this example plugin is installed
			);
			new WP_GitHub_Updater($config);
		}

}

