#!/bin/bash -ex

SRC="./src"
TESTS="./tests"

./vendor/bin/parallel-lint $SRC
./vendor/bin/parallel-lint $TESTS

./vendor/bin/phpunit

#./vendor/bin/phpmd $SRC text cleancode,codesize,controversial,design,naming,unusedcode
./vendor/bin/phpmd $SRC text codesize,controversial,design,naming,unusedcode

./vendor/bin/phpcs --standard=PSR2 $SRC
