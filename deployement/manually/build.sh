#!/bin/bash
set -e
declare -r FILE_CONTEXT=context
declare CDIR=`dirname $0`
cd ${CDIR}

../build-context.sh
tar -cf debian-repository.tar ../"${FILE_CONTEXT}" 2> /dev/null || printf "\nError creating tar.\n" 
