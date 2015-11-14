<?php
session_start();

$connectServer = true;    // Abre uma conexão com o servidor MySQL
$validateAlways = true;       // validar o usuário e a senha a cada carregamento de página

$server = 'localhost:8889';    // Servidor MySQL
$userDB = 'root';          // Usuário MySQL
$passDB = 'root';                // Senha MySQL
$database = 'synctv_db';            // Banco de dados MySQL

$loginPage= 'http://localhost:8888/synctv2/login.php'; // Página de login
$tableUsers = 'iv03h_users_synctv';       // Nome da tabela onde os usuários são salvos
$tableChannels = 'iv03h_channels';
$tableSchedules = 'iv03h_schedules';
$tableMedias = 'iv03h_medias';
$tableApps = 'iv03h_applications';

$mainPage = 'main.php';
$errorQuery =  array( 'errorInsert' => 'Não foi possível efetuar o cadastro!', 
                      'userExist'=> 'Nome de usuário ou email já está cadastrado!',
                      'errorConnectDB'=> 'Erro ao conectar ao banco de dados!',
                      'userNotExist' => 'Usuário/email ou senha inválidos',
                      'errorInsertChannel' => 'Não foi possível cadastrar dados',
                      'channelExist' => 'Este canal já existe',
                      'channelRemoveError' => 'Não foi possível remover o canal',
                      'channelUpdateError' => 'Não foi possível editar o canal',
                      'channelsAllRemoveError' => 'Não foi possível remover os canais'
                      );
// ==============================

// ======================================
//   ~ Não edite a partir deste ponto ~
// ======================================

// Verifica se precisa fazer a conexão com o MySQL
function connectDB(){
  if ($GLOBALS['connectServer'] == true) {
    $GLOBALS['link'] = new PDO("mysql:host=".$GLOBALS['server'].";dbname=".$GLOBALS['database'], $GLOBALS['userDB'], $GLOBALS['passDB']);
    if(!$GLOBALS['link']){
      return false;
    }else
        return true;
  }
}

function disconnectDB(){
  $GLOBALS['link'] = null;
}

function loginUser($rowUser){
  
  $_SESSION['userID'] = $rowUser['id']; 
  $_SESSION['username'] = $rowUser['username'];
  $_SESSION['email'] = $rowUser['email'];

  if ($GLOBALS['validateAlways'] == true) {
      // Definimos dois valores na sessão com os dados do login
    $_SESSION['loginUser'] = $rowUser['username'];
    $_SESSION['passUser'] = $rowUser['password'];
  }

 // echo $_SESSION['username']."   ".$_SESSION['userID']."   ".$_SESSION['email'];
}

function logoutUser(){
  expelledVisitor();
}

/**
* Função que valida um usuário e senha
*/
function validateUser($usuario, $senha) {

  $nusuario = addslashes($usuario);
  $nsenha = addslashes($senha);

  connectDB();
  $stmSelect = "SELECT * FROM ".$GLOBALS['tableUsers']." WHERE ( BINARY `username` = '".$nusuario."' OR BINARY `email` = '".$nusuario."') AND BINARY `password` = '".$nsenha."' LIMIT 1";
  $result = $GLOBALS['link']->query($stmSelect);
  $row = $result->fetch(PDO::FETCH_ASSOC);
  if($row){//existe usuário
    loginUser($row);  
    disconnectDB();
    return 'success';
  }else{//usuario nao existe
    disconnectDB();
    return 'userNotExist';
  }

}


/**
* Função insere novo usuário no banco
*/

function insertUser($username, $email, $password){
  

  // Usa a função addslashes para escapar as aspas
  $nUsername = addslashes($username);
  $nEmail = addslashes($email);
  $nPassword = addslashes($password);

  // Monta uma consulta SQL (query) para procurar um usuário
  $stmSelect = "SELECT * FROM ".$GLOBALS['tableUsers']." WHERE username='".$nUsername."' OR email='".$nEmail."' LIMIT 1";
  $result = $GLOBALS['link']->query($stmSelect);
  $row = $result->fetch(PDO::FETCH_ASSOC);
  if(empty($row)){//não existe usuário

    try {
      $stmInsert = $GLOBALS['link']->prepare("INSERT INTO ".$GLOBALS['tableUsers']." (username, email, password) VALUES (?, ?, ?)");
      $stmInsert->bindParam(1,  $username, PDO::PARAM_STR);
      $stmInsert->bindParam(2,  $email, PDO::PARAM_STR);
      $stmInsert->bindParam(3,  $password, PDO::PARAM_STR);
      $executa = $stmInsert->execute();


      if($executa){
        //echo 'Dados inseridos com sucesso';
        disconnectDB();
        return 'success';
      }else{
        //echo 'Erro ao inserir os dados';
        disconnectDB();
        return 'errorInsert';
      }
    }catch (Exception $e) {
      disconnectDB();
      return $e->getMessage();
    }
        
  }else{
    disconnectDB();
    return 'userExist';
  }

}

