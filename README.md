#  ConanLootManager
================

--------------
### Install composer and npm
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
mysql -uroot  -p -e "grant all on clm.* to clm@'localhost' identified by 'clm';flush privileges;"
```

### run composer script to initialize the application
```bash
php composer.phar run-script project-init
```