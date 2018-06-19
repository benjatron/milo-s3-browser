<?php
// Determines the estimated download time
// Default speed is 20 Mbps
function downloadTime($bytes, $speed = 20000) {
  $time = $bytes / $speed;

  // Formats $speed to Mbps
  $speedPerSecond = floor($speed / 1000) . 'Mbps';

  // Breaks time up into hours, minutes, and seconds
  $hours = floor($time / 3600);
  $minutes = floor($time / 60 % 60);
  $seconds = floor($time % 60);

  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) . ' at ' . $speedPerSecond;
}