<?php

class EM_API {
    /**
     * Capability type
     */
    const CAPABILITY_TYPE_PRODUCTS = 'edit_products';
    const CAPABILITY_TYPE_INVESTORS = 'edit_investors';
    const CAPABILITY_TYPE_NEWS = 'edit_news';
    const CAPABILITY_TYPE_ACTIVITIES = 'edit_activities';
	function __construct() {
		add_action('init',  array(&$this, 'init'), 0);		
	}
	
	/***
	***	@Init
	***/
	function init(){
		
	}
	
}

$efcmanager = new EM_API();