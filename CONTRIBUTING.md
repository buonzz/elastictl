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