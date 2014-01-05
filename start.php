<?php
function piwik_init()
{
    elgg_register_admin_menu_item('configure', 'piwik', 'settings');
    elgg_register_page_handler('piwik','piwik_page_handler');
    elgg_extend_view('page_elements/footer','piwik/footer', 499);
    elgg_extend_view('page/elements/footer','piwik/footer', 499);
}
	
function piwik_page_handler($page) 
{
    include elgg_get_plugins_path() . "piwik/index.php"; 
}

//Function to add a submenu to the admin panel. 
function piwik_pagesetup()
{
    if (elgg_get_context() == 'admin' && elgg_is_admin_logged_in()) {
	elgg_register_menu_item(elgg_echo('piwik'), elgg_get_plugins_path() . 'piwik/');
    }
}
	
elgg_register_event_handler('init','system','piwik_init');
elgg_register_event_handler('pagesetup','system','piwik_pagesetup');
elgg_register_action('piwik/modify', elgg_get_plugins_path() . "piwik/actions/modify.php", 'admin');
?>
