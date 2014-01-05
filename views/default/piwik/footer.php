<?php
/* Piwik plugin for the Elgg social network engine. */

$metadata = elgg_get_metadata(array(
    "type" => "object",
    "subtype" => "modpiwik"
        ));
$entity['showga'] = NULL;
$entity['trackid'] = NULL;
$entity['trackurl'] = NULL;
$entity['state'] = NULL;
foreach ($metadata as $value) {
    $entity[$value->name] = $value->value;
}
if ($entity['showga']) {
    if (get_input('q')) {
        $category = false;
        if (get_input('entity_subtype', false)) {
            $category = get_input('entity_subtype');
        } else {
            if (get_input('entity_type', false)) {
                $category = get_input('entity_type');
            }
        }
    }  ?>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  //_paq.push(["setCookieDomain", "*.mittelstand-cio.de"]);
  //_paq.push(["setDomains", ["*.mittelstand-cio.de"]]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://<?php echo $entity['trackurl']; ?>";
    _paq.push(["setTrackerUrl", u+"/piwik.php"]);
    _paq.push(["setSiteId", "<?php echo $entity['trackid']; ?>"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"/piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><img src="https://<?php echo $entity['trackurl']; ?>/piwik.php?idsite=<?php echo $entity['trackid']; ?>&amp;rec=1&amp;action_name=elgg" style="border:0" alt="" /></noscript>
<!-- End Piwik Code -->
   <?php
} else {
    if ($_SESSION['user']->admin || $_SESSION['user']->siteadmin) {
        system_message("You've installed the Piwik plugin but you still need to go to the Piwik section from within the admin panel.");
    }
}
?>
