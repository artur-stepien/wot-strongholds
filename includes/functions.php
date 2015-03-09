<?php

/**
 * Return translated string. If there is no translation key is returned.
 * 
 * @global	Array	$_LANGUAGE	Translation array containing keys and its translations.
 * 
 * @param	String	$key		Translation array key holding required translation
 * 
 * @return	String
 */
function __($key) {
	global $_LANGUAGE;
	
	if( isset($_LANGUAGE[$key]) ) {
		return $_LANGUAGE[$key];
	} else {
		return $key;
	}
}

/**
 * Return translated string using springf function. If there is no translation key is returned.
 * 
 * @global	Array	$_LANGUAGE	Translation array containing keys and its translations.
 * 
 * @param	String	$key		Translation array key holding required translation
 * 
 * @return	String
 */
function _s($key) {
	global $_LANGUAGE;
	
	$args = func_get_args();
	$args = array_slice($args, 1);

	if( isset($_LANGUAGE[$key]) ) {
		return vsprintf($_LANGUAGE[$key], $args);
	} else {
		return $key;
	}
}