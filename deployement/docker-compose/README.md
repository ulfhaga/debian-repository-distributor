# DOCKER COMPOSE

## Copy/Save the folder with all package to /tmp/pool and create a tar bool

docker cp -L  debian-repository:/var/www/html/debtoox/pool /tmp/pool ;
tar -cvf pool.tar  /tmp/pool; 

## Replace all packages from a saved operation

docker exec  debian-repository  /bin/bash  -c "rm -fr /var/www/html/debtoox/pool"
docker cp -L  /tmp/pool debian-repository:/var/www/html/debtoox/pool


