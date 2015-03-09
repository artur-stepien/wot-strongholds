<?php

namespace Wargaming\WoT {
	
	class Accounts {
		protected $application_id;
		protected $url;
		protected $language;
		
		/**
		 * Construct Wargaming WoT Players class
		 * 
		 * @param	String	$application_id	Wargaming application id
		 * @param	String	$url			Wargaming WoT API url (ex. "api.worldoftanks.eu/wot")
		 * @param	String	$language		Wargaming API Interface language
		 */
		public function __construct($application_id, $url, $language) {
			$this->application_id = $application_id;
			$this->url = $url;
			$this->language = $language;
		}
		
		/**
		 * Return get information about selected WoT players accounts
		 * https://eu.wargaming.net/developers/api_reference/wot/account/info/
		 * 
		 * @param	string	$account_id		Accounts ID's seperated by comas
		 * @param	string	$fields			List of response fields. Fields are separated by commas. Nested fields are separated by dots. If the parameter is not specified, all fields are returned. (https://eu.wargaming.net/developers/api_reference/wot/account/info/#response_block)
		 * @param	string	$access_token	Access token is used to access personal user data. The token is obtained via authentication and has expiration time.
		 * 
		 * @return	Array
		 */
		public function getInfo($account_id, $fields = null, $access_token = null) {
			$buff = file_get_contents(
				$this->url.'account/info/?'.
				'application_id='.$this->application_id.
				'&language='.$this->language.
				'&fields='.$fields.
				'&access_token='.$access_token.
				'&account_id='.$account_id
			);
			
			return json_decode($buff)->data;
		}
		
	}
	
}