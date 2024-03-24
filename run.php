<?php
if (isset($_GET['text'])) {
    $param = $_GET['text'];

    if (!empty($param)) {
      $filePath = 'i.txt';

      // Get the current value from the file
      $currentValue = intval(file_get_contents($filePath));

      // Increment the value
      $newValue = $currentValue + 1;

      // Update the file using file_put_contents
      file_put_contents($filePath, $newValue);

      $audioFile = "audio/{$newValue}.mp3";

      shell_exec("gtts-cli \"{$param}\" --output {$audioFile}");

      echo $audioFile;
      
    } else {
        http_response_code(400);
        if (empty($param)) {
            echo "Text empty";
        }
    }
} else {
    http_response_code(400);
    echo "Command empty";
}
?>