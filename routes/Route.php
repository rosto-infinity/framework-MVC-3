<?php
namespace Router;

use DataBase\Db;





class Route{
    /**
     * @var string
     */
    public $path;
    public $action;
    public $matches;
    public function __construct($path, $action){

        //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        //trim() retourne la chaîne string, après avoir supprimé les caractères 
        //invisibles en début et fin de chaîne. Si le
        //second paramètre characters est omis

        $this->path = trim($path, '/');
        $this->action = $action;

    }   
    /**
     * @param string $url
     */
    public function matches(string $url){
        //preg_replace — Rechercher et remplacer par expression rationnelle standard
        
        // preg_replace(
        //     string|array $pattern,
        //     string|array $replacement,
        //     string|array $subject,
           
        // )
        //Analyse subject pour trouver l'expression rationnelle
        // pattern et remplace les résultats par replacement.


        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

            //preg_match — Effectue une recherche de correspondance
            // avec une expression rationnelle standard

        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }
    /**
     * @param string $url
     */
    public function execute(){

        //explode — Scinde une chaîne de caractères en segments

        // explode() retourne un tableau de chaînes de caractères, chacune
        //  d'elle étant une sous-chaîne du paramètre string 
        //  extraite en utilisant le séparateur (@).

        $params = explode('@', $this->action);
        $controller = new $params[0](new Db(DB_NAME, DB_HOST, DB_USER, DB_PWD)); 
        $method = $params[1];
        // $controller->$method();
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}



//Description 
// preg_match(
//     string $pattern,
//     string $subject,
//     array &$matches = null,
//     int $flags = 0,
//     int $offset = 0
// ): int|false
//Analyse subject pour trouver l'expression qui correspond à pattern.

//Liste de paramètres 
        //pattern
// Le masque à chercher, sous la forme d'une chaîne de caractères.

       //subject
// La chaîne d'entrée.

           //matches
// Si matches est fourni, il sera rempli par 
// les résultats de la recherche. $matches[0]
//  contiendra le texte qui satisfait le masque complet,
//   $matches[1] contiendra le texte qui satisfait 
//   la première parenthèse capturante, etc.