# NOAA Weather Current Observations

This is a simple PHP function that utilizes the NOAA Weather hourly observations
for the city of your choice and displays that information on your existing PHP website.

Here is a sample image:

![Sample Image](https://github.com/tidbitsoftech/NOAA_Current_Observations/raw/master/sample-image.PNG)

### To Setup

1. The NOAA XML file is downloaded using the *get_weather.sh* script.  It should be set up to run as a cron job to get the file
from NOAA at 15-17 minutes past each hour.  You will need to configure the NOAA stationID along with the location
you want the XML file to be saved on your server.
1. In the configurations file, *noaa-current.conf.php*, set `$noaa_xml_file` to the full path where the XML file is located.
1. In some cases the observed city provided in the feed is real long or may not be what you want
displayed. In this case, uncomment the `$obs_city` variable in the conf file, provide the name you want,
and then comment the `$obs_city` variable in the *noaa-current.php* file.

The HTML portion of the script can be used as is or can be completely rewritten to fit the design and flow of your website.

### License

Released under the 'Unlicense' license.