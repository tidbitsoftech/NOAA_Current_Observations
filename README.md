# NOAA Weather Current Conditions

This is a simple PHP script that pulls in the NOAA Weather hourly observations
for the city of your choice so that the information can be displyed on your website.

Here is a sample image:

![Sample Image](image_URL)

### To Setup

This script is written with the intention that the XML file is downloaded from NOAA outside
of this script. I would recommend setting up a cron job and using cURL to fetch the file.
I have included a shell script that can be used as a temple (get_wether.sh), or you can write you own.

1. In the configurations file, *noaa-current.conf.php*, set `$xml_file_location` to the directory
the XML file is located.
2. Set `$obs_station` to the four-letter station ID of the NOAA weather
station serving your area.
3. In some cases the observed city provided in the feed is real long or isn't what you want
displayed. In this case, uncomment the `$obs_city` variable in the conf file, provide the name you want,
and then comment the `$obs_city` variable in the *noaa-current.php* file.

The HTML portion of the script can be used as is or can be completely rewritten to fit the design and flow of your website.

### License

Released under the 'Unlicense' license.