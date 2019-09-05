#!/bin/bash
set -e
declare -r FILE_CONTEXT=context
declare CDIR=`dirname $0`
cd ${CDIR}

../build-context.sh
tar -cf ../../debian-repository.tar ../"${FILE_CONTEXT}" 2> /dev/null || printf "\nError creating tar.\n" 
printf "Tar ball for manually deployment in a Apache server create in file:\n";
(cd ../.. ;  ls $(pwd)/debian-repository.tar); 

