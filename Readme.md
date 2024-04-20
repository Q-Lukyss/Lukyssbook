# Configuration Nginx pour LukyssBook

## Prérequis

Ce guide est destiné aux utilisateurs ayant déjà installé Docker et Docker Compose. Une connaissance de base de Nginx et Docker est également recommandée.

## Configuration

### Installation

1. Clonez la branche Nginx du dépôt:
```
git clone -b nginx https://github.com/Q-Lukyss/Lukyssbook.git
```
2. Accédez au répertoire du projet:
```
cd LukyssBook
```
### Configuration des variables d'environnement

1. Renommez le fichier `env` en `.env`.
2. Ouvrez le fichier `.env` et ajustez les variables d'environnement selon vos besoins.
3. Modifier le base url dans application/config/config.php pour correspondre à la variable d'environement de l'application

### Démarrage de l'application

Lancez l'application en utilisant Docker Compose:
```
docker compose up --build
```
Votre application LukyssBook devrait maintenant être servie via Nginx sur le port défini dans votre fichier `.env`. Assurez-vous que ce port est ouvert et accessible sur votre réseau local ou externe, selon vos besoins.
