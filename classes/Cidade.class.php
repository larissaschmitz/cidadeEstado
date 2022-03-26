<?php
    class Cidade{
        private $cidId;
        private $cidNome;
        private $estado_estId;
        
        public function __construct($id, $cid, $est){ 
            $this->cidId = $id;
            $this->cidNome = $cid;
            $this->estado_estId = $est;
        }

        public function __toString(){
            $str = "Id: ".$this->cidId."<br>Cidade: ".$this->cidNome."<br>Estado: ".$this->estado_estId;
            
            return $str;
        }

        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO cidade (cidNome, estado_estId) VALUES(:cidNome, :estado_estId)');
            $stmt->bindParam(':cidNome', $this->cidNome, PDO::PARAM_STR);
            $stmt->bindParam(':estado_estId', $this->estado_estId, PDO::PARAM_STR);
    
            return $stmt->execute();
            
        }
        
       
}

?>