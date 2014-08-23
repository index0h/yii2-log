#!/bin/bash

export DEBIAN_FRONTEND=noninteractive

shopt -s nullglob
files=(/vagrant/provision/exec-once/*)

if [[ ! -f '/.provision-stuff/exec-once-ran' && (${#files[@]} -gt 0) ]]; then
    echo 'Running files in files/exec-once'
    find "/vagrant/provision/exec-once" -maxdepth 1 -not -path '*/\.*' -type f \( ! -iname ".gitignore" \) -exec chmod +x '{}' \; -exec {} \;
    echo 'Finished running files in files/exec-once'
    echo 'To run again, delete file /.provision-stuff/exec-once-ran'
    touch /.provision-stuff/exec-once-ran
fi

echo 'Running files in files/exec-always'
find "/vagrant/provision/exec-always" -maxdepth 1 -not -path '*/\.*' -type f \( ! -iname ".gitignore" \) -exec chmod +x '{}' \; -exec {} \;
echo 'Finished running files in files/exec-always'
