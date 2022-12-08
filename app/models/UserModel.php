<?php

class UserModel {

    // ATRIBUTS
    private $_jsonFile = ROOT_PATH . ("/db/users.json"); 

    public $_arrUsers;

    public $_fields = array(
        'id_user' => '0',
        'strCreatedAt' => '',
        'name' => '',
        'cog'  => '',
        'rol'  => '',
        'deleted' => '0'
    );

    // CONSTRUCTOR      
    public function __construct($arrFields){
        
        if (!file_exists(ROOT_PATH . "/db/users.json")){
            $this->_jsonFile = file_put_contents(ROOT_PATH . "/db/users.json","[]");
        }
        // file_get: llegeix Fitxer txt (retorna text, en aquest cas format json)
        $jsnUsers = file_get_contents($this->_jsonFile);
        // json_decode:  converteix un JSON string, en un ARRAY
        $arrUsers = json_decode($jsnUsers, true);             
        // ens guardem en State la llista d'users
        $this->_arrUsers = $arrUsers;

        // ens guardem en State l'usuari actual que ha entrat
        $this->_fields=array(
            'id_user' => $this->getMaxId(),
            'createdAt' => date("Y-m-d H:i:s"),
            'name' => $arrFields['nom'],
            'rol'  => $arrFields['rol'],
            'deleted' => '0'
        );  
        // echo "en UserModel::__construct() ... var_dump de this->_fields:<br>";
        // var_dump($this->_fields);
    }

    // GETTERS-SETTERS
    public function getFields(){
        return $this->_fields;
    }

    // METODES ESPECIFICS de Classe:
    public function exists($nom){
        // DEBUG:
        // echo "<br>function exists -> $ nom = " . $nom ."<br>";
        $match = false;
        foreach ($this->_arrUsers as $user) {
            // echo "var_dump de $ user : " . var_dump($user) . "<br>";
            if ($user['name'] == $nom) {
                $match = true;
            }
        }
        // DEBUG:
        // echo "match: " . $match;
        return $match;
    }

    public function saveJson($arrUsers, array $singleUser){
        $result = false;
        if (!empty($singleUser)){      
            // afegim al STATE dels Atributs, pero encara és VOLATIL
            array_push($arrUsers, $singleUser); 
            // json_encode:  converteix un ARRAY en un JSON string
            $jsnUsers = json_encode($arrUsers);
            // file_put: graba en Fitxer txt
            $result = file_put_contents($this->_jsonFile,$jsnUsers);
            // tot lo d'abans però en una fila:
            // $result = file_put_contents($this->_jsonFile, json_encode($arrUsers));
        }
        return $result? true : false;                
    }

    private function getMaxId(){
        $maxId = count($this->_arrUsers)+1; 
        // DEBUG:
        // echo "<br> UserModel->getMaxId...maxId: " . $maxId . "<br>";
        return $maxId;       
    }

    // implementamos aquí el DELETE a JSON (un recycle nos permite recuperarlo, todavia no Delete total)
    public function recycle($data,$status){
        // cambia el ESTADO de los Atributos, pero es VOLATIL
        $this->setDeleted($status);        
        // cambia en FICHERO su contenido, PERSISTENCIA de datos
        json_encode($data);
        file_put_contents("../db/users.json",$data);
    }

}

?>