<?php

class Contas extends Conexao {
// Método para listar contas
	public function listAccounts() {
		$pdo = parent::get_instance();
		$sql = "SELECT * FROM contas ORDER BY id ASC";
		$sql = $pdo->prepare($sql);
		$sql->execute();

		if($sql->rowCount () > 0) {
			return $sql->fetchAll();
		}
	}
		// Método para pegar informações de cada conta
	public function getInfo($id) {
		$pdo = parent::get_instance();
		$sql = "SELECT * FROM contas WHERE id = :id";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount () > 0) {
			return $sql->fetchAll();
		}
	}


		// Método para fazer login
	public function setLogged($agencia, $conta, $senha) {
		$pdo = parent::get_instance ();
		$sql = "SELECT * FROM contas WHERE agencia = :agencia AND conta =  :conta AND senha = :senha";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":agencia", $agencia);
		$sql->bindValue(":conta", $conta);
		$sql->bindValue(":senha", $senha);
		$sql->execute();

// Esse código abaixo serve para pegar apenas 1 dado de conta
		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();

			$_SESSION['login'] = $sql['id'];

			header("Location: ../index.php?login_sucess");
			exit;

		} else {
			header("Location: ../login.php?not_login");
		}

//Método para fazer logout
		public function logout() {
			unset($_SESSION['login']);
		}

	}

}



?>