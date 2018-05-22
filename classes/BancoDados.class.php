<?php

	class BancoDados
	{
		private static $instance = null;
		private $conn;

		private function __construct()
		{
			try
			{
				$this->conn = new PDO('mysql:host='.Config::DB_URL.';dbname='.Config::DB_NAME, Config::DB_USER, Config::DB_PASS);
			}
			catch(PDOException $e)
			{
				echo 'erro';
				$this->conn = NULL;
			}
		}

		public static function getInstance()
		{
			if(!self::$instance)
				self::$instance = new BancoDados();

			return self::$instance;
		}

		public function getConnection()
		{
			return $this->conn;
		}

		public function closeConnection()
		{
			$this->conn = null;
			self::$instance = null;
		}
	}

?>