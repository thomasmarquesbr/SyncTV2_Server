<?php

//  Configurações do Script
// ==============================
$_SG['connectServer'] = true;    // Abre uma conexão com o servidor MySQL?
$_SG['openSession'] = true;         // Inicia a sessão com um session_start()?

$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' é diferente de 'THIAGO'

$_SG['validateAlways'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?
// Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.

$_SG['server'] = 'localhost';    // Servidor MySQL
$_SG['userDB'] = 'root';          // Usuário MySQL
$_SG['passDB'] = '';                // Senha MySQL
$_SG['database'] = 'synctv_db';            // Banco de dados MySQL

$_SG['loginPage'] = 'login.php'; // Página de login

$_SG['tableUsers'] = 'iv03h_users_synctv';       // Nome da tabela onde os usuários são salvos
// ==============================

// ======================================
//   ~ Não edite a partir deste ponto ~
// ======================================

// Verifica se precisa fazer a conexão com o MySQL
if ($_SG['connectServer'] == true) {
  $_SG['link'] = mysql_connect($_SG['server'], $_SG['userDB'], $_SG['passDB']) or die("MySQL: Não foi possível conectar-se ao servidor [".$_SG['server']."].");
  mysql_select_db($_SG['database'], $_SG['link']) or die("MySQL: Não foi possível conectar-se ao banco de dados [".$_SG['database']."].");
}

// Verifica se precisa iniciar a sessão
if ($_SG['openSession'] == true)
  session_start();

/**
* Função que valida um usuário e senha
*
* @param string $usuario - O usuário a ser validado
* @param string $senha - A senha a ser validada
*
* @return bool - Se o usuário foi validado ou não (true/false)
*/
function validateUser($usuario, $senha) {
  global $_SG;

  $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';

  // Usa a função addslashes para escapar as aspas
  $nusuario = addslashes($usuario);
  $nsenha = addslashes($senha);

  // Monta uma consulta SQL (query) para procurar um usuário
  $sql = "SELECT `id`, `username`,`email`,`password` FROM `".$_SG['tableUsers']."` WHERE (".$cS." `username` = '".$nusuario."' OR ".$cS." `email` = '".$nusuario."') AND ".$cS." `password` = '".$nsenha."' LIMIT 1";
  $query = mysql_query($sql);
  $resultado = mysql_fetch_assoc($query);

  // Verifica se encontrou algum registro
  if (empty($resultado)) {
    // Nenhum registro foi encontrado => o usuário é inválido
    return false;
  } else {
    // Definimos dois valores na sessão com os dados do usuário
    $_SESSION['usuarioID'] = $resultado['id']; // Pega o valor da coluna 'id do registro encontrado no MySQL
    $_SESSION['usuarioNome'] = $resultado['username']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL
    $_SESSION['email'] = $resultado['email'];


    // Verifica a opção se sempre validar o login
    if ($_SG['validateAlways'] == true) {
      // Definimos dois valores na sessão com os dados do login
      $_SESSION['usuarioLogin'] = $usuario;
      $_SESSION['usuarioSenha'] = $senha;
    }

    return true;
  }
}


/**
* Função insere novo usuário no banco
*/

function insertUser($username,$email, $password){
  global $_SG;

  $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';

  // Usa a função addslashes para escapar as aspas
  $nUsername = addslashes($username);
  $nPassword = addslashes($password);

  // Monta uma consulta SQL (query) para procurar um usuário
  $sql = "SELECT * FROM `".$_SG['tableUsers']."` WHERE (".$cS." `username` = '".$nUsername."' OR ".$cS." `email` = '".$email."') LIMIT 1";
  $query = mysql_query($sql);
  $resultado = mysql_fetch_assoc($query);

  // Verifica se encontrou algum registro
  if (empty($resultado)) {
    // Nenhum registro foi encontrado => Insere novo usuario no banco

    //Query que realiza a inserção dos dados no banco de dados na tabela indicada acima
    $query = "INSERT INTO `".$_SG['tableUsers']."` (".$cS." `username` , ".$cS."  `email` ,".$cS."  `password`) VALUES ('".$nUsername."', '".$email."', '".$nPassword."')";
    mysql_query($query,$_SG['link']); 


    return true;
  } else {
    // ja existe nome de usuario ou email cadastrado

    return false;
  }
}


/**
* Função que protege uma página
*/
function protectPage() {
  global $_SG;

  if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
    // Não há usuário logado, manda pra página de login
    expelledVisitor();
  } else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
    // Há usuário logado, verifica se precisa validar o login novamente
    if ($_SG['validateAlways'] == true) {
      // Verifica se os dados salvos na sessão batem com os dados do banco de dados
      if (!validateUser($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
        // Os dados não batem, manda pra tela de login
        expelledVisitor();
      }
    }
  }
}

/**
* Função para expulsar um visitante
*/
function expelledVisitor() {
  global $_SG;

  // Remove as variáveis da sessão (caso elas existam)
  unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);

  session_destroy();
  
session_write_close();
  
  // Manda pra tela de login
  header("Location: ".$_SG['loginPage']."");
}