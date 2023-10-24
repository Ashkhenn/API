<?php
include('model/model.php');

$added = 0;
$result = [];

if (isset($_POST['action'])) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://randomuser.me/api/?results=5000",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    
    if ($response === false) {
        die('cURL error: ' . curl_error($curl));
    }

    $responseArr = json_decode($response, true);

    if ($responseArr === null) {
        die('JSON decoding error: ' . json_last_error_msg());
    }

    $user_list = [];
    $import = new Import();
    
    if (isset($responseArr["results"]) && is_array($responseArr["results"])) {
        foreach ($responseArr["results"] as $person) {
            $user_list[] = [
                "first" => $person["name"]["first"],
                "last" => $person["name"]["last"],
                "email" => $person["email"],
                "age" => $person["dob"]["age"]
            ];
            $added++;
            $import->importUser($person["name"]["first"], $person["name"]["last"], $person["email"], $person["dob"]["age"]);
        }
    }
    
    $result['status'] = 'success';
    curl_close($curl);
}

$count = $import->countRecords('users');
$ar = $added;


?>
