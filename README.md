# Blogosphere

  Le besoin est de développer un blog professionnel en utilisant PHP. Le blog se divise en deux parties : les pages accessibles à tous les visiteurs et les pages d'administration pour les utilisateurs enregistrés. Les pages accessibles à tous doivent contenir des informations telles que le nom, la photo, une phrase d'accroche, un menu de navigation, un formulaire de contact, un lien vers un CV au format PDF, et des liens vers les réseaux sociaux. Les pages des blogs doivent afficher des informations telles que le titre, la date de dernière modification, le chapô, et un lien vers le blog complet. Les pages détaillées des blogs doivent également inclure le contenu, l'auteur, la date de dernière mise à jour, un formulaire pour ajouter des commentaires, et la liste des commentaires validés. Les utilisateurs inscrits auront accès aux pages d'administration pour créer, modifier et supprimer des blogs. Un lien vers l'administration du blog sera disponible dans le menu du pied de page. La sécurité de la partie d'administration est également soulignée comme importante.

## Installation

- Cloner le projet
- Depuis le projet, ouvrez votre terminal pour rentrer la commande :
  
  ```bash
  composer install

## Connection à la base de données 

- Mettre à jour config/database.php avec vos informations

## Import du fichier sql

- Importer le fichier import.sql dans le dossier config/import.sql afin que le site web fonctionne correctement.

## Lien du site

- Visitez le site -> [Blogosphere](https://blogosphere.killianfilatre.fr/).
