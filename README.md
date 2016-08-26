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

###preparing mysql database
```bash
mysql -uroot -p -e "CREATE USER 'clm'@'localhost' IDENTIFIED BY 'clm', 'clm_test'@'localhost' IDENTIFIED BY 'clm_test'; FLUSH PRIVILEGES;"
mysql -uroot -p -e "GRANT ALL ON clm_test.* TO 'clm_test'@'localhost'; FLUSH PRIVILEGES;"
mysql -uroot -p -e "GRANT ALL ON clm.* TO 'clm'@'localhost'; FLUSH PRIVILEGES;"
```
In your `app/config/parameters.yml`:
  Set database_user, database_name and database_password
  to the corresponding values used in the command above.
  Do the same for `app/config/config_test.yml`
  e.g. 
  DataBaseConnection uses 'clm' for databasename, username and password by default.
  The connection used for tests uses 'clm_test' instead.

###run composer script to initialize the application
```bash
php composer.phar run-script project-init
```
This installs all composer, npm and bower packages. Afterwards it creates databases for test and dev/prod 
and executes the migrations and fixtures.

###load alice fixtures
The fixtures are already loaded by the composer script above.
If you want to purge data and reload them:
```bash
php bin/console h:a:f:l -n
php bin/console h:a:f:l -e test
```

###Asset handling with webpack
You can create static assets or use hot module replacment (HMR) with the
webpack-dev-server. Whether the dev-server or static assets are used by the templates is
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
