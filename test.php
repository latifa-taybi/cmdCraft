<?php
//--------------match
$result = match($input) {
    1 => 'Un',
    2 => 'Deux',
    default => 'Autre',
};


//-------------Améliorations des fonctions de chaîne de caractères
str_contains('Bonjour le monde', 'monde'); 
str_starts_with('Bonjour', 'Bon'); 
str_ends_with('test.php', '.php'); 


//--------nullsaf operator
$user = null;
echo $user?->getName(); 

//----------------attribute
#[Attribute]
class Route {
    public function __construct(public string $path) {}
}

class UserController {
    #[Route("/user/{id}")]
    public function show(int $id) {
        // Affiche un utilisateur avec l'ID
    }
}
?>