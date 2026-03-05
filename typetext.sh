#!/bin/bash

tmpfile_raw=/tmp/zenity_raw_output
tmpfile_final=/tmp/zenity_text_to_type

# 1. On écrit la sortie brute de zenity directement dans un fichier temporaire
# On utilise la redirection > au lieu de $(...) pour préserver EXACTEMENT les octets
zenity --text-info --title="Input Box" --width=500 --height=350 --editable \
       --ok-label="Type now !" --cancel-label="Cancel"  --title="Type the text" > "$tmpfile_raw"

exit_code=$?

if [ $exit_code -eq 0 ]; then
    echo "Submit!"

    # 2. On lit le fichier brut pour analyser le dernier octet
    # On récupère la taille du fichier
    file_size=$(wc -c < "$tmpfile_raw")

    has_newline=false

    if [ "$file_size" -gt 0 ]; then
        # On lit le tout dernier octet du fichier
        last_char=$(tail -c 1 "$tmpfile_raw")
        
        # On compare avec un vrai retour à la ligne
        if [ "$last_char" == $'\n' ]; then
            has_newline=true
            echo "CR DETECTED (Saut de ligne présent dans la saisie)"
        else
            echo "NO CR DETECTED (Pas de saut de ligne à la fin)"
        fi
    fi

    # 3. On crée le fichier final selon la détection
    if [ "$has_newline" = true ]; then
        # On garde le fichier tel quel (il a déjà le saut de ligne)
        cp "$tmpfile_raw" "$tmpfile_final"
    else
        # On s'assure qu'il n'y a aucun saut de ligne ajouté (copie brute)
        cp "$tmpfile_raw" "$tmpfile_final"
        # Note: Comme zenity ne rajoute pas de NL tout seul si on ne le tape pas, 
        # la copie brute suffit.
    fi

    # Exécution de votre commande
    if command -v typefile &> /dev/null; then
        typefile "$tmpfile_final"
    else
        echo "--- Contenu du fichier généré ---"
        cat "$tmpfile_final"
        echo "--- Fin ---"
    fi

    echo "Action effectuée."
    
    # Nettoyage
    rm -f "$tmpfile_raw"
    # rm -f "$tmpfile_final" # Décommentez si vous voulez supprimer le fichier final aussi

else
    echo "Cancel"
    rm -f "$tmpfile_raw"
fi