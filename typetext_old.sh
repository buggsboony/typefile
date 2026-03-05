#!/bin/bash


#!/bin/bash

# Créer une boîte de dialogue pour saisir du texte
input=$(zenity --text-info --title="Input Box" --width=500 --height=350 --editable --ok-label="Type now !" --cancel-label="Cancel" --title="Type the text")

# Vérifier le code de retour de zenity
if [ $? -eq 0 ]; then
    # Si l'utilisateur a cliqué sur "OK" (Submit)
    #echo "Submit: $input"
    echo "Submit!";

    tmpfile=/tmp/zenity_text_to_type
    rm -f $tmpfile;
    # Demander une confirmation à l'utilisateur
    #Remove last unwanted NL (With sed)
    #echo "$input"|sed 's/[[:cntrl:]]*$//' > "$tmpfile" #No changes
    #Remove last unwanted NL (with awk)    
    #echo "$input" | awk 'NF' > "$tmpfile" #Not working
    
    #2026-03-04 19:23:45 - Enlever le dernier caractère (retour à la ligne)
    #trimmed_input="${input%$'\n'}"  #Not working
    #echo "$trimmed_input" > "$tmpfile"
    #echo -n "$input" > "$tmpfile"  #This does the trick

    # Détecter si le dernier caractère est un retour à la ligne
    if [[ "${input}" == *$'\n' ]]; then
        echo "CR DETECTED";
        echo "$input" > "$tmpfile"  # Créer le fichier avec le retour à la ligne        
    else
        echo "NO CR DETECTED";
        echo -n "$input" > "$tmpfile"  # Créer le fichier sans retour à la ligne
    fi
    
    typefile "$tmpfile";

    echo "Action effectuée."
    
    #rm -f $tmpfile;
else
    # Si l'utilisateur a cliqué sur "Cancel" ou a fermé la boîte
    echo "Cancel"
fi
