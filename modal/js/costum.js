const listarUsuarios = async(pagina)=>{
   const dados= await fetch("./listar.php?pagina=" + pagina);
   const resposta=await dados.json();
   //console.log(resposta);

   if(!resposta['status']){ //retorna o status presente na pagina do index.php
    document.getElementById("msgAlerta").innerHTML = resposta['msg'];//innerHTML siginifica um conteudo html
   }else{
    const conteudo= document.querySelector(".listar-usuarios");// se tem o ponto(".") quer dizer que é do tipo class
    if(conteudo){
       conteudo.innerHTML=resposta['dados'];

    }
   }
}
listarUsuarios(1);

//Cadastrar registro em duas tabelas no BD
const cadUsuarioForm= document.getElementById("cad-usuario-form");

//Receber o seletor da janela modal
const cadUsuarioModal = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));



//If é acessado somente quando existir o seletor "cad-usuario-form"
if(cadUsuarioForm){
   cadUsuarioForm.addEventListener("submit", async(e)=>{
      e.preventDefault(); //e.preventDefault usado para nao recarregar a pagina
      const dadosForm= new FormData(cadUsuarioForm);

      //usado para enquanto o casdastro está sendo processado
      document.getElementById("cad-usuario-btn") .value = "salvando"

      const dados=await fetch("cadastrar.php",{ // await utilizado para ler objtos apos aguardar o processamento
         method: "POST",
         body: dadosForm
      });
     const resposta= await dados.json();

     //console.log(resposta);

   //Acessa o If quando não cadastrar o usuario
     if(!resposta['status']){
         document.getElementById('msgAlertaErro').innerHTML=resposta['msg'];
         document.getElementById('msgAlerta').innerHTML="";
     }else{
         document.getElementById('msgAlertaErro').innerHTML= "";
         document.getElementById('msgAlerta').innerHTML=resposta['msg'];

         //para limpar o form
         cadUsuarioForm.reset();

         //para fechar a janela modal
         //cadUsuarioModal.hide();

         //para atualizar a pagina com o novo usuario inserido
         listarUsuarios(1);

         //apos o usuario ser cadastrado volta o botao "cadastrar"
         document.getElementById("cad-usuario-btn") .value = "cadastrar"
     }

   })
}
 //Visualizar os dados do registro
 async function visUsuario(id){
   const dados = await fetch('visualizar.php?id=' + id);
   const resposta = await dados.json();
console.log(resposta)

if(!resposta['status']){
   document.getElementById('msgAlerta').innerHTML = resposta['msg'];
}else{
   document.getElementById('msgAlerta').innerHTML = "";
   const visModal = new bootstrap.Modal(document.getElementById('visUsuarioModal'))
   visModal.show();

   document.getElementById("idUsuario").innerHTML=resposta['dados'].id;
   document.getElementById("nomeUsuario").innerHTML=resposta['dados'].nome;
   document.getElementById("emailUsuario").innerHTML=resposta['dados'].email;
   document.getElementById("logradouroUsuario").innerHTML=resposta['dados'].logradouro;
   document.getElementById("numeroUsuario").innerHTML=resposta['dados'].numero;
}
}

//Recuperar dados do registro Usuario do fomrulario editar
async function editUsuarioDados(id){
   document.getElementById("msgAlertaErroEdit").innerHTML = "";

   const dados = await fetch ('visualizar.php?id=' + id);
   const resposta = await dados.json();

   if(!resposta['status']){
      document.getElementById('msgAlerta').innerHTML = resposta['msg'];
   }else{
      const editModal = new bootstrap.Modal(document.getElementById('editUsuarioModal'));
      editModal.show();
      document.getElementById("editid").value = resposta ['dados'].id;
      document.getElementById("editnome").value = resposta ['dados'].nome;
      document.getElementById("editemail").value = resposta ['dados'].email;
      document.getElementById("editlogradouro").value = resposta ['dados'].logradouro;
      document.getElementById("editnumero").value = resposta ['dados'].numero;
   }
}

//Editar os dados do registro no BD
const editForm = document.getElementById("edit-usuario-form");
if(editForm){
   editForm.addEventListener("submit", async (e) =>{ //addEventListenet usado para aguardar um evento submit
      e.preventDefault();

      const dadosForm = new FormData(editForm);
      document.getElementById("edit-usuario-btn") .value = "salvando"


      const dados = await fetch("editar.php",{
         method: "POST",
         body: dadosForm

      });
      const resposta = await dados.json();
     

      if(!resposta['status']){
         document.getElementById("msgAlertaErroEdit").innerHTML = resposta ['msg'];
      
      }else{
         document.getElementById("msgAlertaErroEdit").innerHTML = resposta ['msg'];
         listarUsuarios(1);
      }
      document.getElementById("edit-usuario-btn") .value = "salvar"

   }); 
}

//Apagar reegistro no BD
async function apagarUsuario(id){
   
   var confirmar = confirm("Tem certeza que deseja apagar o registro selecionado?");
   if(confirmar==true){
      const dados = await fetch('apagar.php?id='+id);// ? usado para enviar como parametro
      const resposta = await dados.json();
   
      if(!resposta['status']){
         document.getElementById("msgAlerta").innerHTML = resposta['msg'];
      }else{
         document.getElementById("msgAlerta").innerHTML = resposta['msg'];
         listarUsuarios(1);
      }
   }
}
