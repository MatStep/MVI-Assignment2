<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$name = $_POST["name"];
$difficulty = $_POST["diff"];
$time = $_POST["time"];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://ussouthcentral.services.azureml.net/workspaces/ace5b24262f340e7b5603a8891d4f4ce/services/daae0ec573474a9e91f790d97ad71c9f/execute?api-version=2.0&details=true",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n  \"Inputs\": {\n    \"input1\": {\n      \"ColumnNames\": [\n        \"Meno\",\n        \"Obtiaznost predmetu\",\n        \"Pocet hodin ucenia\",\n        \"Znamka\"\n      ],\n      \"Values\": [\n        [\n          \"$name\",\n          \"$difficulty\",\n          \"$time\",\n          \"value\"\n        ]\n      ]\n    }\n  },\n  \"GlobalParameters\": {}\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer CluzSBNiRBWbYtt1lmnG5m/sWEpI+09VS9PcuRAOeIUmNSMCL3yp2LcxdtjzyKjmwrPkGlCRXMsXxkV0v4nJDA==",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$data = json_decode($response, true);

	echo "\n";
	echo $data["Results"]["output1"]["value"]["Values"][0][7];
}