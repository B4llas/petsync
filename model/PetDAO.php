<?php

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/Pet.php';

class PetDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getConexao();
    }

    // C - Create (Cadastrar novo pet vinculado ao tutor)
    public function criar(Pet $pet) {
        $sql = "INSERT INTO PET (nome, especie, raca, data_nascimento, peso_atual, foto, id_usuario) 
                VALUES (:nome, :especie, :raca, :data_nascimento, :peso_atual, :foto, :id_usuario)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome'            => $pet->getNome(),
            ':especie'         => $pet->getEspecie(),
            ':raca'            => $pet->getRaca(),
            ':data_nascimento' => $pet->getDataNascimento() ?: null,
            ':peso_atual'      => $pet->getPesoAtual(),
            ':foto'            => $pet->getFoto(),
            ':id_usuario'      => $pet->getIdUsuario()
        ]);
    }

    // R - Read (Listar pets trazendo o nome do tutor com INNER JOIN)
    public function listarTodos() {
        $sql = "SELECT p.*, u.nome AS nome_tutor 
                FROM PET p 
                INNER JOIN USUARIO u ON p.id_usuario = u.id_usuario 
                ORDER BY p.id_pet DESC";
        $stmt = $this->pdo->query($sql);
        $lista = [];

        foreach ($stmt->fetchAll() as $linha) {
            $lista[] = new Pet(
                $linha['nome'],
                $linha['especie'],
                $linha['raca'],
                $linha['data_nascimento'],
                $linha['peso_atual'] !== null ? (float) $linha['peso_atual'] : null,
                $linha['foto'],
                (int) $linha['id_usuario'],
                (int) $linha['id_pet'],
                $linha['nome_tutor']
            );
        }
        return $lista;
    }

    // R - Read (Buscar um pet específico por ID)
    public function buscarPorId($id) {
        $sql = "SELECT p.*, u.nome AS nome_tutor 
                FROM PET p 
                INNER JOIN USUARIO u ON p.id_usuario = u.id_usuario 
                WHERE p.id_pet = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $linha = $stmt->fetch();

        if (!$linha) {
            return null;
        }

        return new Pet(
            $linha['nome'],
            $linha['especie'],
            $linha['raca'],
            $linha['data_nascimento'],
            $linha['peso_atual'] !== null ? (float) $linha['peso_atual'] : null,
            $linha['foto'],
            (int) $linha['id_usuario'],
            (int) $linha['id_pet'],
            $linha['nome_tutor']
        );
    }

    // U - Update (Atualizar dados do pet)
    public function atualizar(Pet $pet) {
        $sql = "UPDATE PET 
                SET nome = :nome, especie = :especie, raca = :raca, 
                    data_nascimento = :data_nascimento, peso_atual = :peso_atual, 
                    foto = :foto, id_usuario = :id_usuario 
                WHERE id_pet = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome'            => $pet->getNome(),
            ':especie'         => $pet->getEspecie(),
            ':raca'            => $pet->getRaca(),
            ':data_nascimento' => $pet->getDataNascimento() ?: null,
            ':peso_atual'      => $pet->getPesoAtual(),
            ':foto'            => $pet->getFoto(),
            ':id_usuario'      => $pet->getIdUsuario(),
            ':id'              => $pet->getIdPet()
        ]);
    }

    // D - Delete (Remover pet)
    public function deletar($id) {
        $sql = "DELETE FROM PET WHERE id_pet = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}