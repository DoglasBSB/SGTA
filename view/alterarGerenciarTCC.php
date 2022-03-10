<script src="../public/js/mascara.js"></script>
<?php
#mostrar os dados do gerenciar TCC
foreach ($gerenciartccs_alterar as $item_alterar) {
    ?>

    <fieldset>
        <form method="post" action="">
            <!-- dados do gerenciar TCC -->
            <label for="id">Código</label>
            <input class="form-control" name="dados[id_gerenciartcc][]" type="text" readonly="true" id="id_gerenciartcc" value="<?php echo $item_alterar['id']; ?>" />
            <label for="nome">Tema</label>
            <input class="form-control" required type="text" name="dados[tema][]" id="tema" value="<?php echo $item_alterar['tema']; ?>"  maxlength="150"/>
            <label for="ano">Ano</label>
            <input class="form-control" required type="text" name="dados[ano][]" id="ano" value="<?php echo $item_alterar['ano']; ?>"  maxlength="6"/>
            <label for="semestre">Semestre</label>
            <select class="form-control" name="dados[semestre][]" id="semestre" value="<?php echo $item_alterar['semestre']; ?>" >
                <option value="1º Semestre">1º Semestre</option>
                <option value="2º Semestre">2º Semestre</option>
                <option value="3º Semestre">3º Semestre</option>
                <option value="4º Semestre">4º Semestre</option>
                <option value="5º Semestre">5º Semestre</option>
                <option value="6º Semestre">6º Semestre</option>
                <option value="7º Semestre">7º Semestre</option>
                <option value="8º Semestre">8º Semestre</option>
            </select>
            </br>
            <!-- input oculto para informar o id do gerenciar TCC-->
            <input type="hidden" name="dados[id_gerenciartcc][]" value="<?php echo $item_alterar['id']; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="fa fa-edit"></span> Alterar</button>
        </form>       
    </fieldset>
    <?php
}
?>
