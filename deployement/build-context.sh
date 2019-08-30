#!/bin/bash
set -e

CDIR=`dirname $0`
cd $CDIR

declare -r FILE_CONTEXT=context
if [[ -d "${FILE_CONTEXT}" ]]; then
  rm -fr  "${FILE_CONTEXT}"
fi

mkdir -p "${FILE_CONTEXT}"

cp ../src/*  "${FILE_CONTEXT}"
cp ../bin/*  "${FILE_CONTEXT}"
cp ../public/*  "${FILE_CONTEXT}"

