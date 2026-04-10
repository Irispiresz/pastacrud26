<?php 
  require_once "functions.php"; 
  session_start();
  require_once('../inc/auten.php');
  require_login();
  edit();
  include(HEADER_TEMPLATE); 
  
?>

<form action="edit.php?id=<?php echo htmlspecialchars($customer['id'] ?? ''); ?>" method="post">
    <!-- area de campos do form -->
    <hr />
    <div class="row">
        <div class="form-group col-md-7">
            <label for="nome">Nome / Razão Social</label>
            <input type="text" class="form-control" id="nome" name="customer[name]" maxlength="100" value="<?php echo htmlspecialchars($customer['name'] ?? ''); ?>">
        </div>

        <div class="form-group col-md-3">
            <label for="cpf">CNPJ / CPF</label>
            <input type="text" class="form-control" id="cpf" name="customer[cpf_cnpj]" maxlength="15" value="<?php echo htmlspecialchars($customer['cpf_cnpj'] ?? ''); ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="birth">Data de Nascimento</label>
            <input type="date" class="form-control" id="birth" name="customer[birthdate]" value="<?php echo htmlspecialchars(formatadata($customer['birthdate'] ?? null, 'Y-m-d')); ?>">
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-md-5">
            <label for="end">Endereço</label>
            <input type="text" class="form-control" id="end" name="customer[address]" maxlength="80" value="<?php echo htmlspecialchars($customer['address'] ?? ''); ?>">
        </div>

        <div class="form-group col-md-3">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="customer[hood]" maxlength="50" value="<?php echo htmlspecialchars($customer['hood'] ?? ''); ?>">
        </div>
        
        <div class="form-group col-md-2">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" name="customer[zip_code]" maxlength="8" value="<?php echo htmlspecialchars($customer['zip_code'] ?? ''); ?>">
        </div>
        
        <div class="form-group col-md-2">
            <label for="cad">Data de Cadastro</label>
            <input type="date" class="form-control" id="cad" name="customer[created]" value="<?php echo htmlspecialchars($customer['created'] ?? ''); ?>" disabled>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-md-5">
            <label for="municipio">Município</label>
            <input type="text" class="form-control" id="municipio" name="customer[city]" maxlength="100" value="<?php echo htmlspecialchars($customer['city'] ?? ''); ?>">
        </div>
        
        <div class="form-group col-md-2">
            <label for="tel">Telefone</label>
            <input type="tel" class="form-control" id="tel" name="customer[phone]" maxlength="11" value="<?php echo htmlspecialchars($customer['phone'] ?? ''); ?>">
        </div>
        
        <div class="form-group col-md-2">
            <label for="cel">Celular</label>
            <input type="tel" class="form-control" id="cel" name="customer[mobile]" maxlength="11" value="<?php echo htmlspecialchars($customer['mobile'] ?? ''); ?>">
        </div>
        
        <div class="form-group col-md-1">
            <label for="estado">UF</label>
            <input type="text" class="form-control" id="estado" name="customer[state]" maxlength="2" value="<?php echo htmlspecialchars($customer['state'] ?? ''); ?>">
        </div>
        
        <div class="form-group col-md-2">
            <label for="ie">Inscrição Estadual</label>
            <input type="text" class="form-control" id="ie" name="customer[ie]" maxlength="15" value="<?php echo htmlspecialchars($customer['ie'] ?? ''); ?>">
        </div>
    </div>
    
    <div id="actions" class="row mt-2">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-ban"></i> Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>