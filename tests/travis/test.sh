#!/bin/sh
SCRIPT=$(readlink -f "$0")
SCRIPTPATH=`dirname "$SCRIPT"`

cd "$SCRIPTPATH/../.."

php public/index.php

exit 0
