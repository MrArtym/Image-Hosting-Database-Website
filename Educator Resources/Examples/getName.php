<?php   
	/* This line checks if the page has been loaded with form data 
	 * This line could go anywhere on the page as long as it's above 
	 * where you need to use the data */
	if(isset($_POST['SubmitButton'])){ //check if form was submitted
		$input = $_POST['inputText']; //get input text; notice this identifier is the same as the name down in the form.
		echo "Hello ".$input;
	}    
?>

<html>
	<body>    
		<p>Please enter your name:</p>
		<!--This defines a form. You can add a whole bunch of different elements
			http://www.w3schools.com/html/html_forms.asp
			action - refers to where the form sends the data to on submit. 
			Since no location is specified, this page will reload.
			method - specifies how to send form data
			2 methods: get - append form data in URL (super public)
					   post- appends data into HTTP request 
			Both methods create an array of the values
			"inputText" is the key associated with name.
			Hence, in the above call, $_POST['inputText'], we can grab the entered name.-->
		<form action="" method="post">
		  <input type="text" name="inputText"/>
		  <input type="submit" name="SubmitButton"/>
		</form>    
	</body>
	
	<?php    
	if ($input!= null){
		echo "You can also print out with the equal sign. 
			  Notice I'm accessing the same variable from above here: " . $input ;
	}    
	?>
	
</html>