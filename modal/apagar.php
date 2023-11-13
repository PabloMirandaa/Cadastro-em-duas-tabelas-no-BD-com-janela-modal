<?php 
//incluir conexão com o BD
include_once "conexao.php";

//Receber o id do registro
$id=filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


if(!empty($id)){
    $query_endereco="DELETE FROM endereco WHERE usuario_id=:usuario_id";
    $del_endereco=$conn->prepare($query_endereco);
    $del_endereco->bindParam(':usuario_id', $id);
  

    if($del_endereco->execute()){
        $query_usuario="DELETE FROM usuarios WHERE id=:id";
        $del_usuario=$conn->prepare($query_usuario);
        $del_usuario->bindParam(':id', $id);

        if($del_usuario->execute()){
            $retorna = ['status'=>true, 'msg'=>"<div class= 'alert alert-success' role='alert'> Usuario apagado com sucesso</div>"];

        }else{
            $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Usuario apagado, endereço nao apagado</div>"];
        }

    }else{
        $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Usuario apagado, endereço nao apagado</div>"];

    }
}else{
    $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Nenhum usuario encontrado</div>"];
}

echo json_encode($retorna);
?>
