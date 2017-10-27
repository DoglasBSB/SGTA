<script src="../public/js/mascara.js"></script>
<?php
#mostrar os dados do docente
foreach ($docentes_alterar as $item_alterar) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados do docente -->
            <label for="id">Código</label>
            <input class="form-control" name="dados[id_docente][]" type="text" readonly="true" id="id_docente" value="<?php echo $item_alterar[id]; ?>" />
            <label for="nome">Nome</label>
            <input class="form-control" required type="text" name="dados[nome][]" id="nome" value="<?php echo $item_alterar[nome]; ?>"  maxlength="150"/>
            <label for="cpf">CPF</label>
            <input class="form-control" required id="cpf" name="dados[cpf][]" type="text" value="<?php echo $item_alterar[cpf]; ?>" title="Qual seu CPF?" maxlength="14" title="Digite o CPF somente numeros" onkeypress="mascara(this, '###.###.###-##')">
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" name="dados[telefone][]" type="text" value="<?php echo $item_alterar[telefone]; ?>" title="Qual seu telefone?" maxlength="14" onkeypress="mascara(this, '## ####-####')">
            <label for="email">Email</label>
            <input class="form-control" id="email" name="dados[email][]" type="text" value="<?php echo $item_alterar[email]; ?>" title="Qual seu email?" maxlength="150">
            </br>
            <!-- input oculto para informar o id do docente-->
            <input type="hidden" name="dados[id_docente][]" value="<?php echo $item_alterar[id]; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="fa fa-edit"></span> Alterar</button>
        </form>       
    </fieldset>
    <?php
}
?>
