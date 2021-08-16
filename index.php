<?php
$location = $cityOptions = "";

if (isset($_POST['location'])) {
    $location = $_POST['currentLocation'];
}
$queryString = http_build_query([
    'access_key' => '81b5a2d69dae786f8d1328a5aca065ba',
    'query' => $location,
]);

$ch = curl_init(sprintf('%s?%s', 'http://api.weatherstack.com/current', $queryString));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$json = curl_exec($ch);
curl_close($ch);

$api_result = json_decode($json, true);




$url = curl_init("https://countriesnow.space/api/v0.1/countries/capital");

curl_setopt($url, CURLOPT_RETURNTRANSFER, true);

$json = curl_exec($url);
curl_close($url);

$country_list = json_decode($json, true);
/* foreach($country_list['data'] AS $country){
    var_dump($country['name']);
} */

?>

<!DOCTYPE html>
<html>

<head>
    <title>Weather Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
    <script src="./script/index.js"></script>
</head>

<body>
    <h2>Weather Map</h2>
    <form method="post" action="index.php">
        <div class="form-group">
            <label for="location">Search Location</label>
            <select id="currentLocation" name="currentLocation">
                <?php
                foreach ($country_list['data'] as $country) {
                    $selected = "";
                    /* foreach($index['cities'] as $city){
                        $cityOptions .= '<option value = "' . $city . ', ' . $index['country'] . '">' .$city . "</option>";
                    }  */
                    if (($country['capital']  . ', '. $country['name']) == $_POST['currentLocation']) {
                        $selected = "selected";
                    }
                    $cityOptions .= "<option value= '" . $country['capital']  . ', '. $country['name'] . "'" . $selected . ">" . $country['capital']  . ', '. $country['name'] . "</option>";
                }
                echo $cityOptions;
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="location">Search</button>
    </form>

    <div id='weather'>
        <?php
        if (isset($_POST['location'])) {
            foreach($api_result['current']['weather_descriptions'] AS $desc){
                echo "<h3><span class='badge badge-info float-right'>{$desc}</span></h3>";
            }
            
            echo "<p>Temperature in $location at {$api_result['current']['observation_time']} is {$api_result['current']['temperature']}℃</p>", PHP_EOL;
            echo "<p>Wind Speed: {$api_result['current']['wind_speed']} kilometers/hour</p>";
            echo "<p>Humidity: {$api_result['current']['humidity']}%</p>";
        }

        ?>
    </div>
    <div id="map"></div>


    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgWuvbz5QvUGpA84bG_UoSuzWKHcRKSDo&callback=initMap&libraries=&v=weekly" async defer></script>

</body>

</html>