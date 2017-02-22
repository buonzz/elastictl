Elastictl
=========

Command Line Client for Managing ElasticSearch Indices.

Features
--------

* Easily List all Indices
* Perform Global Search



## Usage

Put up the server dependencies
```
docker-compose up -d
```

ssh to the container
```
docker-compose exec cli bash
```


## Build Environment


In order to build the phar file, you need to install the box command. To do so:
```
curl -LSs https://box-project.github.io/box2/installer.php | php
```

Make sure you turn off readonly setting of phar file in your php.ini. In PHP7:

```
sudo vi /etc/php/7.0/cli/php.ini
```
Find the *phar.readonly* settings and set it to *Off*


Now move the box.phar file to /usr/local/bin so it can be globally available in console.

```
sudo mv box.phar /usr/local/bin/box
sudo chmod 755 /usr/local/bin/box
```

You are now ready to build phar file!

```
box --version
```