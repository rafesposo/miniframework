<?php

namespace Application\models;

use Application\core\Database;
use PDO;

class Users
{
  /** Poderiamos ter atributos aqui */

  /**
   * Este método busca todos os usuários armazenados na base de dados
   *
   * @return   array
   */
  public static function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM users');
    return $result->fetchAll(PDO::FETCH_CLASS);
  }

  /**
   * Este método busca um usuário armazenados na base de dados com um
   * determinado ID
   * @param    int     $id   Identificador único do usuário
   *
   * @return   array
   */
  public static function findById(int $id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM users WHERE id = :ID LIMIT 1', [':ID' => $id]);

    return $result->fetchAll(PDO::FETCH_CLASS)[0];
  }


  /**
   * Este método insere um usuário na base de dados
   * @param    array      $data   Dados do usuário
   * @return   int        ID do usuário inserido
   */
  public static function create($data)
  {
    if (empty($data['name'])) {
      return false;
    }
    $conn = new Database();
    $result = $conn->executeQuery('INSERT INTO users (name) VALUES (:name)', [
      ':name' => $data['name']
    ]);

    return $result->rowCount();
  }

  /**
   * Este método exclui um usuário armazenados na base de dados com um
   * determinado ID
   * @param    int     $id   Identificador único do usuário
   *
   * @return   bool
   */
  public static function delete(int $id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('DELETE FROM users WHERE id = :ID', [':ID' => $id]);
    if ($result->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
