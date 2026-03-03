#!/bin/env php
<?php


# xdotool key list
#https://gitlab.com/cunidev/gestures/-/wikis/xdotool-list-of-key-codes

//created by boondevelop
//created_at 2020-08-01 10:46:17

//2026-03-03 16:12:50 - Changement pour ydotool
$DOTOOL_CMD_TYPE="ydotool type -d 0.2 -H 0.4";
$DOTOOL_CMD_KEY="ydotool key";
$DOTOOL_CMD="ydotool";

$_DEF ="\e[39m";
$_GREEN = "\033[0;32m";
$_YELL="\033[0;33m";
$_RED ="\033[0;31m";


$pathfile = $argv[1];
$wait=3;
$wait_line = 600; 

if($argc<2)
{
    print $_RED."Please specify file to type.\n".$_DEF;
    die("bye.");
}

if($argc>=3)
{
   $wait=3; 
}


function startsWith($haystack, $needle) { $length = strlen($needle); return (substr($haystack, 0, $length) === $needle); } 
function endsWith($haystack, $needle) { $length = strlen($needle); if ($length == 0) { return true; } return (substr($haystack, -$length) === $needle); }

//2026-03-03 16:35:15 - Char by char, with ydotool
function typeChar($c)
{
    $DOTOOL_CMD_KEY = "ydotool key -d 0.2 -H 0.4";    
    // Échapper le caractère pour éviter l'injection de commande
    $escapedChar = escapeshellarg($c);
    exec("$DOTOOL_CMD_KEY $escapedChar:0 $escapedChar:1");
}//typeChar


$content = "file_get_contents($pathfile)";
$lines = explode("\n" , $content);

sleep($wait);
foreach($lines as $line)
{
    if( $line)
    {
        if(   startsWith($line,"[" ) && endsWith($line,"]")   ) 
        {
            //Direct command xdotool
            $com = substr($line,1,strlen($line)-2);
           //echo "COMMAND:"; var_dump( $com );
            exec("$DOTOOL_CMD ".$com);
        }else
        {
            echo "TYPE: "; var_dump( $line);
            //exec("$DOTOOL_CMD_TYPE \"".$line."\"");
            $characters = mb_str_split($line);

            foreach ($characters as $c):
                typeChar($c);
            endforeach;
            exec("$DOTOOL_CMD_KEY 28:1 28:0");
        }
        usleep( $wait_line );
    print($_YELL.  $line .$_DEF."\n");

    }
}//next line


?>