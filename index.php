<?php 
//debug
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

// disable cache
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() - 3600));

define('PATH', dirname(__FILE__));
define('PATH_CONFIG', PATH.'/config');
define('PATH_SQL', PATH.'/sql');
define('PATH_VIEWS', PATH.'/views');

require_once PATH.'/api/api.php';
require_once 'controller.php';

$controller = new Controller();

if( isset($_GET['action']) ) {
	$action = $_GET['action'];
	if( $controller->authorize($action) ) {
		$controller->$action();
	} else {
		die('Akcja niedozwolona');
	}
}

?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<title>Strong Holds Resources</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="views/assets/jquery.tablesorter.min.js"></script>
		<style>
			td {vertical-align:middle !important}
			th {vertical-align:middle !important}
			th.header.headerSortUp {background:url('views/assets/asc.gif') right center no-repeat}
			th.header.headerSortDown {background:url('views/assets/desc.gif') right center no-repeat}
			th.header {background:url('views/assets/bg.gif') right center no-repeat;padding-right:20px !important}
		</style>
	</head>
	<body>
		<br/>
		<div class="container">
		<?php if( $controller->getConfig('clan_id')<1 ): ?>
			<?php require PATH_VIEWS.'/setup.php' ?>
		<?php else: ?>
			<?php require PATH_VIEWS.'/list.php' ?>
		<?php endif ?>
		</div>
	</body>
</html>
