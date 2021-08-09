<?php
/**
 * Income Pitbull - Quick UnZipper
 * Place this in the same directory of the zip file. Then go to the file in your browser, enter the file name in the textbox, and hit "Unzip".
 * For security reasons, this only is allowed to run inside it's own current directory...
 * It is recommended to delete this file After use..
 */
$curdir = dirname(__FILE__) . "/";
$status = "";

if ( isset($_POST['file']) )
{
	
	$path = $curdir;
	$file = basename($_POST['file']);
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	
	if ( (strpos($file, "/") !== false) || (strpos($file, "..") !== false) ) {
		$status = "<strong>Error:</strong> You must stay within this directory. Slashes and other chars are blocked for security reasons!";
	} elseif ( $ext !== "zip" ) {
		$status = "<strong>Error:</strong> The file extension must be a 'zip' file!";
	} else {
		
		$zip = new ZipArchive;
		$res = $zip->open($file);
		if ($res === TRUE) {
			$zip->extractTo($path);
			$zip->close();
			$status = "<strong>Success:</strong> '$file' extracted to '$path'.";
		} else {
			$status = "<strong>Error:</strong> Could not extract '$file'.";
		}
		
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>

<div style="border:1px solid black;width:600px; margin: 30px auto; padding:10px 5px 20px 5px; text-align:center;font-family:Arial, Verdana;">
	<h1 style="font-size:16px;font-weight:900;font-family: Arial, Verdana;text-decoration:underline;">Income Pitbull Quick Unzipper</h1>
	<?php
	if ( isset($status) && ! empty($status) ) {
		echo '<p align="center">' . $status . '</p>';
	}
	?>
	<form name="unzipform" action="" method="post">
		<label for="file">Filename:</label> 
		<input type="text" name="file" placeholder="filename.zip" style="padding-left:4px;" /> 
		<button>Unzip</button>
	</form>

</div>


</body>
</html>
