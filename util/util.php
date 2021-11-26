<?php

function sweetalert($title, $message, $type, $time)
{
  echo "<script type='text/javascript'>
  Swal.fire({
    icon: '$type',
    title: '$title',
    text: '$message',
    showConfirmButton: false,
    timer: $time
  });
  </script>";
}
