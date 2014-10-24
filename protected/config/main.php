<?php

$defaults = require (dirname(__FILE__) . '/_defaults.php');

// Create empty dynamic configuration file, when not exists
if (!file_exists($defaults['params']['dynamicConfigFile']) && is_writable(dirname($defaults['params']['dynamicConfigFile']))) {
    $content = "<" . "?php return ";
    $content .= var_export(array(), true);
    $content .= "; ?" . ">";
    file_put_contents($defaults['params']['dynamicConfigFile'], $content);
}

if (file_exists($defaults['params']['dynamicConfigFile'])) {
    $pre_config = CMap::mergeArray($defaults, require ($defaults['params']['dynamicConfigFile']));
} else {
    // Local config file doesn't exists and cannot be created.
    // This should only happens before installation / system check ran.
    $pre_config = $defaults;
}

return $pre_config;
