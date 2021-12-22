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

    /**
     * Constructor de la clase
     */
    public function __construct() {
        $this->engine  = IS_LOCAL ? LDB_ENGINE : DB_ENGINE;
        $this->host    = IS_LOCAL ? LDB_HOST : DB_HOST;
        $this->name    = IS_LOCAL ? LDB_NAME : DB_NAME;
        $this->user    = IS_LOCAL ? LDB_USER : DB_USER;
        $this->pass    = IS_LOCAL ? LDB_PASS : DB_PASS;
        $this->charset = IS_LOCAL ? LDB_CHARSET : DB_CHARSET;
        return $this;
    }

    /**
   * Método para abrir una conexión a la base de datos
   *
   * return mixed
   */
    private function connect() {
        try {
            $this->link = new PDO($this->engine.':host='.$this->host.';dbname='.$this->name.';charset='.$this->charset, $this->user, $this->pass);
            return $this->link;
        } catch (PDOException $e) {
            die('No hay conexión a la base de datos, hubo un error: %s'.$e->getMessage());
        }
    }

    /**
     * Método para hacer un query a la base de datos
     * 
     * @param string $sql
     * @param array $params
     * @return void
     */
    public static function query($sql, $params = []) {
        $db = new self();
        $link = $db->connect(); // Nuestra conexion a la db
        $link->beginTransaction(); // Iniciamos una transaccion, si falla hacemos un rollback
        $query = $link->prepare($sql);

        // Manejando errores en el query o peticion
        // Qery usando placeholders
            // SELECT * FROM usuarios WHERE id=? AND nombre=?;
            // if(!$query->execute(['id' => 123, 'name' => 'Juan'])) {...
            // SELECT * FROM usuarios WHERE id=:cualrquier AND name=:nombre;
        if(!$query->execute($params)) {

            $link->rollBack(); // Si hay un error hacemos un rollback
            $error = $query->errorInfo();
            // index 0 es el tipo de error
            // index 1 es el codigo de error
            // index 2 es el mensaje de error
            throw new Exception($error[2]);
        }

        // SELECT / INSERT / UPDATE / DELETE /ALTER TABLE
        // Manejando el tipo de query
        // SELEC * FROM users;
        if(strpos($sql, 'SELECT') !== false) {

            return $query->rowCount() > 0 ? $query->fetchAll() : false; // No hay resultados

        } elseif(strpos($sql, 'INSERT') !== false) {

            $id = $link->lastInsertId(); // Almacenamos el ultimo Id con la variable $id
            $link->commit(); // Guardamos los cambios con commit
            return $id;

        } elseif(strpos($sql, 'UPDATE') !== false) {

            $link->commit();
            return true;

        } elseif(strpos($sql, 'DELETE') !== false) {

            if($query->rowCount() > 0) {
                $link->commit();
                return true;
            }

            $link->rollBack();
            return false; // Nada ha sido borrado

        } else {
            // ALTER TABLE / DROP TABLE ...
            $link->commit();
            return true;
        }
    }
}