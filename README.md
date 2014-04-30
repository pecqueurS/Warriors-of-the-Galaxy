projet tuteuré - Stephane PECQUEUR
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

	Modifier le fichier "parametres.php" dans le dossier "/Bundles/Parametres/" avec les paramètres de la BDD
	// PARAMETRES :
		$href_LOCAL_WIN = "http://win.wotg.dev/";  // Adresse du site sur wamp
		$href_LOCAL_DEB = "http://debian.wotg.dev/";  // Adresse du site sur wamp
		$href_SERVER = "xxx";  // Adresse du site sur le serveur distant

		$bdd_Database_LOCAL = "galaxy_warriors";  	// Database 
		$bdd_Database_SERVER = "xxx";  	// Database SERVER
		
		$bdd_username_LOCAL_WIN = "root"; // Username de mysql (windows)
		$bdd_password_LOCAL_WIN = ""; // Mot de passe de mysql (windows)
		$bdd_bddServer_LOCAL_WIN = "localhost"; // Nom serveur (windows)

		$bdd_username_LOCAL_DEB = "root"; // Username de mysql (debian)
		$bdd_password_LOCAL_DEB = "Oscar";  // Mot de passe de mysql (debian)
		$bdd_bddServer_LOCAL_DEB = "localhost"; // Nom serveur (debian)



URL Rewrite :

	Creer un .htaccess à la racine de "www" d'apres le fichier "htaccess" à la racine du site.

ADMIN :

	La partie administration se trouve à l'adresse :
	(win|debian).wotg.dev/wotg-admin
	login : admin
	mdp : admin

	Compte des joueurs :
		Vladimir : aaa111AAA
		Joe256 : aaa111AAA
		francois : aaa111AAA



* Le dossier du projet doit être déposé dans un endroit accessible pour Apache pour pouvoir executer les fichiers php.


