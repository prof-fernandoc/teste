<?php
function loadJSON($cfgp){
    $cfgf = fopen($cfgp, "r") or die("Unable to open config file ");
    $configs = fread($cfgf,filesize($cfgp));
    fclose($cfgf);
    $config = (json_decode($configs));
    $result = array();
    foreach ($config as $cfg) {
      if(property_exists($cfg,"name"))
        $result[$cfg->name]=$cfg;
    }
    //var_dump($result);
    return  $result;
}
?>