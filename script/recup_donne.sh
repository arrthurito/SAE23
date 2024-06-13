#!/bin/bash

#varibale creation/data collection
#donne=$(mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t AM107/by-room/B105/data -C 1)
donne=$(cat brouillon.json)
hum=$(echo "$donne" | jq '.[0].humidity')
lum=$(echo "$donne" | jq '.[0].illumination')
salle=$(echo "$donne" | jq '.[1].room' | tr -d \")
bat=$(echo "$donne" | jq '.[1].Building' | tr -d \")
appareil=$(echo "$donne" | jq '.[1].deviceName' | tr -d \")
Date=$(date +"%Y-%m-%d")
heure=$(date +"%T")

echo "$hum , $lum , $salle , $bat , $Date , $heure , $appareil"

/opt/lampp/bin/mysql -h"localhost" -u"sae23" -p"sae23" "sae23" -e"
INSERT INTO Mesures (Date,Horaires,Valeurs,NomCapteur) VALUES ('$Date','$heure','$hum','$appareil');"
#INSERT INTO Mesures (Date,Horaires,Valeurs,NomCapteur) VALUES ('$Date','$heure','$hum','$appareil');
