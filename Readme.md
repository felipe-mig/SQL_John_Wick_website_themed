

-No frameworks
-No AI code
-Local content

** The website is optimized for a 15.6" 1920 x 1080 display with a 16:9 aspect ratio.

You will need a local server and import the database to display the website** on your browser.

## How to run a local server

You can use MAMP or XAMPP:

https://www.mamp.info/en/windows/
https://www.apachefriends.org/

MAMP EXAMPLE (XAMPP works in the same way)

If you followed the default installation parameters, the directory to run the local server should be on this path: 

C:\MAMP

Steps to start the server:

1. Start the server by running the <strong>MAMP.exe</strong> file.

2. At the same directory level, look for the htdocs folder and remove it.

3. Replace the removed htdocs folder for the one on this project.

4. In your browser type the following URL: 

  127.0.0.1:80/phpMyAdmin5/

5. Go to home, look for the User accounts tab  on the top nav bar.

6. Click on Add user account and fill it with the following information: 

  User name: mri
  Host name: localhost
  Password: password

7. Below, look for the global privileges label and set it to Check all.

8. On the right side nav bar look for New, and create a database with the same name as the SQL file. 

  In this case: <i>johnwick.sql</i>

9. Once it is done, go to the recently created database. On the top nav bar look for the Import tab  
  

DATABASE CONNECTION

User: 
Password: password


LOGIN SECTION:

USER: admin
PASSWORD: admin


