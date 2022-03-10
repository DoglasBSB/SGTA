<script src="../public/js/mascara.js"></script>
<?php
#mostrar os dados do aluno
foreach ($alunos_alterar as $item_alterar) {
    ?>

    <fieldset>
        <form method="post" action="">
            <!-- dados do aluno -->
            <label for="id">Código</label>
            <input class="form-control" name="dados[id_aluno][]" type="text" readonly="true" id="id_aluno" value="<?php echo $item_alterar['id']; ?>" />
            <label for="nome">Nome</label>
            <input class="form-control" required type="text" name="dados[nome][]" id="nome" value="<?php echo $item_alterar['nome']; ?>"  maxlength="150"/>
            <label for="cpf">CPF</label>
            <input class="form-control" required id="cpf" name="dados[cpf][]" type="text" value="<?php echo $item_alterar['cpf']; ?>" title="Qual seu CPF?" maxlength="14" title="Digite o CPF somente numeros" onkeypress="mascara(this, '###.###.###-##')">
            <label for="matricula">Matricula</label>
            <input class="form-control" readonly="true" required id="matricula" name="dados[matricula][]" value="<?php echo $item_alterar['matricula']; ?>" type="text" title="Qual é a sua matricula?" maxlength="6">
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" name="dados[telefone][]" type="text" value="<?php echo $item_alterar['telefone']; ?>" title="Qual seu telefone?" maxlength="12" onkeypress="mascara(this, '## ####-####')">
            <label for="email">Email</label>
            <input class="form-control" id="email" name="dados[email][]" type="text" value="<?php echo $item_alterar['email']; ?>" title="Qual seu email?" maxlength="150">
            </br>
            <!-- input oculto para informar o id do aluno-->
            <input type="hidden" name="dados[id_aluno][]" value="<?php echo $item_alterar['id']; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="fa fa-edit"></span> Alterar</button>
        </form>       
    </fieldset>
    <?php
}
?>
