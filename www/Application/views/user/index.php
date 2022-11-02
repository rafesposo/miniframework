<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Simple Framework</title>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>

<body>

  <main>
    <div class="container">
      <div class="row">
        <div class="col-8 offset-2" style="margin-top:100px">
          <h2>
            USERS
            <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="modal" data-target="#formModal">
              + NEW USER
            </button>
          </h2>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Remove</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user) : ?>
                <tr>
                  <td><?= $user->id ?></td>
                  <td><?= $user->name ?></td>
                  <td>
                    <button class="btn btn-primary" type="button" onclick="remove(<?= $user->id; ?>)">
                      Remove
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Add new user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
            </div>
            <input type="text" id="name" name="name" class="form-control" aria-label="Name" aria-describedby="inputGroup-sizing-sm">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="create()" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script>
    function remove(id) {
      if (confirm('Deseja realmente excluir?')) {
        $.ajax({
          url: '/user/delete/' + id,
          type: 'DELETE',
          dataType: 'json',
          success: function(result) {
            if (result.status == 'success') {
              alert(result.message);
              window.location.reload();
            } else {
              alert(result.message);
            }
          }
        });
      }
    }

    function create() {
      $.ajax({
        url: '/user/create',
        type: 'POST',
        dataType: 'json',
        data: {
          name: $('#name').val()
        },
        success: function(result) {
          if (result.status == 'success') {
            alert(result.message);
            window.location.reload();
          } else {
            alert(result.message);
          }
        }
      });
    }
  </script>

</body>

</html>