# LukyssBook

## Contexte

Ce projet est un clone simplifié de Facebook, réalisé dans le cadre de la certification de développeur web et mobile à Reims, pour la session d'octobre 2023. Bien que ce projet ne soit pas entièrement finalisé et présente des lacunes tant au niveau de la conception que de l'implémentation, il illustre mes compétences acquises à ce moment précis de ma formation. Pour cette raison, j'ai décidé de le partager publiquement.

## Configuration

L'application a été préparée pour fonctionner avec Docker, mais peut également être utilisée dans un environnement XAMPP (les détails spécifiques pour XAMPP ne sont pas fournis ici).

### Étapes de configuration

1. Renommez le fichier `env` en `.env`.
2. Modifiez les variables d'environnement selon vos besoins.
3. Modifier le base url dans application/config/config.php pour correspondre à la variable d'environement de l'application
4. Exécutez l'application dans Docker avec la commande suivante:

```
docker compose up --build
```

**Note:** La version principale est configurée pour un serveur Apache. Si vous préférez utiliser Nginx, une version adaptée est disponible sur la branche `nginx`.
