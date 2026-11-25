<?php

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/Usuario.php';

class UsuarioDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getConexao();
    }

    // C - Create (Cadastrar novo tutor)
    public function criar(Usuario $usuario) {
        $sql = "INSERT INTO USUARIO (nome, email, senha_hash, telefone, metodo_autenticacao) 
                VALUES (:nome, :email, :senha_hash, :telefone, :metodo)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome'       => $usuario->getNome(),
            ':email'      => $usuario->getEmail(),
            ':senha_hash' => $usuario->getSenhaHash(),
            ':telefone'   => $usuario->getTelefone(),
            ':metodo'     => $usuario->getMetodoAutenticacao()
        ]);
    }

    // R - Read (Listar todos os tutores)
    public function listarTodos() {
        $sql = "SELECT * FROM USUARIO ORDER BY id_usuario DESC";
        $stmt = $this->pdo->query($sql);
        $lista = [];

        foreach ($stmt->fetchAll() as $linha) {
            $lista[] = new Usuario(
                $linha['nome'],
                $linha['email'],
                $linha['senha_hash'],
                $linha['telefone'],
                $linha['metodo_autenticacao'] ?? 'local',
                $linha['id_provedor_externo'],
                (int) $linha['id_usuario']
            );
        }
        return $lista;
    }

    // R - Read (Buscar tutor por ID)
    public function buscarPorId($id) {
        $sql = "SELECT * FROM USUARIO WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $linha = $stmt->fetch();

        if (!$linha) {
            return null;
        }

        return new Usuario(
            $linha['nome'],
            $linha['email'],
            $linha['senha_hash'],
            $linha['telefone'],
            $linha['metodo_autenticacao'] ?? 'local',
            $linha['id_provedor_externo'],
            (int) $linha['id_usuario']
        );
    }

    // U - Update (Atualizar dados do tutor)
    public function atualizar(Usuario $usuario) {
        $sql = "UPDATE USUARIO 
                SET nome = :nome, email = :email, telefone = :telefone 
                WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome'     => $usuario->getNome(),
            ':email'    => $usuario->getEmail(),
            ':telefone' => $usuario->getTelefone(),
            ':id'       => $usuario->getIdUsuario()
        ]);
    }

    // D - Delete (Excluir tutor - apaga pets em cascata pelo banco)
    public function deletar($id) {
        $sql = "DELETE FROM USUARIO WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}