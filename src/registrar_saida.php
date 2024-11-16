<?php
include 'classes/sessao.php';
require 'controle.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolução de EPI</title>
    <link rel="icon" href="img/navicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <style type="text/css">
        body{ font: 18px sans-serif;
            background-color: #1D3736;
            color:#ffffff
        }

        .wrapper{ width: 350px; padding: 20px; }

        .green-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #1EE27A; 
            color: #1D3736;
        }

        .green-buttom:hover {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #1ec96d; 
            color: #1D3736;
            text-decoration: none;
        }

        .red-buttom:hover{
            box-sizing: border-box;
            text-align: center;
            display: block; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #c01937; 
            color: white;
            text-decoration: none;
        }

        .red-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc;  
            background-color: #E21E41; 
            color: white;
        }

        .orange-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #F39C36; 
            color: #1D3736;
        }

        .orange-buttom:hover {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #d88a31; 
            color: #1D3736;
            text-decoration: none;
        }

        .blue-buttom:hover {
            box-sizing: border-box;
            text-align: center;
            display: block; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #0c6ea2; 
            color: white;
            text-decoration: none;
        }          

        .blue-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #0E7FBE; 
            color: white;
        }

        .input-base {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 40px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #D9D9D9; 
            color: black;
        }


    </style>
</head>
<body>
    <div class="container mt-5">
    <img src="img/devolucao.png" alt="erro" width="80" height="80">
        <h2>Registrar Retirada de EPI</h2>
        <img src="img/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">
        <form action="controle.php" method="post">
            <div class="form-group">
                <label for="funcionarios_retira_id">ID do EPI:</label>
                <select class="custom-select" id="inputGroupSelect01 epis" name="epis_id">
                    <option selected hidden>Escolher...</option>
                </select>
            </div>
            <div class="form-group">
                <label for="funcionarios_retira_id">ID do almoxarife:</label>
                <select class="custom-select" id="inputGroupSelect01 almoxarife_id" name="almoxarife_id">
                    <option selected hidden>Escolher...</option>
                </select>
            </div>
            <div class="form-group">
                <label for="funcionarios_retira_id">ID do funcionario:</label>
                <select class="custom-select" id="inputGroupSelect01 idfuncionario" name="idfuncionario">
                    <option selected hidden>Escolher...</option>
                </select>
            </div>
            <div class="form-group">
                <label for="funcionarios_retira_id">quantidade:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
            </div>
           
            <button type="submit" class="blue-buttom" name="action" value="retirada">Registrar retirada</button>
            <br>
            <div class="form-group">
        <a href="menu.php"><button type="button" class="red-buttom" >Voltar</button></a>
        <span class="help-block"></span>
        </div>
        </form>
    </div>
</body>

<script>
        let epis;
        
        console.log("teste");
        $.ajax({
        url:"controle.php",
        type:"POST",
        dataType:"json",
        data:{action:"lista_epi"},
        success:function(response){
            response.forEach(element => {
              console.log(element['nome']);
              campoei = document.getElementById("inputGroupSelect01 epis");
              campoei.innerHTML += '<option value="'+ element['id'] +'">'+ element['nome'] +'</option>';
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         } 
        })
        
        $.ajax({
        url:"controle.php",
        type:"POST",
        dataType:"json",
        data:{action:"listar_almoxarife"},
        success:function(response){
            response.forEach(element => {
              console.log(element['usuario']);
              campofor = document.getElementById("inputGroupSelect01 almoxarife_id");
              campofor.innerHTML += '<option value="'+ element['id'] +'">'+ element['usuario'] +'</option>';
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         } 
        })

        $.ajax({
        url:"controle.php",
        type:"POST",
        dataType:"json",
        data:{action:"listar_funcionarios"},
        success:function(response){
            response.forEach(element => {
              console.log(element['nome']);
              campofor = document.getElementById("inputGroupSelect01 idfuncionario");
              campofor.innerHTML += '<option value="'+ element['idfuncionario'] +'">'+ element['nome_funcionario'] +'</option>';
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         } 
        })
        

      

        
</script>
</html>
