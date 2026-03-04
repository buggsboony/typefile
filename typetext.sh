#!/bin/bash


#!/bin/bash

# Créer une boîte de dialogue pour saisir du texte
input=$(zenity --text-info --title="Input Box" --width=500 --height=350 --editable --ok-label="Type !" --cancel-label="Cancel" --title="Type the text")

# Vérifier le code de retour de zenity
if [ $? -eq 0 ]; then
    # Si l'utilisateur a cliqué sur "OK" (Submit)
    #echo "Submit: $input"
    echo "Submit";

    tmpfile=/tmp/zenity_text_to_type
    rm -f $tmpfile;
    # Demander une confirmation à l'utilisateur
    if zenity --question --text="Êtes-vous sûr de vouloir continuer ?" --width=300; then
        echo "$input" > "$tmpfile"
        typefile "$tmpfile";
        echo "Action effectuée."
        #rm -f $tmpfile;
    else
        echo "Action annulée."
    fi
else
    # Si l'utilisateur a cliqué sur "Cancel" ou a fermé la boîte
    echo "Cancel"
fi
