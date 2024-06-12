#!/bin/bash

# Variables
MQTT_HOST="mqtt.iut-blagnac.fr"
MQTT_PORT=1883
MQTT_TOPIC="AM107/by-room/B105/data"
DB_HOST="localhost"
DB_USER="sae23"
DB_PASS="sae23"
DB_NAME="sae23"

# Dossier pour stocker les données temporaires
TEMP_DIR="/tmp/mqtt_data"
mkdir -p "$TEMP_DIR"

# Fichier pour stocker les valeurs
DATA_FILE="$TEMP_DIR/data.log"

# Intervalle de temps (en secondes)
INTERVAL=600

# Fonction pour insérer les données dans la base de données
insert_data() {
    local date="$1"
    local time="$2"
    local avg_hum="$3"
    local min_hum="$4"
    local max_hum="$5"
    local avg_lum="$6"
    local min_lum="$7"
    local max_lum="$8"
    local device_name="$9"

    /opt/lampp/bin/mysql -h"$DB_HOST" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" << EOF
INSERT INTO Mesures (Date,Horaires,MoyenneHum,MinHum,MaxHum,MoyenneLum,MinLum,MaxLum,NomCapteur) VALUES ('$date','$time','$avg_hum','$min_hum','$max_hum','$avg_lum','$min_lum','$max_lum','$device_name')
EOF
}

# Boucle principale
while true; do
    echo "Collecting data..."
    start_time=$(date +%s)
    end_time=$((start_time + INTERVAL))

    while [ $(date +%s) -lt $end_time ]; do
        donne=$(mosquitto_sub -h $MQTT_HOST -p $MQTT_PORT -t $MQTT_TOPIC -C 1)
        hum=$(echo "$donne" | jq '.[0].humidity')
        lum=$(echo "$donne" | jq '.[0].illumination')
        appareil=$(echo "$donne" | jq -r '.[1].deviceName')

        echo "$hum,$lum" >> "$DATA_FILE"
    done

    # Calcul des statistiques
    avg_hum=$(awk -F',' '{sum+=$1} END {print sum/NR}' "$DATA_FILE")
    min_hum=$(awk -F',' 'NR == 1 || $1 < min {min = $1} END {print min}' "$DATA_FILE")
    max_hum=$(awk -F',' 'NR == 1 || $1 > max {max = $1} END {print max}' "$DATA_FILE")

    avg_lum=$(awk -F',' '{sum+=$2} END {print sum/NR}' "$DATA_FILE")
    min_lum=$(awk -F',' 'NR == 1 || $2 < min {min = $2} END {print min}' "$DATA_FILE")
    max_lum=$(awk -F',' 'NR == 1 || $2 > max {max = $2} END {print max}' "$DATA_FILE")

    date=$(date +"%D")
    time=$(date +"%T")

    # Insertion des données dans la base de données
    insert_data "$date" "$time" "$avg_hum" "$min_hum" "$max_hum" "$avg_lum" "$min_lum" "$max_lum" "$appareil"

    # Nettoyage du fichier de données pour la prochaine itération
    > "$DATA_FILE"

    # Attente jusqu'au prochain intervalle
    sleep $INTERVAL
done