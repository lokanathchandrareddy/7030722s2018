Project Name: ShowCase
Description: Image Gallery
Owner: Lokanath Chandra Reddy

Instructions for setting up/ run the project on local server

Step 1: Download and Install XAMPP on the system. XAMPP version should be similar to the php version on the system.
Step 2: Download the files and place the files(Showcase folder) on the htdocs folder under the XAMPP application files. (in mac it is /Application/XAMPP/htdocs/) or you can open the XAMPP application manager and then click on Open application folder and locate htdocs folder and place the Showcase folder. 
Step 3: Go to manage servers on the XAMPP application and click start all and wait untill all are running. 
Step 4: Once all are running, navigate to localhost/phpmyadmin on your browser. 
Step 5: Click on the Databases. Under create database, enter a new database name and click on create. ( in my case it is photo-gallery-new)
step 6: Once the database is created , click on the newly created database displayed below which will open up a new dialog.
Step 7: Click on Import tab and then click on choose file to Import. Select Showcase.sql file present in the files and then click on import. This will import all the sql tables on the database and also add initial data to the database.
Step 8: Find the Config.php file, under the folder Showcase/inc/. edit the file.
Step 9: Enter the database name created in phpmyadmin in DB_DATABASE ( in my case it is photo-gallery-new) and save the file. (For production servers, we have to change all the data here )
Step 10: If you have created another user ( other than the root) , we to change that in DB_SERVER_USERNAME and password and save the file.
Step 11: Once all these are done, navigate to, localhost/Showcase/ and Hola Website is ready to use. 

For navigating through the website please refer Showcase_User_Manual

For the presentation, please to the Showcase.pptx file

For the project report, please refer, Showcase_Project_Report

For references, please refer the project report or references.txt

To know more the about the files, refer file structure.txt



