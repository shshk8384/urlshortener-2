urlshortener
============

A simple URL shortener using PHP and MySQL.

Requirements
--------------

- Apache
- PHP
- MySQL

Setup
--------------

Copy all files to a new folder in your web server. Everything must be in a new folder, because the .htaccess file affects everything in its folder. Once you have copied everything you have to create a database and a table in MySQL. In MySQL follow the next steps:

    CREATE DATABASE shortener;
    CREATE USER 'shortener'@'localhost' IDENTIFIED BY '5h0rt3n3r';
    GRANT ALL PRIVILEGES ON shortener . * TO 'shortener'@'localhost';
    USE shortener;
    CREATE TABLE url (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, code VARCHAR(256), url VARCHAR(3000));

Now everything in the web must work. Only one more thing is needed. You have to enable mod_rewrite in Apache if you want the web to understand URL like http://domain/urlshortener/a12dad. To enable mod_rewrite in Linux you have to write the next command in a shell:

    sudo a2enmod rewrite
    sudo service apache2 restart

And that's all.

Files
--------------

- **.htaccess**: file to rewrite any string after the slash in the URL as index.php?url="string" with mod_rewrite.
- **index.php**: main html file.

Inside api folder:

- **api.php**: PHP script to allow external clients (as mobile apps) to use this shortener.

Inside scripts folder:

- **redirect.php**: takes the user to the desired URL.
- **shorten.php**: adds a new URL to the database and returns the shortened URL to the user.
- **shortened.php**: shows the shortened URL in a web page.

Inside style folder:

- **style.css**: stylesheet for all the web page.

Android client
--------------

You have an Android client in other repository: https://github.com/susomena/URL-Shortener-Android-Client
