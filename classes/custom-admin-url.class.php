<?php

class sx_custom_login_url{

	protected $RootFolder;
	protected $HtAccessFile;
	public $NewUrl;
	public $OldUrl;

	public function __construct(){
		$this->RootFolder = $_SERVER['DOCUMENT_ROOT'];
		$this->HtAccessFile = '/.htaccess';
		$this->NewUrl = 'login';
		$this->OldUrl = 'wp-login.php';
	}
	
	public function NewUrl($NewUrl = 'wp-login.php'){
		$this->NewUrl = $NewUrl;

		$searchfor = 'RewriteRule ^'.$this->NewUrl.'(.*) '.$this->OldUrl.'?%{QUERY_STRING}';

		// get the file contents, assuming the file to be readable (and exist)
		$contents = file_get_contents($this->RootFolder.$this->HtAccessFile);

		// escape special characters in the query
		$pattern = preg_quote($searchfor, '/');

		// finalise the regular expression, matching the whole line
		$pattern = "/^.*$pattern.*\$/m";

		// search, and store all matching occurences in $matches
		if (preg_match_all($pattern, $contents, $matches))
		{
		echo "Found matches:\n";
		echo implode("\n", $matches[0]);
		}
		else
		{
		echo "No matches found";
			// $myfile = fopen($this->RootFolder.$this->HtAccessFile, "a") or die("Unable to open file!");
			// fwrite($myfile, $searchfor);
			// fclose($myfile);

		}
	}

}