#!/bin/bash
nice -n 19 ../../../vendor/bin/phpunit -c tests/phpunit.xml --colors $1 $2 $3 $4 $5 $6 $7 $8 $9
