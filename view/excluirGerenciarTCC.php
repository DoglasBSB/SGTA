<?php
#mostrar os dados do gerenciar TCC
foreach ($gerenciartccs_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados do gerenciar TCC -->
            <label for="id">Código</label>
            <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir['id']; ?>" />           
            <label for="nome">Tema</label>
            <input class="form-control"required type="text" readonly="true" name="tema" id="tema" value="<?php echo $item_excluir['tema']; ?>" maxlength="150">
            <label for="ano">Ano</label> <br>
            <input class="form-control"  type="text"  name="dados[ano][]" value="<?php echo $item_alterar['ano']; ?>"/>
            <label for="semestre">Semestre</label> <br>
            <input class="form-control"  type="text"  name="dados[semestre][]" value="<?php echo $item_alterar['semestre']; ?>"/>
            <!-- input oculto para informar o id do gerenciar TCC-->
            <input type="hidden" name="dados[id_gerenciartcc][]" value="<?php echo $item_excluir['id']; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="fa fa-check-square-o"></span> Excluir</button>
        </form>
    </fieldset>
<?php } ?>
