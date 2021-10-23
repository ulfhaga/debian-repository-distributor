# Debian repository

Setting up a Debian repository in Docker container.
The Debain package can be upload by a Web page or by [cUrl](https://en.wikipedia.org/wiki/CURL) to the respository.

## Overview

A Debian package source format:

 `deb uri distribution [component1] [component2] [...]`

- uri:  specifies the root of the archive.
- distribution corresponds to Suite ( or Codename (not used) ). 
  
  Suite is either _stable_ or _unstable_.

- Components: _main_ _contrib_ _non-free_ _test_


## Requirements

Composer is a tool is used for dependency management in PHP.
Install with apt-get.

    sudo apt-get install composer;
    composer --version;

You need also to install docker (>=3.7) and docker-compose (>=1.24). That is not cover here. 

Verify:

    docker --version;
    docker-compose --version;

## Deploy and run with Docker

    composer docker-build

## Deploy and run with Docker

    composer docker-compose-up
    # or 
    composer docker-run

## Add repository on your PC from a Web page

In a brower open the url http://localhost:58763

## Upload a Debina package with cUrl

curl -X POST -H "Content-Type: multipart/form-data;" -F "suit=${suit}  -F "repotype=${components}" -F "package=@${file}" http://${repository_host}:58763/upload.php
`

${suit}: _stable_ or _unstable_

${components} one or many: _main_ _contrib_ _non-free_ _test_

${file}: The debian package to upload

${repository_host}: The docker conatiners IP och host name.



## Test or verify
Example to upload the file openjdk-7-jre_7u65-2.5.2-3~10.04.1_amd64.debto the repository:


### Start the repository with docker composeDeb

    composer docker-compose-up

### Get a Debian package

```bash
    cd ~;
    wget https://launchpad.net/~openjdk-r/+archive/ubuntu/ppa/+files/openjdk-7-jre_7u65-2.5.2-3~10.04.1_amd64.deb;
```


### Upload the package to the Debian repository

```bash
    file=openjdk-7-jre_7u65-2.5.2-3~10.04.1_amd64.deb;
    repository_host=localhost:58763;

   curl -X POST -H "Content-Type: multipart/form-data;" -F "suit=unstable"  -F "formatter=json"  -F "repotype=contrib" -F "package=@${file}" http://${repository_host}/upload.php 
```

## Add repository on your PC with curl


```bash
repository_host=repository_host=$(hostname):58763;
echo "deb [trusted=yes] http://${repository_host}/debtoox stable main contrib non-free" > /etc/apt/sources.list.d/debtoox.list
```

##  Install the package

    apt-get install openjdk-7-jre_7u65
