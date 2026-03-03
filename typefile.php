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
 
function getSeqOn($code)
{
    return "$code:1";
}
function getSeqOff($code)
{
    return "$code:0";
}
function getSeqOnOff($code)
{
    return getSeqOn($code)." ".getSeqOff($code);
}


    define("KEY_SHIFT_LEFT",42);
    define("KEY_COLON", 52);
    define("KEY_LEFTALT",56);
    define("KEY_RIGHTALT",100);  //ALT_GR    
    define("KEY_1", 1);
    define("KEY_2", 3);
    define("KEY_3", 4);  //#  
    define("KEY_4", 5);  //{
    define("KEY_5", 6);  //[
    define("KEY_6", 7);  //|
    define("KEY_7", 8); //`
    define("KEY_8", 9); //\
    define("KEY_9", 10); //^
    define("KEY_0", 11); //@   
    define("KEY_MINUS", 12); //]   

    define("KEY_SLASH", 53);
 
    
$content = "]!";
function getCharSeq($c)
{
    
    $seq = "";
    if($c==":")  {$seq = getSeqOnOff(KEY_COLON);                                                      }
    if($c=="/")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_COLON)." ".getSeqOff(KEY_SHIFT_LEFT);        }
    if($c=="!")  {$seq = getSeqOnOff(KEY_SLASH);                                                      }
    if($c=="§")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_SLASH)." ".getSeqOff(KEY_SHIFT_LEFT);        }
    
    if($c=="~") {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_2)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="#")  {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_3)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="{")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_4)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="[")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_5)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="|")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_6)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="`")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_7)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="\\")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_8)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="^")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_9)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="@")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_0)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="]")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_MINUS)." ".getSeqOff(KEY_RIGHTALT);     }
    
    if( !$seq )
    {
        echo "Oups, char '$c' not found in sequences \r\n";
    }
    return $seq;
}//getCharSeq




function typeChar($c) {
    $DOTOOL_CMD_KEY = "ydotool key";
    
    $seq = getCharSeq($c);
    echo("[".$DOTOOL_CMD_KEY." ".$seq."]\r\n");
    //echo "[TEST]";   
}




function typeString($str) {
    var_dump("type string disabled");
    // $DOTOOL_CMD_TYPE = "ydotool type -d 0.2 -H 0.4";

    // // Taper la chaîne
    // exec("$DOTOOL_CMD_TYPE " . escapeshellarg($str));
}

function processContent($content) {
    // Initialiser une chaîne temporaire pour collecter des caractères alphanumériques
    $temp = '';

    for ($i = 0; $i < strlen($content); $i++) {
        $c = $content[$i];
            //echo "[$c]"; 
        // Vérifier si le caractère est alphanumérique
        if (ctype_alnum($c) || $c === '_') {
            $temp .= $c; // Ajouter à la chaîne temporaire
        } else {
            // Si la chaîne temporaire n'est pas vide, taper la chaîne
            if ($temp !== '') {
                typeString($temp);
                $temp = ''; // Réinitialiser pour le prochain segment
            }
            // Traiter le caractère spécial individuellement
            typeChar($c);
        }
     }

    // // Vérifier si la chaîne temporaire a encore des caractères à taper à la fin
    // if ($temp !== '') {
    //     typeString($temp);
    // }
}

// Exemple de contenu à traiter
//$content = "#!/bin/bash";

processContent($content); 
 


// $content = file_get_contents($pathfile);
// $content="A";
// $lines = explode("\n" , $content);

// sleep($wait);
// foreach($lines as $line)
// {
//     if( $line)
//     {
//         if(   startsWith($line,"[" ) && endsWith($line,"]")   ) 
//         {
//             //Direct command xdotool
//             $com = substr($line,1,strlen($line)-2);
//            //echo "COMMAND:"; var_dump( $com );
//             exec("$DOTOOL_CMD ".$com);
//         }else
//         {
//             echo "TYPE: "; var_dump( $line);
//             //exec("$DOTOOL_CMD_TYPE \"".$line."\"");
//             $characters = mb_str_split($line);

//             foreach ($characters as $c):
//                 typeChar($c);
//             endforeach;
//             exec("$DOTOOL_CMD_KEY 28:1 28:0");
//         }
//         usleep( $wait_line );
//     print($_YELL.  $line .$_DEF."\n");

//     }
// }//next line


?>