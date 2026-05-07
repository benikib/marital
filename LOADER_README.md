# Loader Global - Documentation

Le loader global fournit une expérience de chargement élégante et professionnelle pour toute l'application Laravel.

## Fonctionnalités

- **Splash screen animé** avec logo et branding
- **Messages progressifs** qui changent pendant le chargement
- **Barre de progression** animée
- **Contextes personnalisables** selon la section
- **Responsive design** pour mobile et desktop
- **Fallback automatique** après 5 secondes maximum

## Utilisation de base

Le loader est automatiquement inclus dans le layout principal (`resources/views/layouts/app.blade.php`).

## Contextes disponibles

### Contexte 'general' (par défaut)
Messages adaptés aux pages générales :
- "Chargement en cours..." → "Préparation de votre espace de travail"
- "Connexion aux services..." → "Vérification de vos autorisations"
- "Chargement des données..." → "Récupération de vos informations"
- "Finalisation..." → "Presque terminé"

### Contexte 'dashboard'
Messages adaptés aux dashboards :
- "Chargement du dashboard..." → "Analyse des statistiques"
- "Connexion aux bases de données..." → "Récupération des données"
- "Traitement en cours..." → "Préparation des graphiques"
- "Finalisation..." → "Chargement terminé"

### Contexte 'reports'
Messages adaptés aux rapports :
- "Génération du rapport..." → "Collecte des données"
- "Traitement en cours..." → "Analyse des informations"
- "Formatage..." → "Préparation de l'affichage"
- "Finalisation..." → "Rapport prêt"

## Utilisation dans les vues

### Dans un contrôleur (recommandé)

```php
public function dashboard()
{
    return view('dashboard.index', [
        'loaderContext' => 'dashboard'
    ]);
}
```

### Directement dans une vue Blade

```blade
@extends('layouts.app', ['loaderContext' => 'reports'])

@section('content')
    <!-- Votre contenu -->
@endsection
```

## Désactivation du loader

Pour désactiver le loader sur une page spécifique :

```php
public function quickPage()
{
    return view('quick.index', [
        'disableGlobalLoader' => true
    ]);
}
```

Ou dans la vue :

```blade
@extends('layouts.app', ['disableGlobalLoader' => true])
```

## Personnalisation

### Ajouter un nouveau contexte

Modifiez le composant `resources/views/components/global-loader.blade.php` :

```php
$messages = [
    'mon_contexte' => [
        ['Message 1', 'Sous-message 1'],
        ['Message 2', 'Sous-message 2'],
        ['Message 3', 'Sous-message 3'],
        ['Message 4', 'Sous-message 4']
    ]
];
```

### Modifier l'apparence

Le loader utilise Tailwind CSS. Modifiez les classes dans le composant pour personnaliser :
- Couleurs du gradient
- Taille et style du logo
- Animations
- Typographie

## Structure du composant

```
resources/views/components/global-loader.blade.php
├── Logo et branding
├── Animation de chargement (double spinner)
├── Messages dynamiques
├── Barre de progression
├── Styles CSS personnalisés
└── Script JavaScript
```

## Performance

- **Cache automatique** : Le loader disparaît après 5 secondes maximum
- **Animations fluides** : Utilise CSS transitions et transforms
- **Responsive** : S'adapte aux écrans mobiles
- **Non-bloquant** : N'interfère pas avec le chargement du contenu

## Exemples d'utilisation

### Dashboard Province
```php
// Dans ProvinceDashboardController
return view('dashboard.province', compact('data'), [
    'loaderContext' => 'dashboard'
]);
```

### Page de rapports
```blade
@extends('layouts.app', ['loaderContext' => 'reports'])
```

### Page rapide (sans loader)
```blade
@extends('layouts.app', ['disableGlobalLoader' => true])
```