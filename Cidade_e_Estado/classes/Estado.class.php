<?php
    class Estado{
        private $IdEstado;
        private $NomeEstado;
        private $SiglaEstado;
        
        public function __construct($id, $est, $sig){
            
            $this->IdEstado = $id;
            $this->NomeEstado = $est;
            $this->SiglaEstado = $sig;
        }

        public function __toString(){
            $str = "Id: ".$this->IdEstado."<br>Estado: ".$this->NomeEstado."<br>Sigla: ".$this->SiglaEstado;
            
            return $str;
        }
        
        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO estado (NomeEstado, SiglaEstado) VALUES(:NomeEstado, :SiglaEstado)');
            $stmt->bindParam(':NomeEstado', $this->NomeEstado, PDO::PARAM_STR);
            $stmt->bindParam(':SiglaEstado', $this->SiglaEstado, PDO::PARAM_STR);
    
            return $stmt->execute();
            
        }
        

        function excluir($IdEstado){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM estado WHERE IdEstado = :IdEstado');
            $stmt->bindParam(':IdEstado', $IdEstado);
            
            return $stmt->execute();
        }
      
    }



?>