<?php
require 'plugin-update-checker/plugin-update-checker.php';

$SxMultitoolUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/LennardKu/sx-multitool/',
	__FILE__,
	'sx-multitool'
);

$SxMultitoolUpdateChecker->SetBranch('main');
