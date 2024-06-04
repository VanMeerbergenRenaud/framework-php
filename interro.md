# Make authentication functionnality

Il devient nécessaire de construire une fonctionnalité d’authentification et d’engeristrement, base pour un futur
système d’autorisation. Ça tombe bien, toute l’infrastructure est prête, et réaliser cette fonctionnlité ne fait
qu’exploiter les concepts vus jusqu’ici.

La construction de ce système *peut* contenir un grand nombre de fonctionnalités telles que (non exhaustivement) :

- l’enregistrement d’un utilisateur (un email non encore présent dans la db et un mot de passe valide) ;
- l’identification d’un utilisateur (fournir son identifiant) ;
- l’authentification d’un utilisateur (prouver que c’est bien notre identifiant en fournissant le mot de passe) ;
- récupérer le mot de passe ;
- valider la création d’un compte par une vérification de l’email ;
- gérer le profil de l’utilisateur ;
- etc.

Nous nous concentrerons sur les trois premières qui impliquent déjà pas mal d’étapes.

## Étapes

- créer une table pour contenir les informations de l’utilisateur (attention que le mot de passe doit être hashé. Voyez
  la fonction `password_hash()` dans la documentation de PHP) ;
- créer les routes pour le login, le logout et l’enregistrement ;
- créer les contrôleurs correspondants (en essayant de respecter les conventions des contrôleurs de ressources décrites
  dans la documentation de Laravel) ;
- créer le modèle User, qui s’inspire très très fort du modèle Jiri ;
- créer les validations nécessaires ;
- créer les middlewares guest et authenticated afin de protéger les routes en fonction ;
- créer les vues correspondates ;

## Techniquement…

- L’indicateur qu’un utilisateur est effectivement connecté est le fait que ses informations sont accessibles dans la
  session ;
- l’opération de *s’enregistrer* équivaut à ajouter un utilisateur dans la table users ;
- l’opération de *se connecter* consiste à vérifier que les informations fournies par l’utilisateur correspondent à une
  entrée en DB, à récupérer les informations en question dans la DB et à les mettre dans la session ;
- l’opération de *se déconnecter* consiste en la destruction des informations relatives à l’utilisateur dans la session.
  De manière très agressive, on peut envisager de faire ça en détruisant carrément toutes les informations de session.
