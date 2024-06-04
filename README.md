# Développement côté serveur - le code de référence

Ce repo contient le code de référence qui servira durant le cours. Le cours sera construit autour de la réalisation
d'une application destinée à vous familiariser avec les principes essentiels qui guident le bon développeur backend.

Pour initialiser ce repo, il faut réaliser quelques actions :

- cloner le dossier dans un répertoire surveillé par Herd
- démarrer votre moteur de DB
- si ce n'est pas encore fait, créer une base de données. Attention de la nommer conformément au nom défini dans le
  fichier d’environnement local
- pointer le terminal sur le dossier racine de ce clône
- dans le terminal : `composer install`
- dans le terminal : `npm install`
- dans le terminal : `php ./database/init.php seed`
- dans une fenêtre de terminal : `npx tailwindcss -i ./resources/css/app.css -o ./public/css/app.css --watch`
- dans une autre fenêtre de terminal : `npx browser-sync start --config bs-config.js`

Ceci ouvrira un navigateur à l’adresse `localhost:3000` qui sera en fait un proxy vers la vraie adresse locale de votre
projet (clé `proxy` du fichier `bs-config.js`). Ce proxy est une adresse gérée par browser-sync. Ça permet de rafraîchir
votre projet dans le navigateur chaque
fois qu’une vue change. Si vous voulez rafraîchir d'autres paths, modifiez la clé `files` du fichier `bs-config.js`.
Vous pouvez lui passer un array.

Nous construirons cette application en utilisant le langage de programmation PHP, sans Framework, mais avec la volonté
de mimer les pratiques présentes dans ces derniers et tout particulièrement [Laravel](https://laravel.com). PHP est un
langage qui a par ailleurs [une excellente documentation](https://www.php.net) et une communauté active. Il est donc un
excellent choix pour un premier langage de programmation côté serveur. Longtemps associé à une réputation de langage
pour bricoleurs car relativement permissif, il est désormais standardisé par des [PSRs](https://www.php-fig.org/psr/)
qui sont le résultat d’une initiative visant à rendre les packages de PHP interopérables et est un terrain où les
meilleures pratiques en matière de développement logiciel prévalent.

Le repo git contient naturellement une branche `main` qui est normalement destinée à ne recevoir que la version la plus
stable du code. Cependant, pour les besoins du cours, nous utiliserons une branche `develop` qui contiendra le code en
cours de développement et peut-être des branches supplémentaires pour des fonctionnalités spécifiques. La fusion des
fonctionnalités dans la branche `develop` se fera par le biais de pull requests.

Nous tenterons, sans pour autant utiliser un outil formel tel que Pest ou PHPUnit, d’associer à notre code des scripts
de maintenance et de tests pour certaines fonctionnalités. Nous n'utiliserons pas une approche TDD, mais nous tenterons
parfois de nous y sensibiliser.

Une excellente référence qui vous permettra de compléter le cours et qui aborde les points qui y sont vus de la même
manière que la mienne
est [la série de vidéos gratuites sur Laracasts destinée aux débutants](https://laracasts.com/series/php-for-beginners-2023-edition).

Une ressource Web de qualité sur les bonnes pratiques associées au monde PHP
est [PHP The Right Way](https://phptherightway.com/). Le site propose
même [des traductions de son contenu](https://phptherightway.com/#translations).

[La documentation de Laravel](https://laravel.com/docs) contient aussi des informations pertinentes pour les
développeurs PHP, même si elles sont orientées vers le Framework Laravel. Cette documentation constitue d'une certaine
manière, notre cahier de charges.

Vous avez droit, grâce à votre qualité d’étudiant, à une licence de Tinkerwell. [Tinkerwell](https://tinkerwell.app/)
est un outil qui vous permet de tester du code PHP en temps réel. Avant de le télécharger, il faut vous inscrire sur le
site de [Beyond Code](https://beyondco.de/login) avec votre adresse d’étudiant
et [vous identifier comme étudiant](https://tinkerwell.app/education).
