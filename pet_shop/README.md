# CodeIgniter 4 Application Starter

## Prerequisite
- [Git](https://git-scm.com/downloads)
- [XAMPP](https://www.apachefriends.org/download.html) v3.2.4
- [Composer](https://getcomposer.org/download/)
## Newcomer's Setup

1. `git clone git@github.com:ztoosb/pet-shop.git`
2. Rename `env` to `.env`
3. Based on db configuration in `.env`, create a new database with its user credential.
4. `php spark migrate`. At this point, the newly created database should have data migrated.
5. Open up your XAMPP Control Panel > Apache > Config > httpd.config.
6. Find this line `Include conf/extra/httpd-vhosts.conf` and uncomment it.
7. Open up your XAMPP Control Panel > Apache > Config > Browse(Apache). Open conf/extra/httpd-vhosts.conf
```
<VirtualHost *:80>
	ServerName pet.localhost
	DocumentRoot "pathtoxampp\htdocs\pet_shop\public"

	<Directory "pathtoxampp\htdocs\pet_shop\public">
		Require all granted
		AllowOverride All
	</Directory>
</VirtualHost>
```
```
<VirtualHost *:80>
	ServerName localhost
	DocumentRoot "pathtoxampp\htdocs"

	<Directory "pathtoxampp\htdocs">
		Require all granted
		AllowOverride All
	</Directory>
</VirtualHost>
```
Add the block above to virtual host configuration file.
At this point, you shall be able to access to virtual server with pet.localhost
