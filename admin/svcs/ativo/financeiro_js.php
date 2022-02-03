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
</script>