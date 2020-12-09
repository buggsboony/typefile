#!/bin/env php
<?php


# xdotool key list
#https://gitlab.com/cunidev/gestures/-/wikis/xdotool-list-of-key-codes

//created by boondevelop
//created_at 2020-08-01 10:46:17

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



$content = file_get_contents($pathfile);
$lines = explode("\n" , $content);

sleep($wait);
foreach($lines as $line)
{
    if( $line)
    {
        if(   startsWith($line,"[" ) && endsWith($line,"]")   ) 
        {
            //Direct command xdo tool
            $com = substr($line,1,strlen($line)-2);
           //echo "COMMAND:"; var_dump( $com );
            exec("xdotool ".$com);
        }else
        {
            //echo "TYPE: "; var_dump( $line);
            exec("xdotool type \"".$line."\"");
        }
        usleep( $wait_line );
    print($_YELL.  $line .$_DEF."\n");

    }
}//next line


?>