#!/usr/bin/env bash


if readlink /proc/$$/exe | grep -q "dash"; then
	echo "This script needs to be run with bash, not sh"
	exit
fi

if [[ "$EUID" -ne 0 ]]; then
	echo "Sorry, you need to run this as root"
	exit
fi

ln -sv /opt/teapanel/config/teapanel /etc/nginx/sites-enabled/teapanel
service nginx reload