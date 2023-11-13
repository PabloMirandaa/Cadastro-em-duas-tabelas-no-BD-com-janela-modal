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
    //Editar no BD na primeira tabela

    $query_usuario = "UPDATE usuarios SET nome=:nome, email=:email WHERE id=:id";
    //para não deixar a query vuneravel é utilizado links por meio dos ":"

    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':nome', $dados['nome']);
    $edit_usuario->bindParam(':email', $dados['email']);
    $edit_usuario->bindParam(':id', $dados['id']);
    

     //Verificar se editou o usuario
     if($edit_usuario->execute()){


    //Editar no BD na segunda tabela
    $query_endereco = "UPDATE endereco SET logradouro=:logradouro, numero=:numero WHERE usuario_id=:usuario_id ";
    $edit_endereco = $conn->prepare($query_endereco);
    $edit_endereco->bindParam(':logradouro', $dados['logradouro']);
    $edit_endereco->bindParam(':numero', $dados['numero']);
    $edit_endereco->bindParam(':usuario_id', $dados['id']);
    

    //Verificar se editou o endereço
    if ($edit_endereco->execute()) {
        $retorna = ['status'=>true, 'msg'=>"<div class= 'alert alert-success' role='alert'>Usuário Editado com sucesso</div>"]; 
    }else{
        $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Usuário não Editado</div>"];
    }
 
    }else{
        $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Usuário não Editado</div>"];
    }

   
}
echo json_encode($retorna);
?>