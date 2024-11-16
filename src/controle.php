<?php
    require_once("classes/almoxarife.php");
    require_once("classes/conexao.php");
    require_once("classes/sessao.php");
    require_once("classes/epi.php");
    require_once("classes/fornecedor.php");
    require_once("classes/funcionario.php");

    $pdo = new conexao();
    $almoxarife = new almoxarife($pdo);
    $funcionario = new Funcionario($pdo);
    $epi = new epi($pdo);
    $fornecedor = new Fornecedor($pdo);
    $sessao = new sessao();
    $query;
    $count = 0;
    


    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["action"] == "login"){
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            if($sessao->logar($_POST['login'], $_POST['senha'], $pdo)) {
                header("location: menu.php");
            }
    
            else{
                header("location:login.php");
            }
        }
    
        else if($_POST["action"] == "Cadastrar"){
            if(validar_post()){
                $usuario = $_POST['usuario'];
                $senha = $_POST['senha'];
        
                $almoxarife->cadastrar($_POST['usuario'], $_POST['senha']);
                header("location: login.php");
            }

            else{
                header("location: cadastrar.php");
            }
        }
        
        else if($_POST['action'] == "sair"){
            $sessao->sair();
        }

        else if($_POST["action"] == "adicionar" ){
    
            if(validar_post()){
    
                $epi->adicionar($_POST['nome'],$_POST['ca'],$_POST['unidade'],$_POST['estoque'],$_POST['minimo'],$_POST['validade']);
            }
            
            header("location: adicionar.php");
            
        }

        else if($_POST["action"] == "atualizar" ){
            if(validar_post()){
                $epi->compra_estoque();
            }

            header('location: atualizar_estoque.php');
        }

        else if($_POST["action"] == "retirada"){

            if(validar_post()){
                $almoxarife->registrar_saida();
                header("location: registrar_saida.php");
            }
            else{
                header("location: registrar_saida.php");
            }
        }

        else if($_POST["action"] == "devolucao"){
            if($_POST["comentario"] == ""){
                $_POST["comentario"] = "(Sem Comentario)";
            }

            if(validar_post()){
                $almoxarife->registrar_entrada();
                header("location: devolucao.php");
            }
            else{
                header("location: devolucao.php");
            }
        }
        else if($_POST["action"] == "criar_aviso"){
            if(validar_post()){
                $almoxarife->criar_aviso($_SESSION["usuario"], $_SESSION["almoxarife_id"]);
                
            }
          
        }
        else if($_POST["action"] == "desativar"){
            $almoxarife->desativar_aviso($_POST["idaviso"]);
        }

        else if($_POST["action"] == "contagem"){
            echo json_encode($almoxarife->contagem_avisos());
        }
        else if($_POST["action"] == "cadastrar_funcionario"){
            if(validar_post()){
                $almoxarife->cadastrar_funcionario();
                header("location:cadastrar_funcionario.php");
            }
            header("location:cadastrar_funcionario.php");
        }

        else if($_POST["action"] == "cadastrar_fornecedor"){
            if(validar_post()){
                $almoxarife->cadastrar_fornecedor();
                header("location:cadastrar_fornecedor.php");
            }
            header("location:cadastrar_fornecedor.php");
        }

        else if($_POST["action"] == "alerta"){
            echo json_encode($epi->checar_minimo());
            
        }
        else if($_POST["action"] == "lista_epi"){
            $query = $almoxarife->ver_estoque("");
            
            echo json_encode($query->fetchAll());
        }

        else if($_POST["action"] == "listar_fornecedor"){
            $query = $fornecedor->listar_fornecedores();
            
            echo json_encode($query->fetchAll());
            
        }

        else if($_POST["action"] == "listar_almoxarife"){
            $query = $almoxarife->listar_almoxarife();
            
            echo json_encode($query->fetchAll());
            
        }

        else if($_POST["action"] == "listar_funcionarios"){
            $query = $funcionario->listar_funcionarios();
            
            echo json_encode($query->fetchAll());
            
        }
    }
    
    else{
        if (!$sessao->conta_logada()) {
            header("location: login.php");
            exit;
        }
    }

    function ver_saidas($almoxarife){
         return $almoxarife->ver_saidas();
    }

    function ver_estoque($almoxarife, $pesquisa){
        return $almoxarife->ver_estoque($pesquisa);
   }



    function validar_post(){

        foreach ($_POST as $i) {
            if($i == ""){
                return false;
            }
        }   

        return true;

   }

?>
