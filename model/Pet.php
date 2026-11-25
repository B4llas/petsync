<?php

class Pet {
    private $idPet;
    private $nome;
    private $especie;
    private $raca;
    private $dataNascimento;
    private $pesoAtual;
    private $foto;
    private $idUsuario;
    private $nomeTutor;

    public function __construct(
        $nome = '',
        $especie = '',
        $raca = null,
        $dataNascimento = null,
        $pesoAtual = null,
        $foto = null,
        $idUsuario = 0,
        $idPet = null,
        $nomeTutor = null
    ) {
        $this->idPet = $idPet;
        $this->nome = $nome;
        $this->especie = $especie;
        $this->raca = $raca;
        $this->dataNascimento = $dataNascimento;
        $this->pesoAtual = $pesoAtual;
        $this->foto = $foto;
        $this->idUsuario = $idUsuario;
        $this->nomeTutor = $nomeTutor;
    }

    public function getIdPet() {
        return $this->idPet;
    }

    public function setIdPet($idPet) {
        $this->idPet = $idPet;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEspecie() {
        return $this->especie;
    }

    public function setEspecie($especie) {
        $this->especie = $especie;
    }

    public function getRaca() {
        return $this->raca;
    }

    public function setRaca($raca) {
        $this->raca = $raca;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getPesoAtual() {
        return $this->pesoAtual;
    }

    public function setPesoAtual($pesoAtual) {
        $this->pesoAtual = $pesoAtual;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getNomeTutor() {
        return $this->nomeTutor;
    }

    public function setNomeTutor($nomeTutor) {
        $this->nomeTutor = $nomeTutor;
    }
}