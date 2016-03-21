<?php

config(['services' => [
	'mondo' => [
		'client_id' => env('MONDO_CLIENT_ID'),
		'client_secret' => env('MONDO_CLIENT_SECRET'),
		'redirect_uri' => env('MONDO_REDIRECT_URI')
	]
]]);
