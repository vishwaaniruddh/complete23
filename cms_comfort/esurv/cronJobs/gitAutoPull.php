<?php 

chdir('C:\wamp64\www\cms_comfort\24server');


exec('git clean -df');
sleep(10);
exec('git pull');
sleep(20);
?>