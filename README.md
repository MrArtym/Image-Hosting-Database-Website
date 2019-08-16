# Image-Hosting-Database-Website
An education package for teaching dynamic webpages: HTML, CSS, and PHP scripts calling MYSQL. The overall project is an image uploading website. The project works with XAMPP (or MAMP if you prefer) and is designed for Alberta grade 12 Computer Science.

---

**Purpose:** This project implements Server-Side Scripting 1 (<a href="https://education.alberta.ca/media/159479/cse_pos.pdf">Alberta Education Program of Studies: Computer Science</a>) in an authentic image uploading context.

---

**Educator Resources:** See the Educator Resources folder for examples, resources, and a possible assignment.

---

**Setup:**
To quickly set up this application, download <a href="https://www.apachefriends.org/download.html">XAMPP</a> for your appropriate operating system. Place the files in the newly installed XAMPP htdocs folder. Run XAMPP and Start both Apache and MYSQL. From this interface, run MYPHPADMIN from the MYSQL options. 

Concepts:
Client-Server Upload/Download interaction
Server-Database interaction
SQL binary file streams
Front End Web Design (HTML/CSS/JavaScript)

**Database Setup:**
We need to setup our SQL database to handle incoming images from the user. Open the phpMyAdmin page from XAMPP by clicking on the "Admin" button in the MySQL row.

Head over to the SQL tab and execute the following SQL command to create a new table with appropriate fields.

Step 1: Create a database with name "image_store"
Step 2: Add a table with title "images" from the GUI or with the SQL code below.
    id - integer, represents a unique ID of an image stored in our database; **PRIMARY KEY**
    timestamp - TIMESTAMP, the exact time when the row was inserted into our database;
    title - Length of 240, represents the title of our image;
    caption - TEXT, descriptive info about image;

    Run the following query on the "SQL" tab to create a table called "images" with the above value fields:

    CREATE TABLE `image_store`.`images` 
            ( `id` INT NOT NULL , 
            `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
            `title` VARCHAR(240) NOT NULL , `data` LONGBLOB NOT NULL , 
            `caption` TEXT NOT NULL , 
            PRIMARY KEY (`id`)) 
    ENGINE = InnoDB;

    Possible expansion idea:
        Add another table called "user" and link it with the images table. This allows us to store data on which user uploaded the image.

*User setup*
From the "image_store" database, click on "Privileges" and "Add user account".

Under Login information, create a user with the following information
    User name: image_uploader
    Host name: 127.0.0.1
    Password : x5OGtpC1fI8mTnnY #For local testing only

*Make sure to 'Grant all privileges on database "image_store"' by checking the box

OR, run the following SQL query to create the user:

CREATE USER 'image_uploader'@'127.0.0.1' IDENTIFIED VIA mysql_native_password USING '***';GRANT USAGE ON *.* TO 'image_uploader'@'127.0.0.1' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `image_store`.* TO 'image_uploader'@'127.0.0.1';


**IMPORTANT CONFIGURATIONS for PHP and MYSQL**
PHP doesn't like large file uploads, so we need to change the max file size we can upload.
Inside XAMPP, on the Apache row, click on "Config" and select "php.ini".
Hit Ctrl+F and search for "upload_max_filesize". This value will be set to something low (2M). changing the 2M to 64M allows us to upload large 64MB files.
upload_max_filesize=64M

Hit "Save".

Turns out MySQL also doesn't like large binary streams. Head over to phpMyAdmin and select the "variables" tab.
In the search bar, look for "max_allowed_packet". Change the default value to 65194304 
This is 65 MB, which is enought to beam our image into the table.

Restart XAMPP


Go to the Xampp folder and delete everything from /htdocs
