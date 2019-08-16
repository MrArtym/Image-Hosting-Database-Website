<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<?php
			include 'Library.php';
			addIcon();
		?>
		<title>Corbett Artym</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
		<div class="home_menu"> 
			<?php 
				addMenu();
			?>
		</div>
		
		<div class="logo_container">
			<div class="logo">
			<?php 
				addLogo();
			?>
			</div>		
		</div>
		
		<div class="visit_count">
			<?php
				$pipeline = openPipeline();

					//Increase read access by one
					$increment_access = "insert into visits values(DEFAULT,DEFAULT)";
					mysql_query($increment_access);
					
					//Count total reads
					$countstring = "select count(*) from visits";
					$countresults = mysql_query($countstring);
					$row2 = mysql_fetch_array($countresults);
					$count = $row2[0];
					echo "The site has seen <b>$count</b> visitors.";
			?>
		</div>
	</body>
</html>