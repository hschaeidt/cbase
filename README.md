cbase
=======

A magic the gathering card database. Cbase ensures the card data is being stored in a relational database using doctrine
ORM.

The database is empty by default right now.

## Hacking
[vagrant](https://www.vagrantup.com/) is replaced by [nixops](http://nixos.org/nixops/). With this development is currently
only supported on unix systems.

* [virtualbox](https://www.virtualbox.org/)
* [nix - package manager](http://nixos.org/nix/)
* [nixops](http://nixos.org/nixops/)

### Important note
nixops might not work out of the box after a fresh virtualbox install. if that is the case please check following:

* in virtualbox open general settings
* navigate to "Network" section
* in "Network" switch to "Host-only Networks" tab
* if no network with the name "vboxnet0" exists, create one

Now the deployment to virtualbox should work properly.
For more information please refer to the [nixops documentation](http://nixos.org/nixops/manual/#idm140737319345872)

```bash
# ./cbase
nixops create -d cbase ./server/cbase-vbox.nix ./server/cbase.nix
nixops deploy -d cbase
```

Now a few manual steps have to be done

```bash
# connect to virtual-machine
nixops ssh -d cbase cbase

# change to www-data user before installing dependencies
su - www-data

# navigate to application base directory
cd /var/www/cbase

# installing dependencies
composer install
php app/console cache:clear
php app/console assets:install
php app/console doctrine:schema:create
# run this command instead if the schema already exists
# php app/console doctrine:schema:update --force

# setting up super-admin user
php app/console fos:user:create --super-admin
```

Now the app is ready to be hacked, to navigate to it find out the machines ip address.

```bash
nixops info -d cbase
# +-------+-----------------------+------------+---------------------------------------------------+----------------+
# | Name  |         Status        | Type       | Resource Id                                       | IP address     |
# +-------+-----------------------+------------+---------------------------------------------------+----------------+
# | cbase | Starting / Up-to-date | virtualbox | nixops-ca4b72de-ef9b-11e6-b02e-acbc327d8789-cbase | 192.168.56.101 |
# +-------+-----------------------+------------+---------------------------------------------------+----------------+
```

Now cbase is available under http://192.168.56.101/admin