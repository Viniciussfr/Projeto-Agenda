<?php
include_once ("templates/header.php");
?>

<div class="container">
    <?php
      include_once("templates/backbtn.html");
    ?>
    <h1 id="main-title">Criar Contato</h1>
    <form id="create-form" action="<?=$BASE_URL?>config/process.php" method="POST">
<input type="hidden" name="type" value="create">
<div class="form-group">
    <label for="name">Nome do Contato</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Escreva seu Nome" required>
</div> 
<div class="form-group">
    <label for="phone">Numero de Contato</label>
    <input type="number" class="form-control"name="phone" id="phone" placeholder="Digite o numero de telefone" required>
</div>
<div class="form-group">
    <label for="observations">Observações</label>
    <textarea type="text" class="form-control" name="observations" id="observations" placeholder="Insira as Observações" rows="3"></textarea>
</div>   
   <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
</div>





<?php
include_once ("templates/footer.php");
?>