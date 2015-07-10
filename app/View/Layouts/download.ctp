<?php
header('Content-Disposition: attachment; filename='.$filename);
header('Content-type: text/plain');
echo $this->fetch('content');
?>