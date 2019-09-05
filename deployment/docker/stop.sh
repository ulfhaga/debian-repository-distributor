#!/bin/bash
set -e
declare CDIR=`dirname $0`
cd ${CDIR}
docker stop debian-repository
