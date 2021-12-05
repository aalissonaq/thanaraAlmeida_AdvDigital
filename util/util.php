<?php

function sweetalert($title, $message, $type, $time, $position=null)
{
  $position = $position ? $position : 'center';
  echo "<script type='text/javascript'>
  Swal.fire({
    icon: '$type',
    title: '$title',
    text: '$message',
    showConfirmButton: false,
    timer: $time,
    position: '$position',
  });
  </script>";
}

function GetDirectorySize($path)
{
  $bytestotal = 0;
  $path = realpath($path);
  if ($path !== false) {
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
      $bytestotal += $object->getSize();
    }
  }
  $bytes = $bytestotal;
  $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
  $base = 1024;
  $class = min((int)log($bytes, $base), count($si_prefix) - 1);

  return sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];
}
function GetDirectoryFreeSize($path, $storage)
{
  $base = 1024;
  $storage = $storage * 1e+9;
  $bytestotal = 0;
  $path = realpath($path);
  if ($path !== false) {
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
      $bytestotal += $object->getSize();
    }
  }
  $bytes = $storage - $bytestotal;
  $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
  // $base = 1024;
  $class = min((int)log($bytes, $base), count($si_prefix) - 1);

  return sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];
}
function GetDirectoryPercentageUsed($path, $storage, $unit = null)
{
  $base = 1024;
  $unit = null ? $unit = 'GB' : $unit = $unit;
  switch ($unit) {
    case 'GB':
      $storage = $storage * 1e+9;
      break;
    case 'MB':
      $storage = $storage * 1e+6;
      break;
    case 'KB':
      $storage = $storage * 1e+3;
      break;
    default:
      $storage = $storage * 1e+9;
      break;
  }
  //$storage = pow($storage * $base, 3);
  $bytestotal = 0;
  $path = realpath($path);
  if ($path !== false) {
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
      $bytestotal += $object->getSize();
    }
  }

  $percentage = ($bytestotal  * 100) / $storage;
  return number_format($percentage, 2, '.', '');
}
