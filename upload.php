<!-- Vivek Acharya -->
<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if image file is a actual image or fake image.
if(isset($_POST["submit"]) && is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "There was an error uploading your file.";
    }
}

// Convert image to binary data
// $img = fopen($target_file, "rb");


// SQL STUFF:
$database_host = "127.0.0.1";
$user_name = "image_uploader";
$password = "x5OGtpC1fI8mTnnY";
$database_name = "images";

// Instructions :https://phpdelusions.net/pdo
try{
    $conn = new PDO("mysql:host=$database_host;dbname=$database_name", $user_name, $password); // Put this inside try block later..

    // $blob = base64_encode(file_get_contents($target_file));//fopen($target_file, "rb");
    $blob = fopen($target_file, "rb");
    $sql = "INSERT INTO images VALUES(NULL, NULL, :title, :data, 'CAPTION OF THE FIRST IMAGE');";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $title = basename($target_file);
    $statement = $conn->prepare($sql);
    $statement->bindParam(":title", $title);
    $statement->bindParam(":data", $blob, PDO::PARAM_LOB); // PARAM_LOB instructs PDO to map the data as a stream..

    $statement->execute();
    echo "New records created successfully!";

    $sql = "SELECT * FROM images;";
    $results = $conn->exec($sql);
    echo "ALL DONE!";
} catch (PDOException $e){
    echo "Error: ". $e->getMessage();
}
$conn = null;

//  References: https://www.w3schools.com/php7/php7_file_upload.asp
?>

