-brainstorming

-backlog-US-sprints-priorités

-wireframes

-charte graphique

-modélisation bdd mld

-creation repo github + readme

-creation dossier de code VSCODE:
	* symfony new --webapp nomfichier
	*dedans le dossier correspondant (faire ls pour controller où je suis et si besoin me déplacer avec un cd)
	* composer install
	*copier fichier ".env" et coller et renommer en ".env.local"
	 	- décommenter et modifier cette ligne :" # DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4" "
		- commenter celle-ci : "#DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8" "
		= " DATABASE_URL="mysql://StephV:123@127.0.0.1:3306/portfolio_checkpoint4_sv?serverVersion=8.0.32&charset=utf8mb4" "

-creation de la database :
	* symfony console doctrine:database:create

-lier le repo github à mon dossier local :
	* git remote add origin git@github..........
	* git remote -v (voir si je suis bien connectée au repo)

-faire un 1er commit :
	* git status
	* git add .
	* git commit -m
	* git push origin "branch=master ou main ou dev ou autre"

-installer webpack :
	*composer require symfony/webpack-encore-bundle
	* yarn install

-installer les bibliothèques si besoin (pas obligatoire) :
	*Décommenter dans webpack.config.js ".enableSassLoader() "
	* yarn add sass-loader@latest sass --dev
	*Faire la commande pour ajouter la / les bibliothèques recherché

-Créer les pages principales du site ( les différents onglets) :
	*ex : symfony console make:controller Home
	*contrôler et modifier routes et ficher HomeController 

-yarn watch
-yarn dev-server
-yarn build

-lancer le serveur local :
	* symfony server:start -d
	* symfony open:local (ouvrir l'URL du serveur dans ton navigateur)
	* symfony server:stop (pour stopper)

-User : 
	* composer require symfony/security-bundle
	* php bin/console make:user

* php bin/console make:migration
* php bin/console doctrine:migrations:migrate

-Mettre à jour l’entité User si besoin avec d’autres propriétés : 
	* symfony console make:entity user
		...
	* symfony console make:migration
	* symfony console doctrine:migrations:migrate
	* symfony console doctrine:mapping:info
	* symfony console doctrine:schema:validate

-création des autres entités :
	* symfony console make:entity (x le nombre d’entité de la ddb)
	* symfony console make:migration
	* symfony console doctrine:migrations:migrate
	* symfony console doctrine:mapping:info
	* symfony console doctrine:schema:validate

-création des relations entre les entités :
	* symfony console make:entity ‘entity’ (pour la modifier et ajouter les relations)(x le nombre 	d’entité de la ddb)
	* symfony console make:migration
	* symfony console doctrine:migrations:migrate
	* symfony console doctrine:mapping:info
	* symfony console doctrine:schema:validate

-installation uikit et choix des modèles

-structure générale home

-préparation du style général

-navbar + footer

-création du login :
* php bin/console make:auth

* modifier le fichier login.html.twig

	*ajouter les routes dans le autres liens du site pour être redirigé vers la connexion

	*Mettre en forme le formulaire de login

NB : partie function logout : on peut faire un render vers le formulaire de connexion plutôt que de faire un throw.

-Faire des fixtures user pour pouvoir tester notre login (la fixture permettra de hasher le mot de passe aussi. Si on enregistre en dur dans la bdd, le mot de passe ne sera pas hasher)
	* composer require --dev orm-fixtures
	* symfony console make:fixtures
(j’ai mis des données en dur mais on peut ajouter faker-voir mémo projet 3)

-  composer require symfonycasts/verify-email-bundle

-hashage de mot de passe :
	* composer require symfony/password-hasher

-mot de passe oublié : 
	* composer require symfonycasts/reset-password-bundle
	* php bin/console make:reset-password

* symfony console make:migration
	* symfony console doctrine:migrations:migrate
	* symfony console doctrine:mapping:info
	* symfony console doctrine:schema:validate
	* php bin/console doctrine:fixtures:load

-création de la registration (s’il y en a une)
* symfony console make:registration-form

-make:controller
-mis une boucle dans le twig
-création fixture associée à l’entité
-mise en forme du template index de l'entité

-CRUD:
- make:form
- insertion du form dans le template
- new, update/edit, delete
- mise en page
- routes

-dashboard

-CRUD USER: créer le type, les templates...

-ROLE_ADMIN: 
	*security.yaml : décommenter la ligne concernée
	*fixtures User : ajouter :   ->setRoles(['ROLE_ADMIN']);
	*userType : ajouter :  ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => false,
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'User' => 'ROLE_USER'
                ]
            ])

-pagination (knp_paginator bundle)

