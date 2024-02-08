<?php
libxml_disable_entity_loader(false);

$xmlData = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE test [<!ENTITY xxe SYSTEM "file:///etc/passwd"> ]>
<test>&xxe;</test>
XML;

libxml_use_internal_errors(true);

$dom = new DOMDocument();
$loaded = $dom->loadXML($xmlData, LIBXML_NOENT | LIBXML_DTDLOAD);

if (!$loaded) {
    echo "XXE Protection is enabled: Failed to load malicious XML.";
} else {
    $content = $dom->textContent;
    if (strpos($content, "root:x") !== false) {
        echo "XXE Protection is disabled: Successfully loaded malicious XML.";
    } else {
        echo "XXE Protection is enabled: Malicious XML was loaded, but exploitation was blocked.";
    }
}

libxml_clear_errors();
?>
