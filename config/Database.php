<?php
// Protection contre double inclusion
if (!class_exists('Database')) {

    class Database
    {
        private string $host = "localhost";
        private string $dbname = "stampee";
        private string $username = "root";
        private string $password = "";

        private static ?Database $instance = null;
        private static ?PDO $conn = null;

        public PDO $pdo;

        /**
         * Retourne l'instance unique de la classe Database
         */
        public static function getInstance(): PDO
        {
            if (self::$instance === null) {
                self::$instance = new Database();
            }
            return self::$instance->getConnection();
        }

        /**
         * Retourne la connexion PDO
         */
        public function getConnection(): PDO
        {
            if (!self::$conn) {
                try {
                    self::$conn = new PDO(
                        "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                        $this->username,
                        $this->password
                    );
                    self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Erreur de connexion à la base : " . $e->getMessage());
                }
            }
            return self::$conn;
        }

        /**
         * Constructeur privé pour forcer l'utilisation de getInstance()
         */
        private function __construct()
        {
            $this->pdo = $this->getConnection();
        }

        /**
         * Empêche la copie de l'instance
         */
        private function __clone() {}

        /**
         * Empêche la désérialisation
         */
        public function __wakeup()
        {
            throw new \Exception("Cannot unserialize singleton");
        }
    }
}
