#  ConanLootManager
================

--------------
###Install composer and npm
```bash
curl -sS https://getcomposer.org/installer | php
curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.31.0/install.sh | bash
source ~/.nvm/nvm.sh && nvm install 5.10.1
```

###give webserver access to cache and logs
```bash
$ HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
$ sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
$ sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
```

###create user for mysql
```bash
mysql -uroot -p -e "grant all on clm.* to clm@'localhost' identified by 'clm';flush privileges;"
```
In your app/config/parameters.yml:
  Set 
  database_user,
  database_name and 
  database_password
  to the corresponding values used in the command
  above e.g. in this case set all three to 'clm'.

###run composer script to initialize the application
```bash
php composer.phar run-script project-init
```
This installs all composer, npm and bower packages. Afterwards it creates a new database 
and executes the migrations.

###load alice fixtures
```bash
php bin/console h:a:f:l
```
This loads the yml-files containing some fixture data.

###Asset handling with webpack
You can create static assets or use hot module replacment (HMR) with the
webpack-dev-server. Wether the dev-server or static assets are used by the templates is
determined by a parameter in `app\config\parameters.yml`. You will have to add
```
use_webpack_dev_server: true
```
To start the webpack-dev-server run:
```bash
node dev_server.js
```
If you want static assets emitted to your `web/assets/` directory run:
```bash
./node_modules/.bin/webpack
```
To activate optimisations like uglifying your js files prepend `NODE_ENV=production` to these
commands e.g.
```bash
NODE_ENV=production ./node_modules/.bin/webpack
```
Remember to set `use_webpack_dev_server: false` if you want to use static assets.