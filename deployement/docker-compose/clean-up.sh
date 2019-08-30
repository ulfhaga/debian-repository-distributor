#!/bin/bash
set -e
declare CDIR=`dirname $0`
cd ${CDIR}
printf "Stop and remove containers and volumes about 4 seconds. Press Ctrl+c to stop.\n"
printf "4\n"
sleep 2;
printf "2\n"
sleep 1
printf "1\n"
set +e
docker-compose down --volumes
../remove-context.sh
set -e
