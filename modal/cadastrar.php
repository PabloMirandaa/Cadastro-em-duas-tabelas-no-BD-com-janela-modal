<?php 
//incluir conexão com o BD
include_once "conexao.php";

//Receber os dados
$dados=filter_input_array(INPUT_POST, FILTER_DEFAULT);

//validar o form
if(empty($dados['nome'])){
    $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Necesário preencher campo nome</div>"];
}elseif(empty($dados['email'])){
    $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Necesário preencher campo email</div>"];
}elseif(empty($dados['logradouro'])){
    $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Necesário preencher campo logradouro</div>"];
}elseif(empty($dados['numero'])){
    $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Necesário preencher campo umero</div>"];
}else{
    //Cadastrar no BD na primeira tabela

    $query_usuario = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
    //para não deixar a query vuneravel é utilizado links por meio dos ":"

    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $dados['nome']);
    $cad_usuario->bindParam(':email', $dados['email']);
    $cad_usuario->execute();

     //Verificar se cadastro o usuario
     if($cad_usuario->rowCount()){

    //Recuperar o ultimo id inserido
    $id_usuario = $conn->lastInsertId();//lastInsertId utilizado para recuperar a ultima id inserido

    //Cadastrar no BD na segunda tabela
    $query_endereco = "INSERT INTO endereco (logradouro, numero, usuario_id) VALUES (:logradouro, :numero, :usuario_id)";
    $cad_endereco = $conn->prepare($query_endereco);
    $cad_endereco->bindParam(':logradouro', $dados['logradouro']);
    $cad_endereco->bindParam(':numero', $dados['numero']);
    $cad_endereco->bindParam(':usuario_id', $id_usuario);
    $cad_endereco->execute();

    //Verificar se cadastro o endereço
    if($cad_endereco->rowCount()){
        $retorna = ['status'=>true, 'msg'=>"<div class= 'alert alert-success' role='alert'>Usuário Cadastrado com sucesso</div>"]; 
    }else{
        $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Usuário não cadastrado</div>"];
    }
 
    }else{
        $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Usuário não cadastrado</div>"];
    }

    

   
}
echo json_encode($retorna);
//esse é o real
?>