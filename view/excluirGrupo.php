<?php
#mostrar os dados das grupos
foreach ($grupos_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form id="grupo" name="grupo" method="post" action="">
            <!-- dados dos grupos -->
            <label for="id">Código</label>
            <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir['id']; ?>" />  
            <label for="nome">Nome</label>
            <input class="form-control"required type="text" readonly="true" name="nome" id="nome" value="<?php echo $item_excluir['nome']; ?>" maxlength="150">
            <label for="email">Email</label>
            <input class="form-control" id="email" name="dados[email][]" type="text" value="<?php echo $item_alterar['email']; ?>" title="Qual seu email?" maxlength="150">
            <!-- input oculto para informar o id do grupo "-->
            <input type="hidden" name="dados[id_grupo][]" value="<?php echo $item_excluir['id']; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="fa fa-check-square-o"></span> Excluir</button>
        </form>
    </fieldset>
<?php }
?>
