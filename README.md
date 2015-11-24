cbase
=======

A magic the gathering card database. Cbase ensures the card data is being stored in a relational database using doctrine
ORM.

The database is empty by default right now.

## Local development
To get started quickly with this repo you need following tool

* vagrant
* `vagrant plugin install vagrant-hostmanager`
* `vagrant plugin install vagrant-vbguest`
* `vagrant plugin install vagrant-cachier`
* `vagrant plugin install vagrant-proxyconf`

Clone this repository, navigate to the local repo folder, then

```
# ~/git/cbase/
vagrant up
```

Now a few manual steps have to be done

```
# connect to virtual-machine
vagrant ssh

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

Now cbase is available under http://cbase.dev/admin