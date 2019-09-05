#!/bin/bash
set -e
declare CDIR=`dirname $0`
cd ${CDIR}
host_ip=$(hostname -I | cut -d" " -f1)
docker run --env DOCKERHOST="$(hostname)" -v pool:/var/www/html/debtoox/pool --rm -dit --name debian-repository -p 58763:80 debian-repository:latest
