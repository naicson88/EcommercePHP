<?php 
	require_once 'Endereco.php';

    class Usuario extends Endereco {
    private $id;
    private $nomeUsuario;
	private $sobrenome;
	private $email;
    private $password;
    private $role;
     
    /*public function __construct($nomeUsuario, $password, $role, $id) {
        $this->nomeUsuario = $nomeUsuario;
        $this->password = $password;
        $this->role = $role;
    }*/

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNomeUsuario(){
		return $this->nomeUsuario;
	}

	public function setNomeUsuario($nomeUsuario){
		$this->nomeUsuario = $nomeUsuario;
	}

	public function getSobrenome(){
		return $this->sobrenome;
	}

	public function setSobrenome($sobrenome){
		$this->sobrenome = $sobrenome;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getRole(){
		return $this->role;
	}

	public function setRole($role){
		$this->role = $role;
	}

    }
?>