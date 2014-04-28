projet_tut
==========

V1.0.0

DESCRIPTION

WARRIORS OF THE GALAXY
Jeu en ligne sur Navigateur sur le thème de l'espace.
Le but est d'améliorer sa planète et d'attaquer d'autres planètes (Autres joueurs ou colonies). Le tout dans un temps imparti.




INSTALLATION

Sous Windows (Testé avec WAMP & Apache2.4.4)


	1. Ajouter à "C:\Windows\System32\drivers\etc\hosts" -> 127.0.0.1 win.wotg.dev
	
	2. Remplacer dans "apachexxx\conf\httpd.conf" -> "Listen 80" par "Listen *:80"
		
	3. Decommenter dans "apachexxx\conf\httpd.conf" -> Include conf/extra/httpd-vhosts.conf
		
	4. Editer "apachexxx\conf\extra\httpd-vhosts.conf" ->
		
		NameVirtualHost *:80
		 
		<VirtualHost *:80>
		    DocumentRoot "d:\WAMP_localhost"
		    ServerName localhost
		    <Directory "d:\WAMP_localhost">
		        Options Indexes FollowSymLinks MultiViews
		        #Options -Indexes
		        AllowOverride None
		        Order allow,deny
		        allow from all
		        #RedirectMatch ^/$ /index.php
		    </Directory>
		</VirtualHost>
		
		<VirtualHost *:80>
		    DocumentRoot "d:/WAMP_localhost/LP_IMAPP/projet_tut/www/"
		    ServerName win.wotg.dev
		    <Directory "d:/WAMP_localhost/LP_IMAPP/projet_tut/www/">
		        Options Indexes FollowSymLinks MultiViews
		        #Options -Indexes
		        AllowOverride all
		        Order allow,deny
		        allow from all
		        #RedirectMatch ^/$ /index.php
		    </Directory>
		</VirtualHost>
		
	5. Redemarrer WAMP
		
	Acces à l'adresse :
	http://win.wotg.dev
		




Sous Linux (Testé avec Debian7 a jour et apache)


	1. Ajouter à "/etc/hosts" -> 127.0.0.1	debian.wotg.dev
	
	2. Créer un fichier "debian.wotg.dev" dans "/etc/apache2/sites-available/"
		
	3. Ajouter dans ce fichier ->
		
		<VirtualHost *:80>
		
		        ServerAdmin stephane.pecqueur@gmail.com
		
		        ServerName debian.wotg.dev
		
		        DocumentRoot CHEMIN_VERS_LE_WWW_DU_DOSSIER
		        
		        <Directory CHEMIN_VERS_LE_WWW_DU_DOSSIER>
		
		                Options -Indexes FollowSymLinks MultiViews
		
		                AllowOverride All
		
		        </Directory>
		
		        ServerSignature Off
		
		</VirtualHost>
		
		
		
	4. Executer dans un terminal à "/etc/apache2/sites-available/" ->
		
		a2dissite default
		
		a2ensite debian.wotg.dev
		
		service apache2 restart
		
		
		
		
		
	Acces à l'adresse :
	http://debian.wotg.dev
		
		
SQL : 
	Creer une base de données "galaxy_warriors".
	Exporter le contenu de la BDD grace au fichier "galaxy_warriors.sql".

URL Rewrite :
	Creer un .htaccess à la racine de "www" d'apres le fichier "htaccess" à la racine du site.

ADMIN :
	L'adresse de la partie administration se trouve à l'adresse :
	(win|debian).wotg.dev/wotg-admin

* Le dossier du projet doit être déposé dans un endroit accessible pour Apache pour pouvoir executer les fichiers php.


