<?php

use Application\core\Controller;

class User extends Controller
{
  /**
   * chama a view index.php da seguinte forma /user/index   ou somente   /user
   * e retorna para a view todos os usuários no banco de dados.
   */
  public function index()
  {
    $Users = $this->model('Users'); // é retornado o model Users()
    $data = $Users::findAll();
    $this->view('user/index', ['users' => $data]);
  }

  /**
   * chama a view show.php da seguinte forma /user/show passando um parâmetro 
   * via URL /user/show/id e é retornado um array contendo (ou não) um determinado
   * usuário. Além disso é verificado se foi passado ou não um id pela url, caso
   * não seja informado, é chamado a view de página não encontrada.
   * @param  int   $id   Identificado do usuário.
   */
  public function show($id = null)
  {
    if (is_numeric($id)) {
      $model = $this->model('Users');
      $user = $model::findById($id);
      if (!$user) {
        return $this->pageNotFound();
      }
      return $this->view('user/show', ['user' => $user, 'id' => $id]);
    } else {
      $this->pageNotFound();
    }
  }

  public function delete($id)
  {
    if (is_numeric($id)) {
      $model = $this->model('Users');
      $user = $model::delete($id);
      if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'Não foi possível excluir o usuário.']);
      } else {
        echo json_encode(['status' => 'success', 'message' => 'Usuário excluído com sucesso.']);
      }
      return;
    }
  }

  public function create()
  {
    $data = $_POST;
    $model = $this->model('Users');
    $user = $model::create($data);
    if (!$user) {
      echo json_encode(['status' => 'error', 'message' => 'Não foi possível criar o usuário.']);
    } else {
      echo json_encode(['status' => 'success', 'message' => 'Usuário criado com sucesso.']);
    }
    return;
  }
}
