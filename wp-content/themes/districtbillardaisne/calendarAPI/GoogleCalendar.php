<?php

use Core\User\User;
require_once __DIR__.'/composer/vendor/autoload.php';


class GoogleCalendar {
	private Google_Client $clientGoogle;
	private $instance;

	public static function getInstance(): GoogleCalendar{
		return $instance ??= new GoogleCalendar();
	}
	private function __construct() {

		$this->clientGoogle = $this->getClient();
	}


	public function getClient(): Google_Client {
		if($this->clientGoogle !== null){
			return $this->clientGoogle;
		}
		$client = new Google_Client();
		$client->setApplicationName('DABCalendar');
		$client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
		$client->setAuthConfig(__DIR__.'/credentials.json');
		$client->setAccessType('offline');
		$client->setPrompt('select_account consent');

		// Load previously authorized token from a file, if it exists.
		// The file token.json stores the user's access and refresh tokens, and is
		// created automatically when the authorization flow completes for the first
		// time.
		$tokenPath = __DIR__.'/token.json';
		if (file_exists($tokenPath)) {
			$accessToken = json_decode( file_get_contents( $tokenPath ), true, 512, JSON_THROW_ON_ERROR );
			$client->setAccessToken($accessToken);
		}

		// If there is no previous token or it's expired.
		if ($client->isAccessTokenExpired()) {
			// Refresh the token if possible, else fetch a new one.
			if ($client->getRefreshToken()) {
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
			} else {

				// Request authorization from the user.
				$authUrl = $client->createAuthUrl();
				printf("Open the following link in your browser:\n%s\n", $authUrl);
				print 'Enter verification code: ';
				//$authCode = trim(fgets(STDIN));

				// Exchange authorization code for an access token.
				$accessToken = $client->fetchAccessTokenWithAuthCode('4/0AX4XfWiFok51SX9L3MixuVAYrpaCVSMtoY4RA0eLjimZlo5A30nxAXYRLpZNYkJJP8rbvw');
				$client->setAccessToken($accessToken);

				// Check to see if there was an error.
				if (array_key_exists('error', $accessToken)) {
					throw new Exception(join(', ', $accessToken));
				}

			}

			// Save the token to a file.
			if (!file_exists(dirname($tokenPath))) {
				mkdir(dirname($tokenPath), 0700, true);
			}
			file_put_contents($tokenPath, json_encode($client->getAccessToken()));
		}

		$this->clientGoogle = $client;
		return $this->clientGoogle;
	}

	public static function getItems($optParams = null){
		$client = self::getInstance()->getClient();
		$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
		$calendarId = 'lmjiu2v56i8ohcvojj1q2cg3fk@group.calendar.google.com';
		$optParams ??= array(
			'maxResults' => 4,
			'orderBy' => 'startTime',
			'singleEvents' => true,
			'timeMin' => date('c'),
		);

		return $service->events->listEvents($calendarId, $optParams)->getItems();
	}

}