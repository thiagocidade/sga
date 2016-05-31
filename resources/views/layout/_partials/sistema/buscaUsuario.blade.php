<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    var usuarios = [];
    function removeItem(id) {
        //frutas = ['maçã', 'banana', 'pera', 'uva'];
        usuarios = $.grep(usuarios, function(val, index) {
            return val != id;
        });
    }

    function remove_user(id) {
        $("#user_"+id).hide();
        $("li:has('a'):contains('Edit group')").remove();
        removeItem(id);
    }

    $(function() {


        function log( message, id ) {
            $( "<li id='user_" + id + "'>" ).html( message ).prependTo( "#log" );
        }


        function checkUserList(id) {
            //se o array não estiver vazio, ele busca pelo ID do usuario a ser adicionado
            if(usuarios.length != 0){
                //percorre todoo o array em busca de o ID selecionado já está adicionado
                for ( var i = 0, j = usuarios.length; i < j; i++ ) {
                    if(usuarios[i] == id){
                        return true;
                    }
                }
            }
        }

        $( "#birds" ).autocomplete({
            source: "{{url('sistema/usuario/buscaUsuario')}}",
            minLength: 2,
            select: function( event, ui ) {

                if (checkUserList(ui.item.id)){
                    alert('O usuário já foi adicionado!');
                    return false;
                }

                //adiciona novo elemento no final do array de usuários
                usuarios.push( ui.item.id );

                //adiciona no html o usuário selecionado
                log( ui.item ?
                "<span class=\"glyphicon glyphicon-remove\" onclick=\"remove_user("+ui.item.id+")\"></span>"+ui.item.value + "<input type='hidden' id='1' value='"+ui.item.id+"' name='user[]' >":
                "Nothing selected, input was " + this.value , ui.item.id);

                //limpa o campo para digitar o nome do usuário procurado
                $(this).val("");
                return false;
            }
        });
    });

</script>