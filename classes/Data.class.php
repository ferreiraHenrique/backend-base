<?php

    class Data
    {
        private static $instance;


        private function __construct(){  }

        public static function abrirConn()
        {
            self::$instance = BancoDados::getInstance();
            
            return self::$instance->getConnection();
        }

        public static function inserir($tabela, $dados, $replace=false)
        {
            $conn = self::abrirConn();

            $chaves_bd = $valores_bd = array();


            $i = 0;
            foreach($dados as $ch=>$val)
            {
                $chaves_bd['campo_'.(++$i)] = $ch;
                $valores_bd['campo_'.($i)] = $dados[$ch];
            }

            $procedure = $replace? 'REPLACE' : 'INSERT';
            $sql = $procedure." INTO ".$tabela." (".implode(', ', $chaves_bd).") VALUES (:".implode(', :', array_keys($chaves_bd)).");";

            $stmt = $conn->prepare($sql);

            foreach($valores_bd as $chave=>$valor)
                $stmt->bindValue($chave, $valor);

            try
            {
                $res = $stmt->execute();
            }
            catch(PDOException $e)
            {
                self::$instance->CloseConnection();
                $stmt = $conn = null;
                return false;
            }

            self::$instance->closeConnection();
            $stmt = $conn = null;

            return $res;
        }


        public static function selecionar($tabela, $params=false)
		{
			$conn = self::abrirConn();

			$sql = "SELECT * FROM ".$tabela;

			//WHERE
			$sql = $params['WHERE']? $sql.' '.$params['WHERE'] : $sql;

			//ORDER
			$sql = $params['ORDER']? $sql.' '.$params['ORDER'] : $sql;

			//LIMIT
			$sql = $params['LIMIT']? $sql.' '.$params['LIMIT'] : $sql;

			$stmt = $conn->prepare($sql);

			$res = $stmt->execute();
			$array_res = $stmt->fetchAll();

			self::$instance->closeConnection();
			$stmt = $conn = null;

			return $array_res;
		}
    }

?>