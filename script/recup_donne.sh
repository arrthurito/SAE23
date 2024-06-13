#!/bin/bash

#varibale creation/data collection
donne=$(mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t AM107/by-room/$1/data -C 1)
hum=$(echo "$donne" | jq '.[0].humidity')
lum=$(echo "$donne" | jq '.[0].illumination')
appareil=$(echo "$donne" | jq '.[1].deviceName' | tr -d \")
Date=$(date +"%Y-%m-%d")
heure=$(date +"%T")

echo "$hum , $lum , $salle , $bat , $Date , $heure , $appareil"

#data are send to the database
/opt/lampp/bin/mysql -h"localhost" -u"sae23" -p"sae23" "sae23" -e"
INSERT INTO Mesures (Date,Horaires,Valeurs,NomCapteur) VALUES ('$Date','$heure','$lum','$appareil\lum');
INSERT INTO Mesures (Date,Horaires,Valeurs,NomCapteur) VALUES ('$Date','$heure','$hum','$appareil\hum');"
#INSERT INTO Mesures (Date,Horaires,Valeurs,NomCapteur) VALUES ('$Date','$heure','$hum','$appareil');
