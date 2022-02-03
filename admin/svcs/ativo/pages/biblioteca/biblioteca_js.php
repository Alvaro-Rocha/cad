<script>
        $(document).ready(function() {    
            $('.modal-title').html('Mensagem');
            $('.modal-body').children('p').html("<?php echo (isset($mensagem)? $mensagem : 'Entrei no javascript')?>")
            $('#myModal').modal('show');
        });
        function mover(fonte, destino) {
            
            var selecionados = fonte.querySelectorAll("option:checked");
            
            for ( var i = 0 ; i < selecionados.length ; i++ ) {
                fonte.removeChild(selecionados[i]);
                destino.appendChild(selecionados[i]);
                
            }   
        }
        //=============================================================
        document.querySelector("i.dira").onclick = function() {
            mover(document.querySelector("select.esqa"),
            document.querySelector("select.dira"));
        };
        

        document.querySelector("i.esqa").onclick = function() {
            mover(document.querySelector("select.dira"),
            document.querySelector("select.esqa"));
        };
        //=========================================================
        document.querySelector("i.dirb").onclick = function() {
            mover(document.querySelector("select.esqb"),
            document.querySelector("select.dirb"));
        };
        

        document.querySelector("i.esqb").onclick = function() {
            mover(document.querySelector("select.dirb"),
            document.querySelector("select.esqb"));
        };
        //=========================================================
        document.querySelector("i.dirc").onclick = function() {
            mover(document.querySelector("select.esqc"),
            document.querySelector("select.dirc"));
        };
        

        document.querySelector("i.esqc").onclick = function() {
            mover(document.querySelector("select.dirc"),
            document.querySelector("select.esqc"));
        };
        //============================================================
        //===validando do formulário=============================================================        
        function validarForm(){
            alert('validar entradas do frormulário');
            
            //document.getElementById("meuForm").submit();
            $('form').submit();
        }
        //------------------------------------------------------não usada-------------  

       

</script>