#!/bin/bash
set -e
declare -r FILE_CONTEXT=context
declare -r CDIR=`dirname $0`
cd $CDIR
../build-context.sh
docker build -t debian-repository:latest -f Dockerfile "../${FILE_CONTEXT}"
