<script>
    //===============================================================================
    //cor nos bonecos de masculino e feminino
    $(".fa-male").on("click", function(){
        $(this).addClass("azul")
        $(".fa-female").removeClass("rosa")
    })
    $(".fa-female").on("click", function(){
        $(this).addClass("rosa")
        $(".fa-male").removeClass("azul")
    })
    //================================================================================
    //cadastro -pessoal/imagens da identidade 
    $(".naturalidade").on("click", function() {
        $(".modal-body").empty()
        $(".modal-body").append("<img src='img/naturalidade.png'>")
        $('#myModal').modal('show')
    });
    $(".RG").on("click", function() {
        $(".modal-body").empty()
        $(".modal-body").append("<img src='img/rg.png'>")
        $('#myModal').modal('show')
    });
    $(".dExpedicao").on("click", function() {
        $(".modal-body").empty()
        $(".modal-body").append("<img src='img/dexpedicao.png'>")
        $('#myModal').modal('show')
    });
    $(".UF").on("click", function() {
        $(".modal-body").empty()
        $(".modal-body").append("<img src='img/uf.png'>")
        $('#myModal').modal('show')
    })
    $(".Org").on("click", function() {
        $(".modal-body").empty()
        $(".modal-body").append("<img src='img/org.png'>")
        $('#myModal').modal('show')
    })
    //==================================================================
    //Cadastro - Contatos/ select
</script>