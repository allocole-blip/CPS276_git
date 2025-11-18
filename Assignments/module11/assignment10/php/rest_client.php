<?php

function getWeather() {

    if (empty($_POST['zip_code'])) {
        return [
            "<p>No zip code provided.</p>",
            ""];}

    $zip = $_POST['zip_code'];
    $url = "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code=$zip";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return [
            "<p>There was an error retrieving the records.</p>",
            "" ];}
    curl_close($ch);
    $data = json_decode($response, true);

    if (isset($data['error'])) {
        return [
            "<p>" . htmlspecialchars($data['error']) . "</p>",
            ""]; }

    //output
    $output = "";

    //city
    $city = $data['searched_city'];

    $output .= "<h2>{$city['name']}</h2>";
    $output .= "<p><strong>Temperature:</strong> {$city['temperature']}<br>";
    $output .="<br>";
    $output .= "<strong>Humidity:</strong> {$city['humidity']}</p>";

    $output .= "<p><strong>3 Day Forecast</strong></p>";
    $output .= "<ul>";
    foreach ($city['forecast'] as $day) {
        $output .= "<li>{$day['day']}: {$day['condition']}</li>";
    }
    $output .= "</ul>";

    //higher temp-
    $higher = $data['higher_temperatures'];

    if (!empty($higher)) {
        $output .= "<p><strong>Up to three cities where temperatures are higher than {$city['name']}</strong></p>";
         $output .= "<table class='table table-striped'>
                    <thead>
                        <tr><th>City Name</th><th>Temperature</th></tr>
                    </thead>
                    <tbody>";
        foreach ($higher as $cityItem) {
            $output .= "<tr><td>{$cityItem['name']}</td><td>{$cityItem['temperature']}</td></tr>";
        }
        $output .= "</tbody></table>";
    } else {
        $output .= "<p><strong>there are no cities with higher temperatures then {$city['name']}.</strong></p>";
    }

    //Lower temp
    $lower = $data['lower_temperatures'];
$output .= "<p><strong>Up to three cities where temperatures are lower than {$city['name']}</strong></p>";
    if (!empty($lower)) {
        $output .= "<table class='table table-striped'>
                    <thead>
                        <tr><th>City Name</th><th>Temperature</th></tr>
                    </thead>
                    <tbody>";
        foreach ($lower as $cityItem) {
            $output .= "<tr><td>{$cityItem['name']}</td><td>{$cityItem['temperature']}</td></tr>";
        }
        $output .= "</tbody></table>";
    } else {
        $output .= "<p><strong>there are no with lower temperatures than {$city['name']}.</strong></p>";
    }

    return ["", $output];
}
?>
