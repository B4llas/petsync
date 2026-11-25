<?php

class Conexao {
    private static $instancia = null;

    private function __construct() {}

    public static function getConexao() {
        if (self::$instancia === null) {
            $host = 'localhost';$banco = 'PetSync_teste';
            $usuario = 'root';$senha = 'M@n0B@ll@s29092008'; // No XAMPP padrão a senha é vazia

            try {
                self::$instancia = new PDO(
                    "mysql:host=$host;dbname=$banco;charset=utf8mb4",
                    $usuario,$senha
                );
                self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instancia->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Erro ao conectar no banco de dados: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}