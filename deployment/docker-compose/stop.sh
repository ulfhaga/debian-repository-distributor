#!/bin/bash
set -e
declare CDIR=`dirname $0`
cd ${CDIR}
docker-compose stop