function getChannelsTable(){

  $stmSelect = "SELECT * FROM ".$GLOBALS['tableChannels']." WHERE user='".$_SESSION['userID']."'";
  $result = $GLOBALS['link']->query($stmSelect);
  disconnectDB();
  return $result->fetchALL(PDO::FETCH_ASSOC);

}

function insertChannel($channel){

  $nName = addslashes($channel['name']);
  $nDescription = addslashes($channel['description']);

  $stmSelect = "SELECT * FROM ".$GLOBALS['tableChannels']." WHERE name='".$nName."' AND user='".$_SESSION['userID']."' LIMIT 1";
  $result = $GLOBALS['link']->query($stmSelect);
  if($result->fetchColumn() == 0){//nome nao cadastrado

    try {
      $stmInsert = $GLOBALS['link']->prepare("INSERT INTO ".$GLOBALS['tableChannels']." (name, description, user) VALUES (?, ?, ?)");
      $stmInsert->bindParam(1,  $nName, PDO::PARAM_STR);
      $stmInsert->bindParam(2,  $nDescription, PDO::PARAM_STR);
      $stmInsert->bindParam(3,  $_SESSION['userID'], PDO::PARAM_INT);
      $executa = $stmInsert->execute();
      
      if($executa){
          //echo 'Dados inseridos com sucesso';
          disconnectDB();
          return 'success';
        }else{
          //echo 'Erro ao inserir os dados';
          disconnectDB();
          return 'errorInsertChannel';
        }
    } catch (Exception $e) {
      disconnectDB();
      return $e->getMessage();
    }

  }else{
    disconnectDB();
    return 'channelExist';
  }
  
}

function editChannel($channel){
  $stmEdit = "UPDATE ".$GLOBALS['tableChannels']." SET name='".$channel['name']."', description='".$channel['description']."' WHERE id=".$channel['id'];
  $result = $GLOBALS['link']->query($stmEdit);
  if($result){
    return 'success';
  }else{
    return 'channelUpdateError';
  }
}

function removeChannel($channel){
  $stmDelete = "DELETE FROM ".$GLOBALS['tableChannels']." WHERE `id`=".$channel['id'];
  $result = $GLOBALS['link']->query($stmDelete);
  if($result){
    return 'success';
  }else{
    return 'channelRemoveError';
  }
}

function removeAllChannels(){
  $stmDelete = "DELETE FROM ".$GLOBALS['tableChannels']." WHERE 1";
  $result = $GLOBALS['link']->query($stmDelete);
  if($result){
    return 'success';
  }else{
    return 'channelsAllRemoveError';
  }
}






/**
* Função que protege uma página
*/
function protectPage() {

  if (!isset($_SESSION['userID']) OR !isset($_SESSION['username'])) {
    // Não há usuário logado, manda pra página de login
    expelledVisitor();
  } else if (!isset($_SESSION['userID']) OR !isset($_SESSION['username'])) {
    // Há usuário logado, verifica se precisa validar o login novamente
    if ($GLOBALS['validateAlways'] == true) {
      // Verifica se os dados salvos na sessão batem com os dados do banco de dados
      if (!validateUser($_SESSION['loginUser'], $_SESSION['passUser'])) {
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
  // Remove as variáveis da sessão (caso elas existam)

  unset($_SESSION['userID'], $_SESSION['username'], $_SESSION['loginUser'], $_SESSION['passUser'],$_SESSION['email']);

  session_destroy();
  
  session_write_close();
  
  // Manda pra tela de login
  header("Location: ".$GLOBALS['loginPage']."");
}

?>