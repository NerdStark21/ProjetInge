# ProjetInge
Pour lancer le serveur : 'php -S 127.0.0.1:8000 -t public'
Super intro à symfony : https://knpuniversity.com/screencast/symfony/setup
Ne pas oublier de faire 'composer install' avant de lancer le serveur
Pour l'IDE, je vous conseille phpStorm de JetBrains (license étudiante gratuite avec votre mail telecom)

Chose à faire pour lancer le projet lors du git clone :
- installez wampserver !!! Attention, à la fin du telechargement, il y a une fenetre rouge qui s'affiche, ne la fermez pas, lisez et installez tout ce qu'il faut !!!
- installez gitBash, optionnel mais je prefere, c'est plus simple les lignes de commandes
- installez composer !!! quand vous lancerez l'exe, un moment il vous sera demandé une version de php, par defaut la plus ancienne, modifiez pour avoir la plus recente
- ouvrez git bash et faite un 'git clone /adresse du repo/'
- faites 'cd ProjetInfo'
- faites 'composer install'
- faites 'php -S 127.0.0.1:8000 -t public'
- ouvrez votre navigateur
- saisissez l'URL 'localhost:8000/news/tacos'
- et voilà, vous avez la page web du projet !

Les commandes GitHub :
- git add .
- git commit -m 'message'
- git pull
- git push

et pour savoir ou vous en êtes utilisez 'git status'

Question pour le dev demain :
- Est-ce qu'on va devoir gérer des param de sécurité ?
- Comment on va faire des comptes ?
- COmment faire des bdd (notre cote ou le votre) pour les utilisateurs ?
- Est-ce que vous voulez une architecture spécifique pour retravailler dessus ?
- COmment on fait des graphiques (avec bootstrap) ?
- Comment on peux modifier facilement les éléments bootstrap ?