#!/bin/bash
# 2026-03-01 12:56:48 - New Console Colors
NC='\033[0m'
RED='\033[38;5;1m'
BRED='\033[1;31m'
GREEN='\033[0;32m'
BLUE='\033[38;5;4m'
YELL='\033[38;5;184m'
BYELL='\033[1;33m'
ORAN='\033[0;33m'
GRAY='\033[38;5;8m'


MAG='\033[0;35m'
BMAG='\033[1;35m'
VIOLET='\033[38;5;5m'
TURQUOISE='\033[38;5;37m'
VFLUO='\033[38;5;40m'
GOLD='\033[38;5;100m'
LGREEN='\033[38;5;6m'

BGREEN='\033[1;32m'

#install stuff
what=${PWD##*/}   
extension=.php
#peut être extension vide



#check installed package , is package installed ?

echo -e "${YELL}ydotool (supports both Wayland and X11) #check installed package , is package installed ? ${NC}\n"
sudo pacman -S ydotool

#pacman -Qi youtube-dl | grep -i version
if [ $(pacman -Qi ydotool | grep -i version | wc -l) == 1 ]; then 
echo "ydotool already installed OK"
else
 sudo pacman -S ydotool
fi



echo -e  "${YELL}Please install ydotool-rebind for AZERTY layout...${NC}\n"
echo "git clone https://github.com/david-vct/ydotool-rebind.git
cd ydotool-rebind
sudo ./install.sh
"


echo "Set executable..."
chmod +x $what$extension
#echo "lien symbolique vers usr bin"
sudo ln -s "$PWD/$what$extension" /usr/bin/$what
echo "done."
