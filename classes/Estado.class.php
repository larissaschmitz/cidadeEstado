<?php
    class Estado{
        private $estId;
        private $estNome;
        private $estSigla;
        
        public function __construct($id, $est, $sig){
            
            $this->estId = $id;
            $this->estNome = $est;
            $this->estSigla = $sig;
        }

        public function __toString(){
            $str = "Id: ".$this->estId."<br>Estado: ".$this->estNome."<br>Sigla: ".$this->estSigla;
            
            return $str;
        }
        
        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO estado (estNome, estSigla) VALUES(:estNome, :estSigla)');
            $stmt->bindParam(':estNome', $this->estNome, PDO::PARAM_STR);
            $stmt->bindParam(':estSigla', $this->estSigla, PDO::PARAM_STR);
    
            return $stmt->execute();
            
        }
        

        function excluir($estId){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM estado WHERE estId = :estId');
            $stmt->bindParam(':estId', $estId);
            
            return $stmt->execute();
        }
      
    }



?>