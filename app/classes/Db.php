<?php
// Conexion a la base de datos
class Db {
    private $link;
    private $engine;
    private $host;
    private $name;
    private $user;
    private $pass;
    private $charset;
    private $options;

    // Constructor para clase

    public function __construct() {
        $this->engine  = IS_LOCAL ? LDB_ENGINE : DB_ENGINE;
        $this->name    = IS_LOCAL ? LDB_NAME : DB_NAME;
        $this->user    = IS_LOCAL ? LDB_USER : DB_USER;
        $this->pass    = IS_LOCAL ? LDB_PASS : DB_PASS;
        $this->charset = IS_LOCAL ? LDB_CHARSET : DB_CHARSET;
        $this->host    = IS_LOCAL ? LDB_HOST : DB_HOST;
        $this->options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            return $this;
    }

    /**
   * Método para abrir una conexión a la base de datos
   *
   * return mixed
   */

    private function connect() {
        try {
            $this->link = new PDO($this->engine.':host='.$this->host.';dbname='.$this->name.';charset='.$this->charset, $this->user, $this->pass, $this->options);
            return $this->link;
        } catch (PDOException $e) {
            die(sprintf('No  hay conexión a la base de datos, hubo un error: %s', $e->getMessage()));
        }
    }

    public static function query($sql, $params = []) {
        $db = new self();
        $link = $db->connect();
        $link->beginTransaction();
        $query = $link->prepare($sql);
    }
}