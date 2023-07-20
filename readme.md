# Que suis-je ?

Ce plugin crée un nouveau ServiceProvider, qui sera ajouté à `config/app.php`, puis créer une facade qui permet une écriture simplifié dans le code 
`Flash::function()` mais aussi de personnalisé l'alias pour utiliser dans les vues. 

# Installation

```
composer require jolimardi/laravel-flash
```

Puis ajouter le provider dans `config/app.php` (à tester, normalement pas nécessaire) :
```
'providers' => ServiceProvider::defaultProviders()->merge([
    ...        
    JoliMardi\Flash\FlashServiceProvider::class,
])->toArray(),
```

Puis toujours dans `config/app.php`, ajouter l'alias personnalisé : 
```
'aliases' => Facade::defaultAliases()->merge([
        
        'MyAlias' => JoliMardi\Flash\Flash::class,
    ])->toArray(),
```
Note : Ne pas utiliser Flash en tant qu'alias, conflit avec la facade Laracast/Flash/Flash lors de l'utilisation dans une vue.

# Usage

## Utilisation
```
use JoliMardi\Flash\Flash;

public function test() {
    Flash::message('success', 'Ceci est un message de type success');

    Flash::success('Ceci est un message de succès');

    Flash::error('Ceci est un autre message d\'erreur');

    Flash::notice('Ceci est un message de notification');

    if (Flash::has('message')) {
       ...
    }
    if (Flash::has()) { // Pour vérifier si n'importe quel message existe
        ...
    } 

    $messages = Flash::getMessages();

    Flash::clear('error'); // Clear les message d'erreur
    Flash::clear(); // Clear tout les messages

    $messageOutput = Flash::output(); // Renvoi une string HTML
}
```

## Component
Ajouter le component `<x-flash-messages />` dans un template blade, là où vous voulez afficher les messages.

## Editer l'affichage des flash messages


## TODO 
- Ajouter un publish pour founir un composant blade flash-messages