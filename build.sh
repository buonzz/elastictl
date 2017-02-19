#! /bin/bash

if [ -f 'dist/*.phar' ];
then
   rm dist/*.phar
fi

box build
echo 'build complete!'