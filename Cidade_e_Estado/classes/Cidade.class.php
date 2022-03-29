<?php
    class Cidade{
        private $IdCidade;
        private $NomeCidade;
        private $estado_IdEstado;
        
        public function __construct($id, $cid, $est){ 
            $this->IdCidade = $id;
            $this->NomeCidade = $cid;
            $this->estado_IdEstado = $est;
        }

        public function __toString(){
            $str = "Id: ".$this->IdCidade."<br>Cidade: ".$this->NomeCidade."<br>Estado: ".$this->estado_IdEstado;
            
            return $str;
        }

        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO cidade (NomeCidade, estado_IdEstado) VALUES(:NomeCidade, :estado_IdEstado)');
            $stmt->bindParam(':NomeCidade', $this->NomeCidade, PDO::PARAM_STR);
            $stmt->bindParam(':estado_IdEstado', $this->estado_IdEstado, PDO::PARAM_STR);
    
            return $stmt->execute();
            
        }

        function excluir($IdCidade){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM cidade WHERE IdCidade = :IdCidade');
            $stmt->bindParam(':IdCidade', $IdCidade);
            
            return $stmt->execute();
        }
       
}

?>