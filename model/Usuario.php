<?php

class Usuario {
    private $idUsuario;
    private $nome;
    private $email;
    private $senhaHash;
    private $telefone;
    private $metodoAutenticacao;
    private $idProvedorExterno;

    public function __construct(
        $nome = '',
        $email = '',$senhaHash = '',
        $telefone = null,$metodoAutenticacao = 'local',
        $idProvedorExterno = null,$idUsuario = null
    ) {
        $this->idUsuario =$idUsuario;
        $this->nome =$nome;
        $this->email =$email;
        $this->senhaHash =$senhaHash;
        $this->telefone =$telefone;
        $this->metodoAutenticacao =$metodoAutenticacao;
        $this->idProvedorExterno =$idProvedorExterno;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario =$idUsuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome =$nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email =$email;
    }

    public function getSenhaHash() {
        return $this->senhaHash;
    }

    public function setSenhaHash($senhaHash) {
        $this->senhaHash =$senhaHash;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone =$telefone;
    }

    public function getMetodoAutenticacao() {
        return $this->metodoAutenticacao;
    }

    public function setMetodoAutenticacao($metodoAutenticacao) {
        $this->metodoAutenticacao =$metodoAutenticacao;
    }

    public function getIdProvedorExterno() {
        return $this->idProvedorExterno;
    }

    public function setIdProvedorExterno($idProvedorExterno) {
        $this->idProvedorExterno =$idProvedorExterno;
    }
}