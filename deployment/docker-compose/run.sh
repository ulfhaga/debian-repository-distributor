#!/bin/bash
set -e
declare -r CDIR=`dirname $0`
cd $CDIR
# export host=$(hostname)
../build-context.sh
export host=$(hostname -I | cut -d" " -f1)
docker-compose up -d --build



