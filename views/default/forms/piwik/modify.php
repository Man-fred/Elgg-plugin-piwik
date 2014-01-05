<?php
$metadata = elgg_get_metadata(array(
    "type" => "object",
    "subtype" => "modpiwik",
    "limit" => false
	));
$entity['showga'] = NULL;
$entity['trackid'] = NULL;
$entity['trackurl'] = NULL;
$entity['state'] = NULL;
foreach ($metadata as $value) {
    $entity[$value->name] = $value->value;
}
?>
<p><?php echo elgg_echo('piwik:description'); ?></p>

<!-- form action="< ?php echo elgg_get_site_url(); ?>action/piwik/modify" method="post" -->
<p>
    <?php
    echo elgg_echo('piwik:formenabled');
    echo elgg_view('input/radio', array('name' => "showga", 'options' => array('yes' => 1, 'no' => 0), 'value' => $entity['showga']));
    ?>
</p>
<p>
    <label>
	<?php echo elgg_echo('piwik:modify'); ?>
	<?php
	echo elgg_view('input/text', array(
	    'name' => 'trackid',
	    'value' => $entity['trackid']
	));
	?>
    </label>
    <label>
	<?php echo elgg_echo('piwik:trackurl'); ?>
	<?php
	echo elgg_view('input/text', array(
	    'name' => 'trackurl',
	    'value' => $entity['trackurl']
	));
	?>
    </label>
    <?php
    ?>
</p>
<div class="elgg-foot">
<?php echo elgg_view('input/submit'); ?>
</div>
<!-- /form -->


<?php
$idSite = $vars['trackid'];
$start = date("Y-m-d", time() - ( 31 * 24 * 60 * 60 ));
$end = date("Y-m-d");
if ($vars['trackurl'] != '') {
    ?>
    <div id="content_area_user_title">
        <h2><?php echo elgg_echo('piwik:statistics_heading'); ?></h2>
    </div>
    <?php echo elgg_echo('piwik:statistics'); ?>
    <div id="widgetIframe">
        <iframe width="100%" height="350" src="http://<?php echo $vars['trackurl']; ?>/index.php?module=Widgetize&action=iframe&columns[]=nb_visits&moduleToWidgetize=VisitsSummary&actionToWidgetize=getEvolutionGraph&idSite=<?php echo $idSite; ?>&period=range&date=<?php echo $start; ?>%2C<?php echo $end; ?>&disableLink=1&widget=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0">
        </iframe>
    </div>
<?php } ?>
