<?php

admin_gatekeeper();
action_gatekeeper();

$trackid = get_input('trackid');
$trackurl = get_input('trackurl');
$showga = (int) get_input('showga', 0);

if ($trackid && isset($showga)) {
    //First we need to find the ElggObject that contains our setting already.
    //If it doesn't exist we need to create it., "owner_guids" => '0', "order_by" => ""
    $entities = elgg_get_entities(array("types" => "object", "subtypes" => "modpiwik", "limit" => 1));
    if (!isset($entities[0])) {
        $entity = new ElggObject;
        $entity->subtype = 'modpiwik';
        $entity->owner_guid = elgg_get_logged_in_user_guid();
        $entity->trackid = $trackid;
        $entity->trackurl = $trackurl;
        $entity->showga = $showga;
        $entity->access_id = 2; //Make sure this object is public.
    } else {
        $entity = $entities[0];
        $entity->trackid = $trackid;
        $entity->trackurl = $trackurl;
        $entity->showga = $showga;
        $entity->access_id = 2; //Make sure this object is public.
    }

    if ($entity->save()) {
        system_message(elgg_echo('piwik:modify:success'));
        $entity->state = "active";
        forward(REFERER);
    } else {
        register_error(elgg_echo('piwik:modify:failed'));
        forward(REFERER);
    }
} else {

    register_error(elgg_echo('piwik:failed:noparams'));
        forward(REFERER);
}
?>
