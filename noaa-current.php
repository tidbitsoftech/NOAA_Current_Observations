<?php

	/*
	NOAA Weather Current Observations
	====================================

	NOAA updates the hourly observations at 15 minutes past each hour.  They
	suggests that the file be downloaded after this time and only once per hour.
	You will want the XML version of the file.  You can find
	the links to the XML files by starting here: https://w1.weather.gov/xml/current_obs/

	This script was written with the intention that the XML file is downloaded outside
	of this script. I would recommend setting up a cron job and use cURL to fetch the file.
	Included is a shell script that can be used as a template (get_wether.sh).
	This saves your server from having to fetch it each time your page is visited
	and helps reduce latency in your page loading.
	*/

	# Load the configuration file
	include_once ("noaa-current.conf.php");

	# Load the XML weather data
	if ( !$rss_content = file_get_contents($noaa_xml_file)) return;
	$xml = simplexml_load_string($rss_content);								# the New way


	$icon_url_base = link_to_https(clean_weather_html($xml->icon_url_base));
	$icon_url_name = basename( clean_weather_html($xml->icon_url_name) );	# using basename to insure that a directory struction isn't inadvertantly followed.
	$observation_time = clean_weather_html($xml->observation_time);
	$current_cond = clean_weather_html($xml->weather);
	$obs_city = clean_weather_html($xml->location);
	$temp_f = clean_weather_html($xml->temp_f);
	$windchill_string = clean_weather_html($xml->windchill_string);
	$windchill_f = clean_weather_html($xml->windchill_f);
	$heat_index_string = clean_weather_html($xml->heat_index_string);
	$heat_index_f = clean_weather_html($xml->heat_index_f);
	$dewpoint_f = clean_weather_html($xml->dewpoint_f);
	$relative_humidity = clean_weather_html($xml->relative_humidity);
	$wind_mph = clean_weather_html($xml->wind_mph);
	$wind_dir = clean_weather_html($xml->wind_dir);
	$wind_gust_mph = clean_weather_html($xml->wind_gust_mph);	# not always present in feed
	$credit = clean_weather_html($xml->credit);
	$credit_url = link_to_https(clean_weather_html($xml->credit_URL));

	function link_to_https($url){
		$new_url = str_ireplace("http://", "https://", $url);
		return $new_url;
	}

	function clean_weather_html($some_string) {
		return htmlentities(trim($some_string));
	}


	# Now that we have the data in variables,
	# the rest is just putting it on a page.

	#** Start HTML
	#===============
?>

<!-- Start NOAA Current Conditions -->
<table class="weather">
	<tr>
		<td colspan='2' align='center'><b>Current Conditions</b><br><?=$obs_city?><br>&nbsp;</td>
	</tr>
	<tr>
		<td style="background-image: url('<?=$icon_url_base . $icon_url_name?>'); background-repeat: no-repeat; background-size: 100% 100%;" height="75" width="72" align="right">&nbsp;</td>
		<td style="vertical-align: middle; text-align: center; font-size: 18px;">
			<b><i><?=$current_cond?></i></b><br>
			<b><?=number_format($temp_f)?>&deg;</b><br>
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			<br>
			<?php
				#======================================================
				# Check for either a heat index or a wind chill reading
				If ($heat_index_f) {
					echo "<b>Heat Index:</b> " . $heat_index_f . "&deg;<br>\n";
				} Else If ($windchill_f) {
					echo "<b>Wind Chill:</b> " . $windchill_f . "&deg;<br>\n";
				}

				echo "<b>Wind:</b>&nbsp;";
				if ($wind_mph) {
					echo "$wind_dir at $wind_mph mph<br>\n";
					If ($wind_gust_mph) {
						echo "<b>Gusting:</b> $wind_gust_mph mph<br>\n";
					}
				} Else {
					echo "Calm<br>\n";
				}
				#======================================================
			?>
			<b>Dew Point:</b> <?=$dewpoint_f?>&deg;<br>
			<b>Humidity:</b> <?=$relative_humidity?>%<br>
			<div style="text-align: center; font-size: x-small;">
				<?php	# Show the observation time as well as credit for where the data came from. ?>
				<br><?=$observation_time?><br>
				<a href="<?=$credit_url?>" target="_blank"><?=$credit?></a><br>
			</div>
		</td>
	</tr>
</table>
<!-- End NOAA Current Conditions -->
