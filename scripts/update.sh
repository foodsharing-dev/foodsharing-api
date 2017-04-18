git checkout .
git pull
rm web/app_dev.php
./bin/console cache:clear
./bin/console cache:warumup
