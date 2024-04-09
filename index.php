<?php
include('conexao.php');

if(isset($_POST['email']) && isset($_POST['senha'])){

    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $sql_query = $mysqli->query($sql_code) or die('Falha na execução do código SQL: ' . $mysqli->error);

    $quantidade = $sql_query->num_rows;

    if($quantidade == 1) {
        
        $usuario = $sql_query->fetch_assoc();

        if(!isset($_SESSION)){
            session_start();
        }

        $_SESSION['user'] = $usuario['id'];
        $_SESSION['name'] = $usuario['nome'];

        header("Location: painel.php");


    } else {
        echo "Falha ao logar!";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Login</title>

  <link
    rel="shortcut icon"
    href="./img/lion-8665331_1280.png"
    sizes="40x40"
    type="imag.png"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
</head>
<body>
    <form action="" method="POST">
  <div class="card col-5 m-auto mt-5">
    <div class="card-header">
      Entrar
    </div>
    <div class="card-body">
      <form id="loginForm">
        <div class="form-group">
          <label for="exampleInputEmail1">Endereço de email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Digite o email">
          <small id="emailHelp" class="form-text text-muted">Nós nunca compartilharemos seu email com ninguém.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Senha</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="senha" placeholder="Senha">
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Lembrar de mim</label>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </div>
  </form>

  
</body>
</html>
