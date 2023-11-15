<?php
// Créer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}
// On inclut le fichier de la classe config pour récupérer les paramètres de configuration
require_once 'config.php';

// Déclaration de la classe database
class database {
    // Attribut privé $pdo pour stocker l'objet PDO
    private $pdo;
    // Attribut privé statique $instance pour stocker l'unique instance de la classe database
    private static $instance = null;

    private function __construct() {
        $hostname = config::getHostname();
        $databaseName = config::getDatabase();
        $login = config::getLogin();
        $password = config::getPassword();

        // Connexion à la base de données avec les options recommandées pour PDO
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->pdo = new PDO("mysql:host=$hostname;dbname=$databaseName", $login, $password, $options);

        // Activation du mode d'affichage des erreurs et du lancement d'exception en cas d'erreur
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Accesseur (getter) statique pour l'attribut $pdo
    public static function getPdo() {
        // On retourne l'objet PDO stocké dans l'unique instance de la classe database
        return static::getInstance()->pdo;
    }

    // Méthode privée statique pour obtenir l'unique instance de la classe database
    private static function getInstance() {
        // Si aucune instance n'a été créée, on en crée une nouvelle
        if (is_null(static::$instance))
            static::$instance = new database();
        // On retourne l'unique instance de la classe database
        return static::$instance;
    }

    // Méthode pour préparer et exécuter une requête SQL avec des paramètres
    public static function prepareEtExecute($query, $params = array()) {
        // On prépare la requête SQL en utilisant la méthode "prepare" de l'objet PDO stocké dans l'attribut $pdo
        $statement = self::getPdo()->prepare($query);
        // On exécute la requête SQL en utilisant la méthode "execute" de l'objet PDOStatement retourné par la méthode "prepare"
        $statement->execute($params);
        // On retourne le résultat de la requête SQL sous forme d'un tableau associatif
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function prepareExecuteBind($query, $params = array()) {
        // Préparer la requête SQL
        $stmt = self::getPdo()->prepare($query);

        // Lier les paramètres
        foreach ($params as $key => &$val) {
            $type = is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt->bindValue($key, $val, $type);
        }

        // Exécuter la requête
        $stmt->execute();

        // Retourner les résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function prepare($query) {
        // On prépare la requête SQL en utilisant la méthode "prepare" de l'objet PDO stocké dans l'attribut $pdo
        return self::getPdo()->prepare($query);
    }
}
?>
