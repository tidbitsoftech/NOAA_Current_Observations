#!/bin/sh

# Script to pull hourly weather conditions.
# Run this as a cron job hourly @ 16 minutes past the hour.
#===================================================================

#Define the NOAA station to get
NOAA_STATION_ID="KDFW"

# Set the full URL to retrive the XML file
FILE_TO_GET="http://w1.weather.gov/xml/current_obs/$NOAA_STATION_ID.xml"

# Define where we want to save the downloaded file
OUTPUT_FILE="/path/to/file/$NOAA_STATION_ID.xml"

# User-agent - NOAA will not allow downloads with a user agent being specified.
USER_AGENT="Mozilla/5.0 (Windows NT 6.1; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0"

# Log File (not currently used)
# LOG_FILE="$OUTPUT_FILE.log"

##=============================================

curl --fail --silent --show-error --user-agent "$USER_AGENT" --output "$OUTPUT_FILE" "$FILE_TO_GET"
