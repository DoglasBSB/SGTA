<?php
#mostrar os dados do grupo
foreach ($grupos_alterar as $item_alterar) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados do grupo -->
            <label for="id">Código</label>
            <input class="form-control" name="dados[id_grupo][]" type="text" readonly="true" id="id_grupo" value="<?php echo $item_alterar[id]; ?>" />
            <label for="nome">Nome do Grupo</label>
            <input class="form-control"  type="text" required="" name="dados[nome][]" id="nome" value="<?php echo $item_alterar[nome]; ?>"  maxlength="100"/>
            <label for="email">Email</label>
            <input class="form-control" id="email" required=""  name="dados[email][]" type="text" value="<?php echo $item_alterar[email]; ?>" title="Qual seu email?" maxlength="150">
            </br>
            <!-- input oculto para informar o id do grupo-->
            <input type="hidden" name="dados[id_grupo][]" value="<?php echo $item_alterar[id]; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"> <span class="fa fa-edit"></span> Alterar</button>
        </form>       
    </fieldset>
    <?php
}
?>
