<?php 
//incluir conexão com o BD
include_once "conexao.php";

//Receber os id
$id=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);//FILTER_SANITIZE_NUMBER_INT usado para definir como inteiro



//acessa o if quando a variavel ID possuir valor
if(!empty($id)){
    $query_usuario="SELECT usr.id, usr.nome, usr.email,
    ende.logradouro, ende.numero
    FROM usuarios AS usr
    LEFT JOIN endereco AS ende ON ende.usuario_id= usr.id
    WHERE usr.id= :id LIMIT 1"; //lef join utulizado para obtar dados de duas tabelas
    $result_usuario=$conn->prepare($query_usuario);
    $result_usuario->bindParam(':id', $id);
    $result_usuario->execute();

    if(($result_usuario) and ($result_usuario->rowCount() !=0)){
        $row_usuario=$result_usuario->fetch(PDO::FETCH_ASSOC);
        $retorna = ['status'=>true, 'dados'=>$row_usuario];
    }else{
        $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Nenhum usuário encontrado</div>"];
    }
}else{
    $retorna = ['status'=>false, 'msg'=>"<div class= 'alert alert-danger' role='alert'>Erro! Nenhum usuário encontrado</div>"];
}

echo json_encode($retorna);

?>