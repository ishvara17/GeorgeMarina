<?php
// (A) krijg alle reserveringen
require "reserveren.php";
$all = $_RSV->getDay();

// output
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=reservations.csv');
if (count($all)==0) { echo "No reservations"; }
else {
  // headers op eerste row
  foreach ($all[0] as $k=>$v) { echo "$k,"; }
  echo "\r\n";
  
  // reserveer-details
  foreach ($all as $r) { 
    foreach ($r as $k=>$v) { echo "$v,"; }
    echo "\r\n";
  }
}