<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WeatherController extends Controller
{
    public function show()
	{

		$yandex_api_key = config('yandex.api.key');

		$ch = curl_init();

		$vars = [
			'lat' => 53.258,
			'lon' => 34.358,
			'lang' => 'ru_RU', 
			'limit' => 1,
			'hours' => 'false',
			'extra' => 'false'
		];

		$url = "https://api.weather.yandex.ru/v1/forecast?" . http_build_query($vars);

		$headers = [
    		'X-Yandex-API-Key: ' . $yandex_api_key
		];

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$server_output = curl_exec($ch);

		curl_close($ch);

		$weather = json_decode($server_output);

		$temp = 0;
		$pressure = 0;

		if (json_last_error() == JSON_ERROR_NONE) {
			if (!isset($weather->status)) {
				$temp = $weather->fact->temp;
				$pressure = $weather->fact->pressure_mm;
			}
		}

		return view('weather', compact('temp', 'pressure'));

	}
}
