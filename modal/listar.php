<?php 

//Inlcuir a conexao com o BD

include_once "conexao.php";

//receber a pagina
$pagina=filter_input(INPUT_GET,"pagina", FILTER_SANITIZE_NUMBER_INT);

if(!empty($pagina)){

    //calcular o inicio da vizualizção
    $qnt_result_pg=3; //quantidade de registro por pagina
    //Exp metodo de calculo se estou na pagina 2($pagina) e multplicp pela quantidade 5( $qnt_result_pg) o resultado seria 20 por isso que tem que se realizar a subtração pelo $qnt_result_pg(2*5=10-5=5) para o item da proxima pagina começar do 7 nao 10
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg; 
    

    //Criar query para recuperar registros do BD
    $query_usuarios ="SELECT usr.id, usr.nome, usr.email, 
    ende.logradouro, ende.numero
    FROM usuarios AS usr
    LEFT JOIN endereco AS ende ON ende.usuario_id = usr.id
    ORDER BY usr.id DESC
    LIMIT $inicio, $qnt_result_pg";

    $result_usuarios = $conn->prepare($query_usuarios);
    $result_usuarios->execute();

    if(($result_usuarios)and($result_usuarios->rowCount()!=0)){
        //implementar uma tabela
        $dados = "<table class='table table-striped table-bordered table-hover'>";
        $dados .= "<thead>";
        $dados .= "<tr>";
        $dados .= "<th>ID:</th>";
        $dados .= "<th>Nome:</th>";
        $dados .= "<th>E-mail:</th>";
        $dados .= "<th>Logoradouro:</th>";
        $dados .= "<th>Numero:</th>";
        $dados .= "<th>Ações:</th>";
        $dados .= "</tr>";
        $dados .= "</thead>";
        $dados .= "<tbody>";
        while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
            extract($row_usuario);

            $dados .= "<tr>";
            $dados .= "<td>$id</td>";
            $dados .= "<td>$nome</td>";
            $dados .= "<td>$email</td>";
            $dados .= "<td>$logradouro </td>";
            $dados .= "<td>$numero</td>";
            $dados .= "<td><a href='#' class='btn btn-outline-primary btn-sm' onclick='visUsuario($id)'>Visualizar</a> <a href='#' class='btn btn-outline-warning btn-sm' onclick='editUsuarioDados($id)'>Editar</a> <a href='#' class='btn btn-outline-danger btn-sm' onclick='apagarUsuario($id)'>Apagar</a></td>";
            $dados .= "</tr>";

            //Forma de ver os dados os valores
            /*echo "ID: $id <br>";
            echo "Nome: $nome <br>";
            echo "E-mail: $email <br>";
            echo "Logradouro: $logradouro <br>";
            echo "Numero: $numero <br>";*/
        }
        $dados .= "</tbody>";
        $dados .= "</table>";

        ///Paginação= Somar a quantidade de registros que ha no BD
        $query_pg="SELECT COUNT(id) AS num_result FROM usuarios";
        $result_pg=$conn->prepare($query_pg);
        $result_pg->execute();
        $row_pg=$result_pg->fetch(PDO::FETCH_ASSOC);

        //Calcular quantidade de pagina
        $quantidade_pg= ceil($row_pg['num_result'] / $qnt_result_pg);//ceil função do php para arrendor numero pra cima

        $max_links=2; //links da paginação, dois links antes e 2 depois

        $dados .= "<nav aria-label='Page navigation example'>";
        $dados .= "<ul class= 'pagination pagination-sm justify-content-center'>";
        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios(1)'>Primeira</a></li>";

        
        //O for é dividio em 3 partes (inicialização, comparar e incremento ou decremento)
        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina-1;$pag_ant++){
            //if utilizado para nao imprimir paginas alem das existentes
            if($pag_ant>=1){
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($pag_ant)'>$pag_ant</a></li>";
            }
        }
        
        $dados .= "<li class='page-item active' aria-current='page'>";
        $dados .= "<a class='page-link' href='#'>$pagina</a>";
        $dados .= "</li>";

        for($pag_dep=$pagina+1;$pag_dep <=$pagina + $max_links;$pag_dep++){
            if($pag_dep<=$quantidade_pg){
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($pag_dep)'>$pag_dep</a></li>";
            }
        }
        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($quantidade_pg)'>Última</a></li>";
        $dados .= "</ul>";
        $dados .= "</nav>";


        
        $retorna=['status'=>true, 'dados' =>$dados, 'quantidade_pg' =>$quantidade_pg];
    }else{
        $retorna = ['status'=>false, 'msg'=>"<p style='color:#f00;'>Erro! Nenhum usuario encontrado</p>"];
    }
}else{
    $retorna = ['status'=>false, 'msg'=>"<p style='color:#f00;'>Erro!Sem a pagina</p>"];
}
echo json_encode($retorna)
?>