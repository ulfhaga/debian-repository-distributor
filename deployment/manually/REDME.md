# INSTALLATION

## APACHE HTTP SERVER

1. Create a tar boll with the script build.sh.
2. Extract the tar boll in the Apache DocumentRoot. 
3. Run this script from the extraced tar ball.

    sudo bash repoCreate.sh;  
    sudo chmod -R 777  /var/local/apt/debtoox/pool ;
    ln -s /var/local/apt/debtoox <Apache DocumentRoot>/

3. Update Apache2 configuration file:


In file /etc/php/7.0/apache2/php.ini  
Add or update:

    file_uploads = On
    upload_max_filesize = 100M
    post_max_size = 100M

4. Read more at https://help.ubuntu.com/lts/serverguide/httpd.html

Don't forget to add this line in file /etc/apache2/ports.conf

    Listen 58763


