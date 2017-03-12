Elastictl
=========

Command Line Client for Managing ElasticSearch Indices.


## Requirements

* PHP 5.4 or later
* Memcached Server
* ElasticSearch


Features
--------

* Easily List all Indices
* Perform Global Search


## Usage

Show information about the cluster

```
elastictl cluster:info
```

List all indices
```
elastictl indices:list
```

Sort indices by size
```
bin/elastictl indices:list --sort_by=size
```

Sort indices by document count
```
bin/elastictl indices:list --sort_by=documents
```

Sort indices by document name
```
bin/elastictl indices:list --sort_by=name
```

Sort indices by health
```
bin/elastictl indices:list --sort_by=health
```

## Build Environment

You'll only need to do the following if you would like to build your own version of this (please read the LICENSE file) or contribute to the project.

Put up the server dependencies
```
docker-compose up -d
```

ssh to the container
```
docker-compose exec cli bash
```

execute the build command

```
cd /code
./build.sh
```

The compiled phar file should now be available in  /code/dist/elastictl.phar <br/>
You can then upload it to your web server and let the users download/install it by:

```
wget http://downloads.yourdomain.com/elastictl.phar
sudo mv elastictl.phar  /usr/local/bin/elastictl
chmod +x /usr/local/bin/elastictl
elastictl -V
```