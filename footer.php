<div class="container">
    <hr>
    <footer>
        &copy; 2015 Company, Inc.
        <?php if($isUserConnected){ ?>
        <a class="btn btn-default pull-right" href="<?php echo $documentRoot; ?>/utilisateur/contact.php" role="button">Nous contacter</a>
        <?php } ?>
    </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>

<script>
    $('#mdp2').on('input change', function (){
        if($('#mdp2').val() !== $('#mdp1').val()){
            $('#mdp2group').attr('class', 'form-group has-error');
        }else{
            $('#mdp2group').attr('class', 'form-group has-success');
        }
        $('#mdp2').popover('hide');
    });
    
    $('#mdp2').on('focus', function (e){
        $('#mdp2').popover('hide');
    });
    
    function checkForm(form){
        if(form.mdp2.value !== form.mdp1.value){
            $('#mdp2').popover('show');
            return false;
        }
        return true;
    }
</script>



