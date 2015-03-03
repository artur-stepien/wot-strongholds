<?php

class Controller {
	protected $_config;
	protected $_allowed_actions = array('setupClan', 'storeMembersBallance');
	
	public function __construct() {
		// load config
		if( is_null($this->_config) AND file_exists(PATH_CONFIG.'/system.json') ) {
			$buff = file_get_contents(PATH_CONFIG.'/system.json');
			$this->_config = json_decode($buff);
		// no configuration, create config object
		} else if (is_null($this->_config)) {
			$this->_config = new stdClass();  
		}
	}
	
	public function authorize($action) {
		return in_array($action, $this->_allowed_actions);
	}
	
	public function getConfig($param, $default = null) {
		return (isset($this->_config->$param) ? $this->_config->$param : $default);
	}
	
	public function setConfig($param, $value) {
		$this->_config->$param = $value;
		if( !file_exists(PATH_CONFIG) ) {
			mkdir(PATH_CONFIG);
		}
		file_put_contents(PATH_CONFIG.'/system.json', json_encode($this->_config));
	}
	
	protected function getAPI($key = null) {
		if( !isset($API) ) {
			global $API;
			$API = new Wargaming\API( (!is_null($key) ? $key : $this->getConfig('application_id')) );
		}
		
		return $API;
	}
	
	public function setupClan() {
		$clan_tag = $_POST['clan_tag'];
		$accepted_absence = $_POST['accepted_absence'];
		$required_earnings = $_POST['required_earnings'];
		$clan_id = null;
		$application_id = trim($_POST['application_id']);
		
		// save Application ID
		$this->setConfig('application_id', $application_id);
		
		// get clan ID
		$api = $this->getAPI($application_id);
		$list = $api->WoT->Clans->getList($clan_tag);
		
		foreach($list as $clan) {
			if( $clan->abbreviation == $clan_tag ) {
				$clan_id = $clan->clan_id;
				// save Clan ID
				$this->setConfig('clan_id', $clan_id);

				// save Clan Name
				$this->setConfig('clan_name', $clan->name);

				// save Clan Logo
				$this->setConfig('clan_logo', $clan->emblems->large);
				
				// save Clan Logo
				$this->setConfig('clan_motto', $clan->motto);
				
				// save Clan TAG
				$this->setConfig('clan_tag', $clan->abbreviation);
				
				// save maximum absence time
				$this->setConfig('accepted_absence', (int)$accepted_absence);
				
				// save Clan TAG
				$this->setConfig('required_earnings', (int)$required_earnings);
				break;
			}
		}
		
		if( is_null($clan_id) ) {
			die('Nie znaleziono klanu z wybranym tagiem:'. $clan_tag);
		}
		
		$location = explode('?', $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
		header("Location: http://".current($location));die;
		
	}
	
	public function getMembers() {
		// load API
		$api = $this->getAPI();
		
		// load clan members list
		$members = $api->WoT->Clans->getInfo($this->getConfig('clan_id'));
		$members = current($members)->members;
		
		// collect clan members account ids
		$ids = array();
		$joined = array();
		foreach($members AS $member) {
			$ids[] = $member->account_id;
			$joined[$member->account_id] = $member->created_at;
		}
		
		// load account list of clan members
		$accounts = $api->WoT->Accounts->getInfo(implode(',',$ids), 'nickname,last_battle_time,account_id');
		
		// prepare members list
		$clan_members = array();
		foreach($ids AS $account_id) {
			$account = $accounts->$account_id;
			$account->joined_at = $joined[$account_id];
			$clan_members[] = $account;
		}
		
		// sort members by nickname
		usort($clan_members, function($a, $b)
		{
			return strcmp(strtolower($a->nickname), strtolower($b->nickname));
		});
		
		// load member resources ballance
		$ballance = $this->getConfig('ballance',new stdClass);
		$accepted_absence = $this->getConfig('accepted_absence',14);
		$required_earnings = $this->getConfig('required_earnings',300);
		foreach($clan_members AS &$member) {
			$account_id = $member->account_id;
			if( isset($ballance->$account_id) AND is_object($ballance->$account_id) ) {
				$account_id = $member->account_id;
				$member->resources_last = $ballance->$account_id->last;
				$member->resources_current = $ballance->$account_id->current;
			} else {
				$member->resources_last = 0;
				$member->resources_current = 0;
			}
			$member->warning = false;
			// user is absent for a long time
			if( (time()-$member->last_battle_time > 60*60*24*$accepted_absence) AND $member->last_battle_time!=0) {
				$member->warning = true;
			}
			// user does not earn enough resources and he is longer then month in clan
			if( 
				($member->resources_current - $member->resources_last) < $required_earnings AND
				$member->joined_at < time()-60*60*24*30 AND $member->last_battle_time!=0
			) {
				$member->warning = true;
			}
		}
		
		return $clan_members;
	}
	
	public function storeMembersBallance() {
		$ballance = $this->getConfig('ballance', new stdClass);
		$members_ballance = $_POST['ballance'];
		
		foreach($members_ballance AS $account_id=>$member_ballance) {
			if( !isset($ballance->$account_id) OR !is_object($ballance->$account_id) ) {
				$account = new stdClass;
				$account->last = 0;
				$account->current = (int)$members_ballance[$account_id];
				$ballance->$account_id = $account;
			} else {
				$ballance->$account_id->last = $ballance->$account_id->current;
				$ballance->$account_id->current = (int)$members_ballance[$account_id];
			}
		}
		
		$this->setConfig('ballance', $ballance);
		$this->setConfig('ballance_date_last', $this->getConfig('ballance_date_current', time()));
		$this->setConfig('ballance_date_current', time());
		
		$location = explode('?', $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
		header("Location: http://".current($location));die;
	}
	
}