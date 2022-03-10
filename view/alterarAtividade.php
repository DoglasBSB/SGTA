<?php
#mostrar os dados da atividade
foreach ($atividades_alterar as $item_alterar) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados da atividade -->
            <label for="id">Código</label>
            <input class="form-control" name="dados[id_atividade][]" type="text" readonly="true" id="id_atividade" value="<?php echo $item_alterar['id']; ?>" />
            <label for="nome_atividade">Nome da Atividade</label>
            <input class="form-control" required type="text" name="dados[nome_atividade][]"  id="nome_atividade" value="<?php echo $item_alterar['nome_atividade']; ?>"  maxlength="100"/>
            <label for="fase">Fase</label> <br>
            <select class="form-control" name="dados[fase][]"   value="<?php echo $item_alterar['fase']; ?>"  >
                <option value="PPTI">PPTI</option>
                <option value="TCC">TCC</option>
                <option value="OUTROS">OUTROS</option>
            </select>
            <label for="prazo">Prazo</label> <br>
            <input class="form-control" type="text" name="dados[prazo][]"  id="prazo"  maxlength="8"  value="<?php echo $item_alterar['prazo']; ?>" placeholder="Prazo da atividade"/> <br>
            <label for="status">Status</label> <br>            
            <select class="form-control" name="dados[status][]" readonly="true" id="status" value="<?php echo $item_alterar['status']; ?>" >
                <option value="Iniciada">Iniciada</option>
                <option value="Em andamento">Em andamento</option>
                <option value="Concluida">Concluida</option>
            </select>
            </br>
            <!-- input oculto para informar o id da atividade-->
            <input type="hidden" name="dados[id_atividade][]" value="<?php echo $item_alterar['id']; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="fa fa-edit"></span> Alterar</button>
        </form>       
    </fieldset>
    <?php
}
?>
