<?php

namespace Wargaming {
	
	require 'wot/wot.php';
	require 'defines.php';
	
	class API {
		public $WoT;

		public function __construct($application_id, $server = Servers\EU, $language = Languages\Polish) {
			$this->WoT = new WoT($application_id, $server, $language);
		}

	}

}