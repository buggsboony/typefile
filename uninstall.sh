#!/bin/bash

#install stuff
what=${PWD##*/}   
extension=.php
what2=typetext
extension2=.sh
#peut être extension vide 
 
echo "killing running instances"
killall $what

echo "remove symbolic link from usr bin"
sudo rm /usr/bin/$what
sudo rm /usr/bin/$what2

echo "done."

