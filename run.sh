#!/bin/bash

if [ -z "$1" ]; then
  echo "Please provide a number greater than 0 as an argument."
  exit 1
fi

docker build -t prime-multiplication-image .
docker run --rm prime-multiplication-image php ./console.php app:prime-multiplication-table $1
