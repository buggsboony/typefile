#!/bin/bash

#install stuff
what=${PWD##*/}   
extension=.php
#peut être extension vide



#check installed package , is paquage installed ?
#pacman -Qi youtube-dl | grep -i version
if [ $(pacman -Qi xdotool | grep -i version | wc -l) == 1 ]; then 
echo "xdotool already installed OK"
else
 sudo pacman -S xdotool
fi






echo "Set executable..."
chmod +x $what$extension
#echo "lien symbolique vers usr bin"
sudo ln -s "$PWD/$what$extension" /usr/bin/$what
echo "done."
