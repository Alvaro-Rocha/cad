<script>
//====================================================================================================
//Mudar Cpf para cnpj e vice-versa
$("#checkInput").on("click",function(){
    var checkbox = document.getElementById("checkInput")
     if(checkbox.checked){
        //alert("checado")
        $("#industry").removeClass("text-success")
        $("#person").addClass("text-success")
        $("#cpfcnpjLabel").html("Digite o CPF")
        $("#cpfcnpj").attr("placeholder", "000.000.000-00")
        $("#indica").val("0")
     }else{
        //alert("não checado")
        $("#industry").addClass("text-success")
        $("#person").removeClass("text-success")
        $("#cpfcnpjLabel").html("Digite o CNPJ")
        $("#cpfcnpj").attr("placeholder", "00.000.000/0000-00")
        $("#indica").val("1")
     }
})
//================================================================================================
//adicionar data de hoje a data cadastrada
var data = new Date();
var dia = data.getDate();
var mes = (data.getMonth() + 1);
var ano = data.getFullYear();
var dataAtual =  ano + "-0" + mes + "-0" + dia;
//alert(dataAtual)
$("#dataC").val(dataAtual)
$("#botaoS").on("click", function(){
    alert("oi");
    Window.open("complemento/complemento.php");
    return false;
});






//================================================================================================
//Mandar arquivos de um select para o outro
function mover(fonte, destino) {
            
            var selecionados = fonte.querySelectorAll("option:checked");
            
            for ( var i = 0 ; i < selecionados.length ; i++ ) {
                fonte.removeChild(selecionados[i]);
                destino.appendChild(selecionados[i]);
                
            }
            
        }

        document.querySelector("i.dir").onclick = function() {
            mover(document.querySelector("select.esq"),
            document.querySelector("select.dir"));
        };
        

        document.querySelector("i.esq").onclick = function() {
            mover(document.querySelector("select.dir"),
            document.querySelector("select.esq"));
        };
//=========================================================================================================
</script>