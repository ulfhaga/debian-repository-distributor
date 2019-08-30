#!/bin/bash
#
# Create repository
#
# Example to add a repository to your PC.
# Each line has the following syntax:
#       deb|deb-src uri distribution [component1] [component2] [...]
# See https://wiki.debian.org/SourcesList
# echo "deb [trusted=yes] http://<hostname>:58763/debtoox stable main contrib non-free" > /etc/apt/sources.list.d/debtoox.list
#

set -e
declare -r REPO_FOLDER="debtoox"
declare -r REPO_VAR_FOLDER="/var/local/apt/${REPO_FOLDER}"
declare -r REPO_BIN_FOLDER="/usr/local/bin"
declare -r SCRIPT="debrepo"

# Save old repository
if [[ -d /tmp/"${REPO_FOLDER}" ]]; then
  rm -fr /tmp/"${REPO_FOLDER}"
fi

if [[ -d "${REPO_VAR_FOLDER}" ]]; then
  mv "${REPO_VAR_FOLDER}"  /tmp
fi

if [[ -e "${REPO_BIN_FOLDER}"/${SCRIPT} ]]; then
  rm -f "${REPO_BIN_FOLDER}"/${SCRIPT};
fi

# Create a standard Debian repository folders
mkdir -p "${REPO_VAR_FOLDER}"/dists/{stable,unstable}/{main,contrib,non-free,test}/{binary-amd64,binary-i386}
mkdir -p "${REPO_VAR_FOLDER}"/pool/{stable,unstable}/{main,contrib,non-free,test}/{{a..z},{0..9}}
chmod -R 755 "${REPO_BIN_FOLDER}"

# Create a script to scan Debian package in the pool folder.
cat > "${REPO_BIN_FOLDER}"/${SCRIPT} << EOF
#!/bin/bash
set -e
cd "${REPO_VAR_FOLDER}"
## stable
# amd64
dpkg-scanpackages -m pool/stable/main /dev/null | gzip -9 -c > dists/stable/main/binary-amd64/Packages.gz ;
dpkg-scanpackages -m pool/stable/contrib /dev/null | gzip -9 -c > dists/stable/contrib/binary-amd64/Packages.gz;
dpkg-scanpackages -m pool/stable/non-free /dev/null | gzip -9 -c > dists/stable/non-free/binary-amd64/Packages.gz;
dpkg-scanpackages -m pool/stable/test /dev/null | gzip -9 -c > dists/stable/test/binary-amd64/Packages.gz;

# i386
dpkg-scanpackages -m pool/stable/main /dev/null | gzip -9 -c > dists/stable/main/binary-i386/Packages.gz ;
dpkg-scanpackages -m pool/stable/contrib /dev/null | gzip -9 -c > dists/stable/contrib/binary-i386/Packages.gz;
dpkg-scanpackages -m pool/stable/non-free /dev/null | gzip -9 -c > dists/stable/non-free/binary-i386/Packages.gz;
dpkg-scanpackages -m pool/stable/test /dev/null | gzip -9 -c > dists/stable/test/binary-i386/Packages.gz;

## unstable
# amd64
dpkg-scanpackages -m pool/unstable/main /dev/null | gzip -9 -c > dists/unstable/main/binary-amd64/Packages.gz ;
dpkg-scanpackages -m pool/unstable/contrib /dev/null | gzip -9 -c > dists/unstable/contrib/binary-amd64/Packages.gz;
dpkg-scanpackages -m pool/unstable/non-free /dev/null | gzip -9 -c > dists/unstable/non-free/binary-amd64/Packages.gz;
dpkg-scanpackages -m pool/unstable/test /dev/null | gzip -9 -c > dists/unstable/test/binary-amd64/Packages.gz;
# i386
dpkg-scanpackages -m pool/unstable/main /dev/null | gzip -9 -c > dists/unstable/main/binary-i386/Packages.gz ;
dpkg-scanpackages -m pool/unstable/contrib /dev/null | gzip -9 -c > dists/unstable/contrib/binary-i386/Packages.gz;
dpkg-scanpackages -m pool/unstable/non-free /dev/null | gzip -9 -c > dists/unstable/non-free/binary-i386/Packages.gz;
dpkg-scanpackages -m pool/unstable/test /dev/null | gzip -9 -c > dists/unstable/test/binary-i386/Packages.gz;
EOF

chmod -R 755 "${REPO_BIN_FOLDER}"/${SCRIPT}







