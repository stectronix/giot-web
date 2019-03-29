    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="js/jquery.validate.min.js"></script>
    <script src="js/messages_es.min.js"></script>
    <script src="js/validate.js"></script> -->
    <script type="text/javascript">
        $(function() {
            $('.boton').on('click', function(e){
                $(this).parents('tbody tr').each(function(){
                    var usuario = "";
                    var perfil = "";

                    usuario += $(this).children()[1].textContent;
                    perfil += $(this).children().find("select").find(":selected").text();

                    alert(usuario + " " + perfil);                    
                    
                })
            });
        });
	</script>
  </body>
</html>