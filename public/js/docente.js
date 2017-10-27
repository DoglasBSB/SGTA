$(document).ready(function() {

  
    $("#cpf").mask('999.999.999-99');
    $("#alterar_cpf").mask('999.999.999-99');
    $("#telefone").mask('(99) 9999-9999');
    $("#alterar_telefone").mask('(99)9999-9999');
  




    $( "#inserir" ).click(function() {
       $( "#nome").submit();

    });
   


    $('#sandbox-container .input-group.date').datepicker({
        language: "pt-BR",
        orientation: "top auto"
    });

    
    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g,'');
        if(cpf == '') return false;
        // Elimina CPFs invalidos conhecidos
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito
        add = 0;
        for (i=0; i < 9; i ++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito
        add = 0;
        for (i = 0; i < 10; i ++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;
        return true;
    }

    $( "#cpf" ).keypress(function( event ) {
        var cpf = $( "#cpf" ).val();
        var valor =  cpf.replace(/[^\d]+/g, "");

        if(valor.length == 11){
            var valida =validarCPF(valor);
            if(valida==false){
                $('#validacaocpf').show();
            }else{
                $('#validacaocpf').hide();
            }

        }

    });

    $("#formDocente").validate({
        // Define as regras
        rules:{
            nome:{
                // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            email:{
                // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, email: true
            }
           
        },
        // Define as mensagens de erro para cada regra
        messages:{
            nome:{
                required: "Digite o seu nome",
                minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
            },
            email:{
                required: "Digite o seu e-mail para contato",
                email: "Digite um e-mail válido"
            },        
            telefone:{
                required: "Digite o Telefone",

            }
        }
    });
   
    
});
