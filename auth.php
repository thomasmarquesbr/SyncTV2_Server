<?php
// Inclui o arquivo com o sistema de segurança
require_once("security.php");

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Salva duas variáveis com o que foi digitado no formulário
  // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
  $username = (isset($_POST['user'])) ? $_POST['user'] : '';
  $password = (isset($_POST['pass'])) ? $_POST['pass'] : '';

  // Utiliza uma função criada no seguranca.php pra validar os dados digitados
  if (validateUser($username, $password) == true) {
    // O usuário e a senha digitados foram validados, manda pra página interna
    header("Location: main.php");
  } else {
    // O usuário e/ou a senha são inválidos, manda de volta pro form de login
    // Para alterar o endereço da página de login, verifique o arquivo seguranca.php
    expelledVisitor();

    echo "
        <div ng-submit=\"showError(1)\"></div>
        ";
  }
}
