<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Bad Request</title>
	<style type="text/css">
		/* styles.css */
		body {
			font-family: "Verdana";
			font-weight: normal;
			color: black;
			background-color: #f2f2f2;
			padding: 5px;
		}

		h1 {
			font-family: "Verdana";
			font-weight: normal;
			font-size: 18pt;
			color: gray;
			padding-bottom: 50px;
		}

		h2 {
			font-family: "Verdana";
			font-weight: normal;
			font-size: 14pt;
			color: maroon;
		}

		h3 {
			font-family: "Verdana";
			font-weight: bold;
			font-size: 11pt;
		}

		p {
			font-family: "Verdana";
			font-weight: normal;
			color: black;
			font-size: 9pt;
			margin-top: -5px;
		}

		p.info {
			padding-top: 50px;
		}

		.version {
			color: gray;
			font-size: 8pt;
			border-top: 2px solid #aaaaaa;
		}

		h2.error400 {
			font-family: 'Arial', sans-serif;
			font-size: 6em;
			color: gray;
			text-align: center;
			margin: 0;
			padding: 40px;
			border-radius: 10px;
			opacity: 0.5;
			animation: heartbeat 1s infinite;
		}

		@keyframes heartbeat {
			0% {
				transform: scale(1);
			}

			50% {
				transform: scale(1.1);
			}

			100% {
				transform: scale(1);
			}
		}
	</style>
</head>

<body>
	<h1>Bad Request</h1>
	<h2 class="error400"><?= esc('400') ?></h2>

	<p>
		The request could not be understood by the server due to malformed syntax.
		Please do not repeat the request without modifications.
	</p>
	<p>
		If you think this is a server error.
	</p>
	<div class="version">
		<?= date('Y-m-d H:i:s') ?>
	</div>
</body>

</html>