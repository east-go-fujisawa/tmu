<?php
$name = $_GET["path"];

echo file_get_contents($name);

?>