#PHP file uploader

This project was created with the intentions of learning docker for LAMP development
and to get better with php


### Project:
 - Lamp stack
 - Docker
 - Custom routing with Apache
 - User can upload an image with a title and description
 - Create a pseudo-REST api for CRUD actions on photos

### To run the project:
 - Run the docker image at pburris/php-exp
 - Goto the url localhost/bootstrap.php to add the database and table to the MySQL db
 - Start adding/deleting/editing photo posts
 - You can also clone this repo, build the image and run it like so: 
 - `docker run -d -v /path/to/cloned/folder:/app -p 80:80 -p 3306:3306  pburris/php-exp`

