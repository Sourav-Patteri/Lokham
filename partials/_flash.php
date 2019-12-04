<?php
  if (!empty($flash_data)) {
    foreach($flash_data as $type => $messages) {
      echo "<div class='alert mb-0 alert-{$type}'>";
      foreach ($messages as $message) {
        echo "{$message}<br>";
      }
      echo "</div>";
    }
  }