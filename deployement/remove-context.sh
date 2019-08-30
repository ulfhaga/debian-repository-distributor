#!/bin/bash
set -e
CDIR=`dirname $0`
cd ${CDIR}

declare -r FILE_CONTEXT=context
if [[ -d "${FILE_CONTEXT}" ]]; then
  rm -fr  "${FILE_CONTEXT}"
fi

