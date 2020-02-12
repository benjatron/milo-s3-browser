<?php
// SVG Importer
function get_milo_svg( $file ) {
  echo file_get_contents( plugins_url() . '/milo-s3-browser/assets/images/dist/' . $file . '.svg');
}