#!/bin/bash

# Vérification du répertoire de travail
if [ "$PWD" != "/var/www/html" ]; then
  echo "Erreur : le répertoire de travail doit être /var/www/html"
  exit 1
fi

# Suppression des fichiers
rm -rf identification-main.tar.gz?path=Identification controllers/ index2.php static/ model/ test/ vendor/ views/ config2.php

# Téléchargement du fichier
wget https://gitlab.com/balabox/identification/-/archive/main/identification-main.tar.gz?path=Identification

# Extraction des fichiers
tar -xvzf identification-main.tar.gz\?path=Identification --strip-components=2

# Suppression du fichier tar.gz
rm -rf identification-main.tar.gz?path=Identification
