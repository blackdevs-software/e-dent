#!/bin/bash

set -ex

echo "${APP_IP:=127.0.0.1} ${APP_DOMAIN:=edent.local} www.${APP_DOMAIN:=edent.local}" >> /etc/hosts

httpd-foreground
