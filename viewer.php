<!-- Vivek Acharya (PHP Code) -->

<?php
    // Use sql to get image data
    $database_host = "127.0.0.1";
    $user_name = "image_uploader";
    $password = "x5OGtpC1fI8mTnnY";
    $database_name = "images";

    $id = $_GET["id"];
    $conn = new PDO("mysql:host=$database_host;dbname=$database_name", $user_name, $password);
    $stmt = $conn->prepare("SELECT * FROM images WHERE id=$id; LIMIT 1");
    $stmt->execute();
    $row = $stmt->fetch();
    // Retrieve data based on id
    echo $row["title"];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Static page
        </title>
        <!-- <link rel="stylesheet" href="./styles/main.css">
        <link rel="stylesheet" href="./styles/desktop.css"> -->
        <style>
           <?php 
                include './styles/main.css';
                include './styles/desktop.css';
           ?>
        </style>
        <script>
            //alert('This website will show the image');
            console.log('console running...')
        </script>
    </head>


    <body>
        <header>
            <div class="link-wrapper">
                <a href="upload.html">Upload img</a>
            </div>

            <div class="title-wrapper">
                <h1 style="color:gray"><?php 
                    echo (string)$row['title'];
                ?></h1>          
            </div>
        </header>

        <div class="divider">
            <div class="deco-line"></div>
            Image
            <div class="deco-line"></div>
        </div>

        <img src="<?php 
            echo "data:image/jpeg;base64,".base64_encode($row['data']);
        ?>">
        

        <div class="divider">
            <div class="deco-line"></div>
            Description
            <div class="deco-line"></div>
        </div>


        <div class="description">
            <h2><?php
                echo (string)$row["caption"];
            ?></h2>
        </div>


        <div class="newsletter-wrapper">
            <div class="divider">
                <div class="deco-line"></div>
                Coupons and Updates
                <div class="deco-line"></div>
            </div>
        
            <h3>
                Webpage build by Leon Zheng
            </h3>
        
            <form class="newsletter-form">
                <input type="text" placeholder="suggestions in here" />
                <input type="submit" value="sumbit" />
            </form>
        
            <div class="newsletter-thank-you hide">
                <h3>Thank you for subscribing!</h3>
            </div>
        
        </div>
       
        

        








    </body>
    <script>
        /* some Javascript in here in order to 
        hide the information before userinput the suggestion*/
        document.querySelector('.newsletter-wrapper form input[type="submit"]')
            .addEventListener('click', function (event) {

                document.querySelector('.newsletter-form').className = "hide";
                document.querySelector('.newsletter-thank-you').className = "newsletter-thank-you";

                var userEmail = document.querySelector('.newsletter-wrapper form input[type="text"]').value;

                document.querySelector('.newsletter-thank-you').innerHTML +=
                    'We will send updates to Leon about" ' + userEmail+' " ';
                //window.alert(userEmail);
                event.preventDefault();
            });

    </script>



</html> 


<!-- <div class="img-wrapper">
            <!-- <img src=" -->
            <!-- <?php 
                $name = "uploads/temp.jpeg";
                file_put_contents($name, $row["data"]);

                $fp = fopen($name, 'rb');
                // echo("NAME:".$name);
                header("Content-Type: image/jpeg");
                header("Content-Length: ". filesize($name));
                readfile($fp);
                // echo(fil3)
                exit;
            ?> -->
            <!-- "> -->
        </div> -->