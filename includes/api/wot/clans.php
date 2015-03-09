<?php

namespace Wargaming\WoT {
	
	class Clans {
		protected $application_id;
		protected $url;
		protected $language;
		
		/**
		 * Construct Wargaming WoT Clan class
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
		 * Return information about selected WoT Clans
		 * https://eu.wargaming.net/developers/api_reference/wot/clan/info/
		 * 
		 * @param	string	$clan_id		Clans ID's seperated by comas
		 * @param	string	$fields			List of response fields. Fields are separated by commas. Nested fields are separated by dots. If the parameter is not specified, all fields are returned. (https://eu.wargaming.net/developers/api_reference/wot/clan/info/#response_block)
		 * @param	string	$access_token	Access token is used to access personal user data. The token is obtained via authentication and has expiration time.
		 * 
		 * @return	Array
		 */
		public function getInfo($clan_id, $fields = null, $access_token = null) {
			$buff = file_get_contents(
				$this->url.'clan/info/?'.
				'application_id='.$this->application_id.
				'&language='.$this->language.
				'&fields='.$fields.
				'&access_token='.$access_token.
				'&clan_id='.$clan_id
			);
			
			return json_decode($buff)->data;
		}
		
		/**
		 * Return list of clans with selected characters in name or tag
		 * https://eu.wargaming.net/developers/api_reference/wot/clan/list/
		 * 
		 * @param	string	$search		Requested character in name of abbreviation
		 * @param	string	$limit		Number of returned entries. Maximum value: 100. If value is invalid or exceeds 100, then 100 entries are returned by default.
		 * @param	string	$order_by	Sorting. Valid values: name, members_count, created_at, abbreviation
		 * @param	string	$page_no	Result page number
		 * 
		 * @return	Array
		 */
		public function getList($search, $fields = null, $limit = 100, $order_by = 'abbreviation', $page_no = 1) {
			$buff = file_get_contents(
				$this->url.'clan/list/?'.
				'application_id='.$this->application_id.
				'&language='.$this->language.
				'&search='.$search.
				'&fields='.$fields.
				'&limit='.$limit.
				'&order_by='.$order_by.
				'&page_no='.$page_no
			);
			
			return json_decode($buff)->data;
		}
		
	}
	
}