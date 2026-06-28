#!/bin/bash

# Arrêter l'exécution en cas d'erreur
set -e

echo "Démarrage du déploiement..."

# Passer l'application en mode maintenance (Optionnel)
php artisan down || true

# Mettre à jour les dépendances (sans dev)
# composer install --optimize-autoloader --no-dev

# Nettoyer et mettre en cache les configurations
echo "Mise en cache de la configuration..."
php artisan config:cache

# Nettoyer et mettre en cache les routes
echo "Mise en cache des routes..."
php artisan route:cache

# Nettoyer et mettre en cache les vues
echo "Mise en cache des vues..."
php artisan view:cache

# Exécuter les migrations en production de manière forcée (sans demander de confirmation)
echo "Exécution des migrations..."
php artisan migrate --force

# Optionnel: Optimiser les événements
php artisan event:cache

# Désactiver le mode maintenance
php artisan up

echo "Déploiement terminé avec succès !"
