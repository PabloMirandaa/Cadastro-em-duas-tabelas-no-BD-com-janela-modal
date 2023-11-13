<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
</head>
<body>
    <div class= "container"></div>
    <div class="row mt-4 mb-2">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
             <h4>Listar</h4>
             <div>
             <button type="button" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">Cadastrar</button>
             </div>
        </div>

    </div>
    
    <span id="msgAlerta"></span>
    <div class="row">
        <div class="col-lg-12"></div>
            <span class="listar-usuarios"></span>

        <!-- Inicio Modal de Cadastrar usuario -->
    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="cadUsuarioModal">Cadatrar Usuario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <span id="msgAlertaErro"></span>
            <form class="row g-3" id="cad-usuario-form">
                <div class="col-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome completo" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" autocomplete="off"  required>
                </div>
                <div class="col-12">
                    <label for="logradouro" class="form-label">Endereço</label>
                    <input type="text" name="logradouro" class="form-control" id="logradouro" placeholder="Endereço do usuário" autocomplete="off"  required>
                </div>
                <div class="col-12">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" name="numero" class="form-control" id="numero" placeholder="Número" autocomplete="off"  required>
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-outline-success btn-sm" id="cad-usuario-btn" value="Cadastrar"></input>
                 </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    <!-- Fim Modal de Cadastrar usuario -->

    <!-- Inicio Modal de Vizualizar usuario -->
    <div class="modal fade" id="visUsuarioModal" tabindex="-1" aria-labelledby="visUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title fs-5" id="visUsuarioModal">Visualizar Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <span id="msgAlertaErroVis"></span>
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><span id="idUsuario"></span></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><span id="nomeUsuario"></span></dd>

                <dt class="col-sm-3">E-mail</dt>
                <dd class="col-sm-9"><span id="emailUsuario"></span></dd>

                <dt class="col-sm-3">logradouro</dt>
                <dd class="col-sm-9"><span id="logradouroUsuario"></span></dd>

                <dt class="col-sm-3">Número</dt>
                <dd class="col-sm-9"><span id="numeroUsuario"></span></dd>
            </dl>
        </div>
        </div>
    </div>
    </div>
    <!-- Fim Modal de Vizualizar usuario -->


<!-- Inicio Modal de Editar usuario -->
<div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editUsuarioModal">Editar Usuario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <span id="msgAlertaErroEdit"></span>
            <form class="row g-3" id="edit-usuario-form">
                 <input type="hidden" name="id"  id="editid">

                <div class="col-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" id="editnome" placeholder="Nome completo" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" id="editemail" placeholder="E-mail" autocomplete="off"  required>
                </div>
                <div class="col-12">
                    <label for="logradouro" class="form-label">Endereço</label>
                    <input type="text" name="logradouro" class="form-control" id="editlogradouro" placeholder="Endereço do usuário" autocomplete="off"  required>
                </div>
                <div class="col-12">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" name="numero" class="form-control" id="editnumero" placeholder="Número" autocomplete="off"  required>
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-outline-warning btn-sm" id="edit-usuario-btn" value="Salvar"></input>
                 </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    <!-- Fim Modal de Editar usuario -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/costum.js"></script>
</body>
</html>