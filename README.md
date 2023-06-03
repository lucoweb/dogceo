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
