<!--Alertas--><script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- Script para os aletas que sao dados ao utilizador -->
<script type='text/javascript'>
    window.onload=function(){
        Swal.fire({
            title: "<?php echo $_SESSION['title']?>",
            text: "<?php echo $_SESSION['text']?>",
            icon: "<?php echo $_SESSION['icon']?>"
        }).then(function() {
            window.location = "<?php echo $_SESSION['url']?>";
        }); 
    }
</script> 



<!--Script para mostrar a password -->
<script type='text/javascript'>
    function verPassword() 
    {
        var x = document.getElementById("pw");
        if (x.type === "password") 
        {
            x.type = "text";
        }
        else 
        {
            x.type = "password";
        }
    }
</script>