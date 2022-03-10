<?php
#mostrar os dados do docente
foreach ($docentes_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form id="docente" name="docente" method="post" action="">
            <!-- dados do docente -->
            <label for="id">Código</label>
            <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir['id']; ?>" />
            <label for="nome">Nome</label>
            <input class="form-control"required type="text" readonly="true" name="nome" id="nome" value="<?php echo $item_excluir['nome']; ?>" maxlength="150">
            <label for="cpf">CPF</label>
            <input class="form-control"required id="cpf" readonly="true" name="cpf" type="text" value="<?php echo $item_excluir['cpf']; ?>" title="Qual seu CPF?" maxlength="14" title="Digite o CPF somente numeros">
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" name="telefone" readonly="true" type="text" value="<?php echo $item_excluir['telefone']; ?>" title="Qual seu telefone?" maxlength="12">
            <label for="email">Email</label>
            <input class="form-control" id="email" name="email" readonly="true" type="text" value="<?php echo $item_excluir['email']; ?>" title="Qual seu email?" maxlength="150">
            <!-- input oculto para informar o id do docente-->
            <input type="hidden" name="dados[id_docente][]" value="<?php echo $item_excluir['id']; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"> <span class="fa fa-check-square-o"></span> Excluir</button>
        </form>
    </fieldset>
<?php } ?>
