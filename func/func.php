<?php
function listarTabela($campos, $tabela, $campoOrdem)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("SELECT $campos FROM $tabela ORDER BY $campoOrdem ");
        //        $sqlLista->bindValue(1, $campoParametro, PDO::PARAM_INT);
        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}
function ValidarSenha($campos, $tabela, $campoBdstring, $campoBdstring2, $campoParametro, $campoParametro2, $campobdativo, $valorativo)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("SELECT $campos"
            .  " FROM $tabela"
            .  " WHERE $campoBdstring = ? AND $campoBdstring2 = ? AND $campobdativo = ?");
        $sqlLista->bindValue(1, $campoParametro, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $campoParametro2, PDO::PARAM_STR);
        $sqlLista->bindValue(3, $valorativo, PDO::PARAM_STR);
        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        };
    } catch (Throwable $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}

function InsertDoisId($Campos, $tabela, $CampoValor1, $CampoValor2)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("INSERT INTO $tabela ($Campos) VALUES (?, ?)");
        $sqlLista->bindValue(1, $CampoValor1, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $CampoValor2, PDO::PARAM_STR);
        $sqlLista->execute();
        $conn->commit();
        $IdInsertRetorno = $conn->lastInsertId();
        if ($sqlLista->rowCount() > 0) {
            return $IdInsertRetorno;
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}
function InsertTresId($Campos, $tabela, $CampoValor1, $CampoValor2, $CampoValor3)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("INSERT INTO $tabela ($Campos) VALUES (?, ?, ?)");
        $sqlLista->bindValue(1, $CampoValor1, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $CampoValor2, PDO::PARAM_STR);
        $sqlLista->bindValue(3, $CampoValor3, PDO::PARAM_STR);
        $sqlLista->execute();
        $conn->commit();
        $IdInsertRetorno = $conn->lastInsertId();
        if ($sqlLista->rowCount() > 0) {
            return $IdInsertRetorno;
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}

function listarId($campos, $tabela, $campoId, $campoIdValor)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("SELECT $campos FROM $tabela WHERE $campoId = ?");
        $sqlLista->bindValue(1, $campoIdValor, PDO::PARAM_INT);
        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}
function editarTabela($Campos, $tabela, $idCampo, $idCampoValor)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("UPDATE $tabela SET $Campos WHERE $idCampo = ?");
        $sqlLista->bindValue(1, $idCampoValor, PDO::PARAM_INT);
        $sqlLista->execute();
        $conn->commit();

        if ($sqlLista->rowCount() > 0) {
            return $sqlLista -> rowCount();
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}
function deletarTabela($tabela, $idCampo, $idCampoValor)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("DELETE FROM $tabela WHERE $idCampo = ?");
        $sqlLista->bindValue(1, $idCampoValor, PDO::PARAM_STR);
        $sqlLista->execute();
        $conn->commit();
        
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->rowCount();
        } else {
            return 0;
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    };
    $conn = null;
}

function excluirCampo($tabela, $idCampo, $idCampoValor)
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlExcluir = $conn->prepare("DELETE FROM $tabela WHERE $idCampo = ?");
        $sqlExcluir->bindValue(1, $idCampoValor, PDO::PARAM_INT);
        $sqlExcluir->execute();
        $conn->commit();

        if ($sqlExcluir->rowCount() > 0) {
            return $sqlExcluir;
        } else {
            return null;
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    } finally {
        $conn = null;
    }
}

function listarTabela2($campos, $tabela, $campoOrdem, $condicao = "")
{
    $conn = conectar();
    try {
        $conn->beginTransaction();
        $sqlLista = $conn->prepare("SELECT $campos FROM $tabela $condicao ORDER BY $campoOrdem");
        $sqlLista->execute();
        $conn->commit();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        };
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return ($e->getMessage());
        $conn->rollback();
    }
    $conn = null;
}


// Função para inserir um registro em uma tabela usando PDO
function inserirRegistro($tabela, $dados) {
    $conexao = conectar();
    
    // Construir a lista de colunas
    $colunas = implode(', ', array_keys($dados));
    
    // Montar os parâmetros da consulta preparada
    $parametros = ':' . implode(', :', array_keys($dados));
    
    try {
        // Preparar a query SQL
        $sql = "INSERT INTO $tabela ($colunas) VALUES ($parametros)";
        $stmt = $conexao->prepare($sql);
        
        // Executar a query
        $stmt->execute($dados);
        
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

// Função para atualizar um registro em uma tabela usando PDO
function atualizarRegistro($tabela, $coluna, $valor, $condicao_coluna, $condicao_valor) {
    $conexao = conectar();
    
    try {
        // Preparar a query SQL
        $sql = "UPDATE $tabela SET $coluna = :valor WHERE $condicao_coluna = :condicao_valor";
        $stmt = $conexao->prepare($sql);
        
        // Bind dos parâmetros da consulta preparada
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':condicao_valor', $condicao_valor);
        
        // Executar a query
        $stmt->execute();
        
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

// Função para buscar um registro em uma tabela usando PDO
function buscarRegistro($tabela, $condicao_coluna, $condicao_valor) {
    $conexao = conectar();
    
    try {
        // Preparar a query SQL
        $sql = "SELECT * FROM $tabela WHERE $condicao_coluna = :condicao_valor";
        $stmt = $conexao->prepare($sql);
        
        // Bind do parâmetro da consulta preparada
        $stmt->bindParam(':condicao_valor', $condicao_valor);
        
        // Executar a query
        $stmt->execute();
        
        // Verificar se algum registro foi encontrado
        if ($stmt->rowCount() > 0) {
            // Retornar o primeiro registro encontrado como objeto
            return $stmt->fetch(PDO::FETCH_OBJ);
        } else {
            // Se nenhum registro for encontrado, retornar falso
            return false;
        }
    } catch(PDOException $e) {
        return false;
    }
}
?>
