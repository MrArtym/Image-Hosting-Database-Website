<?php
define('DEBUG_MODE_ON', false);

function addIcon(){
	echo "<!-- Logo made at http://www.favicon.cc/ -->\n";
	echo "\t\t<link rel=\"shortcut icon\" href=\"spidermanlogo.ico\">\n";
}

function addLogo(){
	echo "\t<!-- Font and layout from logo taken from: http://www.templatesbox.com/free-logo-templates/download/049.htm -->\n";
	echo "\t\t\t\t<p><a href=\"index.php\"><img src=\"Logo.png\" alt=\"Corbett Artym\" /></a></p>\n";
}

function addMenu(){
	echo "<div class='button_row'>" . "\n";
		echo "\t\t\t\t<div class='button'>" . "\n";
			echo "\t\t\t\t\t<a href='Guestbook.php'><img src='Buttons/Guestbook.png' onmouseover=\"this.src='Buttons/Guestbook-mouseover.png'\" onmouseout=\"this.src='Buttons/Guestbook.png'\" alt='Guestbook'/></a>" . "\n";
		echo "\t\t\t\t</div>" . "\n";
		echo "\t\t\t\t<div class='button'>" . "\n";
			echo "\t\t\t\t\t<a href='Contact.php'><img src='Buttons/Contact.png' onmouseover=\"this.src='Buttons/Contact-mouseover.png'\" onmouseout=\"this.src='Buttons/Contact.png'\" alt='Contact'/></a>" . "\n";
		echo "\t\t\t\t</div>" . "\n";
		echo "\t\t\t\t<div class='button'>" . "\n";
			echo "\t\t\t\t\t<a href='PhotoGallery.php'><img src='Buttons/PhotoGallery.png' onmouseover=\"this.src='Buttons/PhotoGallery-mouseover.png'\" onmouseout=\"this.src='Buttons/PhotoGallery.png'\" alt='PhotoGallery'/></a>" . "\n";
		echo "\t\t\t\t</div>" . "\n";
	echo "\t\t\t</div>" . "\n";
	echo "\t\t\t<div class='button_row'>" . "\n";
		echo "\t\t\t\t<div class='button'>" . "\n";
			echo "\t\t\t\t\t<a href='About.php'><img src='Buttons/About.png' onmouseover=\"this.src='Buttons/About-mouseover.png'\" onmouseout=\"this.src='Buttons/About.png'\" alt='About'/></a>" . "\n";
		echo "\t\t\t\t</div>" . "\n";
		echo "\t\t\t\t<div class='button'>" . "\n";
			echo "\t\t\t\t\t<a href='Links.php'><img src='Buttons/Links.png' onmouseover=\"this.src='Buttons/Links-mouseover.png'\" onmouseout=\"this.src='Buttons/Links.png'\" alt='Links'/></a>" . "\n";
		echo "\t\t\t\t</div>" . "\n";
		echo "\t\t\t\t<div class='button'>" . "\n";
			echo "\t\t\t\t\t<a href='PangramDetector.php'><img src='Buttons/PangramDetector.png' onmouseover=\"this.src='Buttons/PangramDetector-mouseover.png'\" onmouseout=\"this.src='Buttons/PangramDetector.png'\" alt='Pangram Detector'/></a>" . "\n";
		echo "\t\t\t\t</div>" . "\n";
	echo "\t\t\t</div>" . "\n";	
}

function containsSemiColon ($string){
	for ($index = 0; $index < strlen($string);$index=$index+1){
		if ($string[$index]===";"){
			return true;
		}
	}
	return false;
}

function displayCaption(){
	$pipeline = openPipeline();
	$whichImg = "whichImg.txt";
	$filehandler = fopen($whichImg, 'r');
	$imgIndex = fread($filehandler, filesize($whichImg));
	fclose($filehandler);
	$query = mysql_query("SELECT img_id,img,caption FROM images order by img_id where permission='approve'");
	//Find the caption corresponding to the current picture
	while ($imgIndex >0){
		$row = mysql_fetch_array($query);
		$imgIndex = $imgIndex - 1;
	}
	echo "<p id=\"galleryCaption\">" . $row['caption'] . "</p>";
}

function openPipeline(){
	$pipeline = mysql_pconnect( 'localhost','cartym','gD+ghj74');

	$success = mysql_select_db( 'cartymdb', $pipeline);

	if ((!$success)&&(DEBUG_MODE_ON)){
		echo "<p class='err'>Sorry. No connection for the following reason:\n";
		echo "\tError number: " . mysql_errno() . "\n";
		echo "\tError string: " . mysql_error() . "\n</p>";
		exit;
	}
	
	return $pipeline;
}

function pangramSolver($string){
		
	$text = $string;

	$letters = array(
		0=> "a",
		1=> "b",
		2=> "c",
		3=> "d",
		4=> "e",
		5=> "f",
		6=> "g",
		7=> "h",
		8=> "i",
		9=> "j",
		10=> "k",
		11=> "l",
		12=> "m",
		13=> "n",
		14=> "o",
		15=> "p",
		16=> "q",
		17=> "r",
		18=> "s",
		19=> "t",
		20=> "u",
		21=> "v",
		22=> "w",
		23=> "x",
		24=> "y",
		25=> "z"
	);


	$occurrences  = array(
		"a" => 0,
		"b" => 0,
		"c" => 0,
		"d" => 0,
		"e" => 0,
		"f" => 0,
		"g" => 0,
		"h" => 0,
		"i" => 0,
		"j" => 0,
		"k" => 0,
		"l" => 0,
		"m" => 0,
		"n" => 0,
		"o" => 0,
		"p" => 0,
		"q" => 0,
		"r" => 0,
		"s" => 0,
		"t" => 0,
		"u" => 0,
		"v" => 0,
		"w" => 0,
		"x" => 0,
		"y" => 0,
		"z" => 0
	);

	//Parse text and see what letters are in string
	for ($index = 0; $index < strlen($text); $index = $index+1){
		for($alpha_index=0; $alpha_index < 26; $alpha_index = $alpha_index+1){
			if (strtolower($text[$index]) == $letters[$alpha_index]){
				$occurrences[$letters[$alpha_index]] = $occurrences[$letters[$alpha_index]]+1;
			}
		}
	}

	$distinct_occurrences = 0;
	$missing_letters = "";

	//calculate if text is a pangram contains all letters
	for ($index = 0; $index < 26; $index = $index+1){
		if ($occurrences[$letters[$index]] > 0){
			$distinct_occurrences = $distinct_occurrences+1;
		}
		if ($occurrences[$letters[$index]] == 0){
			if ($missing_letters != ""){
				$missing_letters = $missing_letters . ", ";
			}
			$missing_letters = $missing_letters . $letters[$index];
		}
	}
		
		echo "<p>The user entered the phrase \"$text\".</p>\n";
		
	if ($distinct_occurrences == 26){
		echo "<p>This phrase is a pangram.</p>\n";
	}
	else{
		echo "<p>This phrase is not a pangram and is missing letters: " . $missing_letters . ".</p>\n";
	}
}


?>