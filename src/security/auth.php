<?php
// Inclui o arquivo com o sistema de segurança
require_once("security.php");

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Salva duas variáveis com o que foi digitado no formulário
  // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
  $username = (isset($_POST['username'])) ? $_POST['username'] : '';
  $password = (isset($_POST['password'])) ? $_POST['password'] : '';

  // Utiliza uma função criada no seguranca.php pra validar os dados digitados
  if (strcmp(validateUser($username, $password),'success') == 0) {
    // O usuário e a senha digitados foram validados, manda pra página interna
    header("Location: ../".$GLOBALS['mainPage']);

  } else {
    // O usuário e/ou a senha são inválidos, manda de volta pro form de login
    // Para alterar o endereço da página de login, verifique o arquivo seguranca.php
    expelledVisitor();

  }
}
