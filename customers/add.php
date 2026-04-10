<?php 
  // 1. Inclui o config.php para ter acesso a constantes como BASEURL
  //include_once('../config.php');
   require_once "functions.php"; 
   session_start();
    require_once('../inc/auten.php');
    require_login(); // qualquer usuário pode acessar
  add();
  include(HEADER_TEMPLATE); 
  
?>

        <h2>Novo Cliente</h2>

        <form action="add.php" method="post">
            <!-- area de campos do form -->
            <hr />
            <div class="row">
                <div class="form-group col-md-7">
                    <label for="nome">Nome / Razão Social</label>
                    <input type="text" class="form-control" id="nome" name="customer[name]" maxlength="100">
                </div>

                <div class="form-group col-md-3">
                    <label for="cpf">CNPJ / CPF</label>
                    <input type="text" class="form-control" inputmode="numeric" id="cpf" name="customer[cpf_cnpj]" placeholder="000.000.000-00"  maxlength="15">
                </div>

                <div class="form-group col-md-2">
                    <label for="birth">Data de Nascimento</label>
                    <input type="date" class="form-control"  id="birth" name="customer[birthdate]">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="end">Endereço</label>
                    <input type="text" class="form-control" id="end" name="customer[address]"  maxlength="80">
                </div>

                <div class="form-group col-md-3">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control"  id="bairro"  name="customer[hood]"  maxlength="50">
                </div>
                
                <div class="form-group col-md-2">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control"  id="cep" name="customer[zip_code]"  maxlength="8">
                </div>
                
                <div class="form-group col-md-2">
                    <label for="cad">Data de Cadastro</label>
                    <input type="date" class="form-control"  id="cad" name="customer[created]" disabled>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="municipio">Município</label>
                    <input type="text" class="form-control"  id="municipio"  name="customer[city]"  maxlength="100">
                </div>
                
                <div class="form-group col-md-2">
                    <label for="tel">Telefone</label>
                    <input type="tel" class="form-control" inputmode="numeric" id="tel" name="customer[phone]" placeholder="(99)99999-9999" maxlength="13">
                </div>
                
                <div class="form-group col-md-2">
                    <label for="cel">Celular</label>
                    <input type="tel" class="form-control" inputmode="numeric" id="cel" name="customer[mobile]"  placeholder="(99)99999-9999" maxlength="14">
                </div>
                
                <div class="form-group col-md-1">
                    <label for="estado">UF</label>
                    <input type="text" class="form-control" id="estado" name="customer[state]"  maxlength="2">
                </div>
                
                <div class="form-group col-md-2">
                    <label for="ie">Inscrição Estadual</label>
                    <input type="text" class="form-control"  id="ie" name="customer[ie]"  maxlength="15">
                </div>
            
            </div>
            
            <div id="actions" class="row mt-2">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-secondary" ><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                    <a href="index.php" class="btn btn-light"  ><i class="fa-solid fa-ban"></i> Cancelar</a>
                </div>
            </div>
        </form>

        <!-- no final do formulário, antes do FOOTER_TEMPLATE -->
<script>
function onlyDigits(v){ return v.replace(/\D/g,''); }

function formatCPF(v){
  const d = onlyDigits(v).slice(0,11);
  if(d.length<=3) return d;
  if(d.length<=6) return d.slice(0,3)+"."+d.slice(3);
  if(d.length<=9) return d.slice(0,3)+"."+d.slice(3,6)+"."+d.slice(6);
  return d.slice(0,3)+"."+d.slice(3,6)+"."+d.slice(6,9)+"-"+d.slice(9,11);
}

function formatPhone(v){
  const d = onlyDigits(v);
  if(d.length<=2) return "("+d;
  if(d.length<=6) return "("+d.slice(0,2)+")"+d.slice(2);
  if(d.length<=10) return "("+d.slice(0,2)+")"+d.slice(2,6)+"-"+d.slice(6);
  return "("+d.slice(0,2)+")"+d.slice(2,7)+"-"+d.slice(7,11);
}

document.getElementById("cpf").addEventListener("input", function(){
  this.value = formatCPF(this.value);
});

document.getElementById("tel").addEventListener("input", function(){
  this.value = formatPhone(this.value);
});

document.getElementById("cel").addEventListener("input", function(){
  this.value = formatPhone(this.value);
});
</script>


<?php include(FOOTER_TEMPLATE); ?>