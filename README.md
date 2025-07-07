# Système de Compression/Décompression ZK

Un système de compression et décompression de données utilisant l'algorithme ZK (Zero-Knowledge compression), développé en PHP pour une compression sans perte avec sécurité renforcée.

## 🚀 Fonctionnalités

- **Compression sans perte** : Préservation intégrale des données originales
- **Algorithme ZK optimisé** : Utilisation d'une variante avancée de l'algorithme Ziv-Lempel
- **Sécurité renforcée** : Intégration de preuves à divulgation nulle de connaissance
- **Performance élevée** : Traitement rapide des fichiers volumineux
- **Support multi-formats** : Compatible avec tous types de fichiers
- **Interface CLI et Web** : Utilisation en ligne de commande ou via API REST

## 📋 Prérequis

- PHP 8.0 ou supérieur
- Extensions PHP requises :
  - `ext-zlib`
  - `ext-openssl`
  - `ext-hash`
  - `ext-json`
- Composer pour la gestion des dépendances
- Minimum 512 MB de RAM disponible

## 🔧 Installation

### Installation via Composer

```bash
composer require zkcompression/zk-compression
