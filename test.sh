#!/bin/bash -ex

SRC="./src"

./vendor/bin/parallel-lint $SRC

./vendor/bin/phpunit $SRC

./vendor/bin/phpmd $SRC text cleancode,codesize,controversial,design,naming,unusedcode

./vendor/bin/phpcs --standard=phpcs.xml $SRC
