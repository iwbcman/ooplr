<?php
function objectToArray ($object) {
    if(!is_object($object) && !is_array($object))
        return $object;
        
        return array_map('objectToArray', (array) $object);
}
$dbidarray = objectToArray($dbid);
$t1[] = print_r($dbidarray);
$t1[] = "<br />";
$t1[] = print_r(array_values($dbidarray));
