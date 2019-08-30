#!/bin/bash
declare CDIR=`dirname $0`
cd ${CDIR}
set +x
docker container stop debian-repository
docker image rm debian-repository
docker volume rm pool

