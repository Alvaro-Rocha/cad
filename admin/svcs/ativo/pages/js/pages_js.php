<script>
        $(document).ready(function() {    
            $('.modal-title').html('Mensagem');
            $('.modal-body').children('p').html("<?php echo (isset($mensagem)? $mensagem : 'Entrei no javascript')?>")
            $('#myModal').modal('show');
            
        });

        

        //===validando do formulário=============================================================        
        function validarForm(){
            alert('validar entradas do frormulário');
            
            //document.getElementById("meuForm").submit();
            $('form').submit();
        }
        //------------------------------------------------------não usada-------------
       
       
       var danone = 0
       //------------------------Botão de editar o forms---------------------------- 
        $(".edit").on("click", function(){
            var nome = $(this).parents(".acoes").siblings(".nome").html()  // pega o nome do formulario selecioando
            var descricao = $(this).parents(".acoes").siblings(".descricao").html()
            var cont = $(this).parents(".acoes").siblings(".conteudo").html()
            var status = $(this).parents(".acoes").siblings(".status").html()
            var id = $(this).parents(".acoes").siblings(".id").html()
            
            $("#status").val(status)
            $("#nome").val(nome) //adiciona ao input nome - o nome do form selecionado no editar formulario
            $("#descricao").val(descricao) //adiciona ao input descricao - a descricao do form selecionado no editar formulario
            $("#conteudo").val(cont) //adiciona ao input conteudo - o conteudo do form selecionado no editar formulario
            $("#abibli").attr('href', 'biblioteca/biblioteca.php?id=' + id)
            //============================editando modal==================================
            $('.modal-body').children('p').html("Você deseja editar este formulario?")
            $("#modal-btn-T").html(" Sim ")
            $('#myModal').modal('show');
            $("#modal-btn-T").removeClass('d-none')
            if(danone == 1){
                $("#modal-btn-T").addClass('d-none')    
            }
            danone = 1
            //=============================================================================
            //================Quando clicar no Sim do modal===============================
            $("#modal-btn-T").on("click", function(){
                $("#nav-home").removeClass("show")
                $("#nav-home").removeClass("active")
                $("#nav-home-tab").removeClass("active")
                $("#nav-profile").addClass("show")
                $("#nav-profile").addClass("active")
                $("#nav-profile-tab").addClass("active")
                $("#nav-profile-tab").html("Editar Formulario")
                $("#modal-btn-T").addClass('d-none')

                danone = 0
            })
            //======================================================================================
        });
        //-------------------Botão de excluir o forms---------------------------------
        $(".lixo").on("click",function(){
            var form = $(this).parents(".acoes").parents(".lForm")
            $('.modal-body').children('p').html("Você deseja excluir este formulario?")
            $("#modal-btn-V").html("Sim")
            $('#myModal').modal('show');
            $("#modal-btn-V").removeClass('d-none')
            if(danone == 1){
                $("#modal-btn-T").addClass('d-none')    
            }
            danone = 1
            $("#modal-btn-V").on("click", function(){
                $(form).remove()
                $("#modal-btn-V").addClass('d-none')
                danone = 0
            });    
        });

        $("#bot").click(function(){
            $("#nav-profile-tab").html("Novo Formulario")    
        })

        $("#formSub").on("click", function(){
            var nome = $("#nome").val()
            var conteudo = $("#conteudo").val()
            var desc = $("#descricao").val()
            $("#tb").append("<tr class='lForm'>")
            $("#tb").append("<td class='id'>72</td>")
            $("#tb").append("<td class='nome'>"+nome+"</td>")
            $("#tb").append("<td class='ref'>2</td>")
            $("#tb").append("<td class='conteudo'>" + conteudo +"</td>")
            $("#tb").append("<td class='href'>_page_index.php?id=72</td>")
            $("#tb").append("<td class='descricao' hidden>" + desc +"</td>")
            $("#tb").append("<td class='cat' hidden>" +  +"</td>")
            $("#tb").append("<td class='status'>" + 1 +"</td>")
            $("#tb").append("<td class='acoes'><svg class='edit' xmlns='http://www.w3.org/2000/svg' enable-background='new 0 0 24 24' height='24px' viewBox='0 0 24 24' width='24px' fill='#000000'><g><rect fill='none' height='24' width='24'/></g><g><g><g><path d='M3,21l3.75,0L17.81,9.94l-3.75-3.75L3,17.25L3,21z M5,18.08l9.06-9.06l0.92,0.92L5.92,19L5,19L5,18.08z'/></g><g><path d='M18.37,3.29c-0.39-0.39-1.02-0.39-1.41,0l-1.83,1.83l3.75,3.75l1.83-1.83c0.39-0.39,0.39-1.02,0-1.41L18.37,3.29z'/></g></g></g></svg> <svg class='lixo' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#000000'><path d='M0 0h24v24H0V0z' fill='none'/><path d='M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z'/></svg></td>")
            $("#tb").append("</tr>")    
        })
</script>