<?php

header('Content-Type: application/download');
header("Content-Disposition: attachment; filename=data.zip");
readfile("/thuvien/upload/data.zip"); // Voi APPLICATION_PATH la duong home root cua server

?>