# dogceo
Dog CEO Challenge for Devoteam.

## DB Credentials
admin  
Admin.358132134!

## Prerequisites
In order to ensure maximum compatibility, please use: 
1. Windows with WSL2
2. Docker for Windows
3. Ubuntu for Windows (can be obtained for free from the Windows App Store)
4. DDEV (Lando should work as well. *YMMV*)

***Please note:*** DDEV will intercept all outgoing email. In order to verify the functionality of the Dog CEO Mail module, visit https://dogceo.ddev.site:8026/ where an inbox can be checked.

## Setup instructions
### Backend
**Reference:** https://www.digitalocean.com/community/tutorials/how-to-develop-a-drupal-9-website-on-your-local-machine-using-docker-and-ddev

Open Terminal and issue the following commands in order:

    sudo apt update && sudo apt upgrade
    sudo apt install build-essential apt-transport-https ca-certificates software-properties-common curl
    curl -O https://raw.githubusercontent.com/drud/ddev/master/scripts/install_ddev.sh
    chmod +x install_ddev.sh
    ./install_ddev.sh
    mkdir -p ~/projects/dogceo
    cd ~/projects/dogceo
    ddev config --project-type=drupal9 --docroot=web --create-docroot
    ddev start

From this point forward, visit the website at: https://dogceo.ddev.site. However it's still a blank slate. Follow through with the commands below:

    ddev composer create "drupal/recommended-project":^9
    ddev composer require drush/drush drupal/admin_toolbar drupal/devel drupal/bootstrap_barrio
    ddev drush si --account-name=admin --account-pass=Admin.358132134!
    chmod 755 web/sites/default && chmod 644 web/sites/default/settings.php
    sudo apt-get install software-properties-common
    sudo add-apt-repository ppa:ondrej/php
    sudo apt-get update
    sudo apt-get install php8.1
    sudo apt-get install php8.1-xml
    sudo apt-get install php8.1-gd
    ddev config --php-version 8.1

Import the config with:

    cd ~/projects/dogceo/web/sites/default/
    ddev drush cim

Common functions: 

    ddev start
    ddev stop
    ddev xdebug

### Frontend
**Reference:** 
1. https://tecadmin.net/how-to-install-nvm-on-ubuntu-22-04/
2. https://ostraining.com/blog/drupal/how-to-use-bootstrap-5-and-sass-in-drupal-9/

In order to make changes to the custom theme, run the following commands: 

    sudo apt install curl
    curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash
    source ~/.profile
    nvm install node
    cd ~/projects/dogceo/web/themes/custom/dogceo_theme/
    npm install --global gulp-cli
    npm install

Change ~/projects/dogceo/web/themes/custom/dogceo_theme/gulpfile.js, line 79:

        proxy: 'https://dogceo.ddev.site',

On ~/projects/dogceo/web/themes/contrib/bootstrap_barrio/scss/components/table.scss, add:

    $table-border-width: 1px;

Then run:

    cd ~/projects/dogceo/web/themes/custom/dogceo_theme/ && gulp

### Database
Import the DB with:

    ddev import-db --src=dogceo.sql.gz

Export the DB with:

    ddev export-db -f dogceo.sql.gz
