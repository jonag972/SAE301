<?php
// Créer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}
class config {
    static private array $databases = array(
    // Paramètres de configuration de la base de données
    'hostname' => 'localhost',
    'database' => 'SAE301',
    'login' => 'root',
    'password' => ''
    );
    static public function getLogin() : string {
        return static::$databases['login'];
    }
    static public function getHostname() : string{
        return static::$databases['hostname'];
    }
    static public function getDatabase() : string{
        return static::$databases['database'];
    }
    static public function getPassword() : string{
        return static::$databases['password'];
    }
}
?>