#!/bin/env php
<?php

//2026-03-03 22:07:11 - Déboggage : 
//sleep 3;sudo evtest   

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
    define("KEY_SHIFT_RIGHT",54);
    define("KEY_COLON", 52);
    define("KEY_LEFTALT",56);
    define("KEY_RIGHTALT",100);  //ALT_GR    
    define("KEY_1", 2);
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
    define("KEY_EQUAL", 13); // = et +
    define("KEY_E", 18); //e  
    define("KEY_O", 24); //o
    
    define("KEY_GRAVE", 41); //²    
    define("KEY_M", 50); //,
    define("KEY_COMMA", 51); //;
    define("KEY_SLASH", 53); 
    define("KEY_SPACE", 57); //SPACE
    define("KEY_APOSTROPHE", 40); //ù et %
    define("KEY_RIGHTBRACE", 27); //$
    define("KEY_BACKSLASH", 43); //* et µ
    define("KEY_102ND", 86); //< et >

    define("VK_TAB",15);
    define("VK_RETURN",28);           
  

    //2026-03-03 19:41:05 - Obtenir une séquence
function getCharSeq($c)
{
    $value = ord($c);
    $seq = "";
    if($c=="à")  {  $seq = getSeqOnOff(KEY_0);  }
    if($c=="&")  {  $seq = getSeqOnOff(KEY_1);  }
    if($c=="é")  {  $seq = getSeqOnOff(KEY_2);  }
    if($c=="²")  {  $seq = getSeqOnOff(KEY_GRAVE);  }
    
    if($c=="ç")  {  $seq = getSeqOnOff(KEY_9);  }
    if($c=="è")  {  $seq = getSeqOnOff(KEY_7);  }
    if($c=="-")  {  $seq = getSeqOnOff(KEY_6);  }
    if($c=="'")  {$seq = getSeqOnOff(KEY_4);   }    
    if($c==".")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_COMMA)." ".getSeqOff(KEY_SHIFT_LEFT);    }    
    if($c=="\"") {$seq = getSeqOnOff(KEY_3);   }
    if($c=="=")  {$seq = getSeqOnOff(KEY_EQUAL);   }
    
    if($c=="+")  {$seq = getSeqOn(KEY_SHIFT_RIGHT)." ".getSeqOnOff(KEY_EQUAL)." ".getSeqOff(KEY_SHIFT_RIGHT);}
    if($c=="ù")  {$seq = getSeqOnOff(KEY_APOSTROPHE);   }
    if($c=="<")  {$seq = getSeqOnOff(KEY_102ND);   }
    if($c==">")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_102ND)." ".getSeqOff(KEY_SHIFT_LEFT);    }    
     
    if($c=="%")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_APOSTROPHE)." ".getSeqOff(KEY_SHIFT_LEFT);    }    
    
    if($c=="*")  {$seq = getSeqOnOff(KEY_BACKSLASH);    }
    if($c=="µ")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_BACKSLASH)." ".getSeqOff(KEY_SHIFT_LEFT);        }

    if($c==":")  {$seq = getSeqOnOff(KEY_COLON);    }
    if($c==" ")  {$seq = getSeqOnOff(KEY_SPACE);    }
    if($c=="_")  {$seq = getSeqOnOff(KEY_8);    }
    if($c=="/")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_COLON)." ".getSeqOff(KEY_SHIFT_LEFT);        }
    if($c=="!")  {$seq = getSeqOnOff(KEY_SLASH);                                                      }
    if($c==";")  {$seq = getSeqOnOff(KEY_COMMA);                                                      }
    if($c==",")  {$seq = getSeqOnOff(KEY_M); }
    if($c=="?")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_M)." ".getSeqOff(KEY_SHIFT_LEFT);        }    
    if($c=="£")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_RIGHTBRACE)." ".getSeqOff(KEY_SHIFT_LEFT);        }        
    if($c=="§")  {$seq = getSeqOn(KEY_SHIFT_LEFT)." ".getSeqOnOff(KEY_SLASH)." ".getSeqOff(KEY_SHIFT_LEFT);        }    
    

    if($c=="ô")  {$seq = getCharSeq("^")." ".getSeqOnOff(KEY_O);   }

    if($c=="~") {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_2)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="#")  {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_3)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="(")  {$seq = getSeqOnOff(KEY_5);    }
    if($c=="{")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_4)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="[")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_5)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="|")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_6)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="`")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_7)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="\\")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_8)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="^")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_9)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c=="@")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_0)." ".getSeqOff(KEY_RIGHTALT);         }
    if($c==")")  {$seq = getSeqOnOff(KEY_MINUS);    }    
    if($c=="}")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_EQUAL)." ".getSeqOff(KEY_RIGHTALT);    }
    if($c=="]")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_MINUS)." ".getSeqOff(KEY_RIGHTALT);     }

    if($c=="€")   {$seq = getSeqOn(KEY_RIGHTALT)." ".getSeqOnOff(KEY_E)." ".getSeqOff(KEY_RIGHTALT);         }

    //2026-03-03 19:19:36 - Virtual keys
    if($c=="\n") {$seq = getSeqOnOff(VK_RETURN);}
    if($c=="\t") {$seq = getSeqOnOff(VK_TAB);}
    
    if( !$seq )
    {
        echo "Oups, char '$c' ord=$value not found in sequences \r\n";
    }
    return $seq;
}//getCharSeq




function typeChar($c) {
    $DOTOOL_CMD_KEY = "ydotool key";
    
    $seq = getCharSeq($c);
    echo("[".$DOTOOL_CMD_KEY." ".$seq."]\r\n");    
        // Taper le symbole
    exec($DOTOOL_CMD_KEY." ".$seq);
}




function typeString($str) {
    var_dump("type string disabled");
    $DOTOOL_CMD_TYPE = "ydotool type -d 0.2 -H 0.4";

    // Taper la chaîne
    exec("$DOTOOL_CMD_TYPE " . escapeshellarg($str));
}


function processContent($content) {
    $temp = '';
    $length = mb_strlen($content); // Utiliser mb_strlen pour gérer les caractères multibyte

    for ($i = 0; $i < $length; $i++) {
        $c = mb_substr($content, $i, 1); // Utiliser mb_substr pour gérer les caractères multibyte

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

    // Vérifier si la chaîne temporaire a encore des caractères à taper à la fin
    if ($temp !== '') {
        typeString($temp);
    }
}

// Exemple de contenu à traiter
 

$content = file_get_contents($pathfile);
sleep(3);
processContent($content);              

?>