<?php

namespace Wargaming\WoT {
	
	class ClanRatings {
		protected $application_id;
		protected $url;
		protected $language;
		
		/**
		 * Construct Wargaming WoT Clan Ratings class
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
		 * Get Wargaming WoT clans ratings types list
		 * https://eu.wargaming.net/developers/api_reference/wot/clanratings/types/
		 * 
		 * @param	array $fields	List of fields to return (https://eu.wargaming.net/developers/api_reference/wot/clanratings/types/#response_block)
		 * 
		 * @return	array
		 */
		public function getTypes($fields = ClanRatings\Types\Fields) {
			$buff = file_get_contents(
				$this->url.'clanratings/types/?'.
				'application_id='.$this->application_id.
				'&language='.$this->language.
				'&fields='.$fields
			);
		
			return json_decode($buff)->data;
		}
		
		/**
		 * Get Wargaming WoT clan ratings dates list with available ratings
		 * https://eu.wargaming.net/developers/api_reference/wot/clanratings/dates/
		 * 
		 * @param	string	$clan_id	Clan id
		 * @param	string	$fields		List of fields to return (https://eu.wargaming.net/developers/api_reference/wot/clanratings/dates/#response_block)
		 * @param	string	$type		Date type
		 * 
		 * @return array
		 */
		public function getDates($clan_id, $fields = '', $type = ClanRatings\Dates\Types\All) {
			$buff = file_get_contents(
				$this->url.'clanratings/dates/?'.
				'application_id='.$this->application_id.
				'&language='.$this->language.
				'&fields='.$fields.
				'&type='.$type.
				'&clan_id='.$clan_id
			);
		
			return json_decode($buff)->data;
		}
		
		/**
		 * Return list of Top WoT clans
		 * https://eu.wargaming.net/developers/api_reference/wot/clanratings/top/
		 * 
		 * @param	string	$rank_field	Type of ranking (list of available values in Wargaming\WoT\ClanRatings\getTypes())
		 * @param	string	$limit		Number of clans to return (maximum 1000)
		 * @param	string	$date		Ratings calculation date. Up to 7 days before the current date; default value: yesterday. Date in UNIX timestamp or ISO 8601 format. E.g.: 1376542800 or 2013-08-15T00:00:00
		 * @param	string	$fields		List of fields to return (https://eu.wargaming.net/developers/api_reference/wot/clanratings/top/#response_block)
		 * @param	string	$type		Date type
		 * 
		 * @return	Array
		 */
		public function getTopClans($rank_field, $limit = 1000, $fields = '', $date = null, $type = ClanRatings\TopClans\Types\All) {
			$buff = file_get_contents(
				$this->url.'clanratings/top/?'.
				'application_id='.$this->application_id.
				'&language='.$this->language.
				'&fields='.$fields.
				'&type='.$type.
				'&date='.$date.
				'&rank_field='.$rank_field.
				'&limit='.$limit
			);
		
			return json_decode($buff)->data;
		}
		
	}
	
}