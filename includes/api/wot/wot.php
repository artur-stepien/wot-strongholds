<?php

namespace Wargaming {
	
	require 'clanratings.php';
	require 'clans.php';
	require 'accounts.php';
	
	class WoT {
		/* @var Wot\ClanRatings $ClanRatings */
		public $ClanRatings;
		/* @var Wot\Clans $Clans */
		public $Clans;
		/* @var Wargaming\Wot\Accounts $Accounts */
		public $Accounts;
		
		public function __construct($application_id, $url, $language) {
			$this->ClanRatings = new WoT\ClanRatings($application_id, $url, $language);
			$this->Clans = new WoT\Clans($application_id, $url, $language);
			$this->Accounts = new WoT\Accounts($application_id, $url, $language);
		}

	}
	
}