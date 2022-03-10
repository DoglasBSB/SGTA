<?php
#mostrar os dados das atividades
foreach ($atividades_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form id="atividade" name="atividade" method="post" action="">
            <!-- dados das atividades -->
            <label for="id">Código</label>
            <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir['id']; ?>" />
            <label for="nome_atividade">Nome</label>
            <input class="form-control"required type="text" readonly="true" name="nome_atividade" id="nome_atividade" value="<?php echo $item_excluir['nome_atividade']; ?>" maxlength="150">
            <label for="fase">Fase</label> <br>
            <input class="form-control"  type="text"  readonly="true" name="dados[fase][]" value="<?php echo $item_excluir['fase']; ?>"/>
            <label for="prazo">Prazo</label> <br>
            <input class="form-control" type="text" name="dados[prazo][]"  readonly="true"  id="prazo"  maxlength="8"  value="<?php echo $item_excluir['prazo']; ?>" placeholder="Prazo da atividade"/> <br>
            <label for="status">Status</label> <br>            
            <select class="form-control" name="dados[status][]" readonly="true" id="status" value="<?php echo $item_excluir['status']; ?>" >
                <option value="Iniciada">Iniciada</option>
                <option value="Em andamento">Em andamento</option>
                <option value="Concluida">Concluida</option>
            </select>
            <!-- input oculto para informar o id da atividade  required id="fase"-->
            <input type="hidden" name="dados[id_atividade][]" value="<?php echo $item_excluir['id']; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="fa fa-check-square-o"></span> Excluir</button>
        </form>
    </fieldset>
<?php } ?>
