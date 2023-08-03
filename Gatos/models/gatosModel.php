<?php

    class Gato{
        private $conn;
        private $table = 'gatos';

        //Propiedades
        public $id;
        public $nombre;
        public $raza;
        public $edad;
        public $foto;


        //Constructor de nuestra clase
        public function __construct($db){
            $this->conn = $db;
        }


        //Obtener los gatos
        public function leer(){
            //Crear query
            $query = 'SELECT id, nombre, raza, edad,foto FROM '. $this->table;

            //Preparar sentencia
            $stmt = $this->conn->prepare($query);

            //Ejecutar query
            $stmt->execute();
            $gatos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $gatos;
        }

        //Obtener gato individual
        public function leer_individual($id){
            //Crear query
            $query = 'SELECT id, nombre, raza, edad,foto FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';

            //Preparar sentencia
            $stmt = $this->conn->prepare($query);

            //Vincular parámetro
            $stmt->bindParam(1, $id);

            //Ejecutar query
            $stmt->execute();
            $gatos = $stmt->fetch(PDO::FETCH_OBJ);
            return $gatos;
        }

        //Crear un gato
        public function crear($nombre){
            //Crear query
            $query = 'INSERT INTO ' . $this->table . ' (nombre)VALUES(:nombre)';

            //Preparar sentencia
            $stmt = $this->conn->prepare($query);

            //Vincular parámetro
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);


            //Ejecutar query
            if ($stmt->execute()) {
                return true;
            }

            //Si hay error 
            printf("error $s\n", $stmt->error);

        }

        //Crear un artículo
        public function actualizar($id,$nombre, $raza, $edad, $newImageName){
            
            if ($newImageName == "") {
               //Crear query
                $query = 'UPDATE ' . $this->table . ' SET nombre = :nombre,raza = :raza, edad = :edad WHERE id = :id';

                //Preparar sentencia
                $stmt = $this->conn->prepare($query);

                //Vincular parámetro
                 $stmt->bindParam(":nombre", $titulo, PDO::PARAM_STR);  
                $stmt->bindParam(":raza", $titulo, PDO::PARAM_STR);               
                $stmt->bindParam(":edad", $edad, PDO::PARAM_INT);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                //Ejecutar query
                if ($stmt->execute()) {
                    return true;
                }
            }else{
                //Crear query
                $query = 'UPDATE ' . $this->table . ' SET nombre = :nombre, raza = :raza, edad=:edad,foto = :foto WHERE id = :id';

                //Preparar sentencia
                $stmt = $this->conn->prepare($query);

                //Vincular parámetro
                $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);               
                $stmt->bindParam(":raza", $raza, PDO::PARAM_STR);
                $stmt->bindParam(":edad", $edad, PDO::PARAM_INT);
                $stmt->bindParam(":foto", $newImageName, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                //Ejecutar query
                if ($stmt->execute()) {
                    return true;
                }
            }            

            //Si hay error 
            printf("error $s\n", $stmt->error);

        }

        //Crear un artículo
        public function borrar($id){
            //Crear query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            //Preparar sentencia
            $stmt = $this->conn->prepare($query);

            //Vincular parámetro
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);         

            //Ejecutar query
            if ($stmt->execute()) {
                return true;
            }

            //Si hay error 
            printf("error $s\n", $stmt->error);

        }

    }