<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Associação de caça</title>
</head>
<body>
    <?php
        session_start();
        include 'database/basedados.h';


        if(isset($_SESSION['utilizador']))
        {
            echo
            "
            <header>
                <div class='navbar'>
                    <h1>Associação de caça</h1>
                    <ul>
                        <li><a href='index.php'>Inicio</a></li>
                        <li><a href='about.php'>Quem somos</a></li>
                        <li><a href='gallery.php'>Galeria</a></li>
                        <li><a href='p_areaPessoal.php'>Área Pessoal</a></li>
                        <li><a href='logout/logout.php'>Terminar sessão</a></li>
                    </ul>
                </div>
            </header>
            ";
        }
        else
        {   
            echo
            "
            <header>
                <div class='navbar'>
                    <h1>Associação de caça</h1>
                    <ul>
                        <li><a href='index.php'>Inicio</a></li>
                        <li><a href='register/p_register.php'>Ser sócio</a></li>
                        <li><a href='p_eventosPublico.php'>Calendario de Eventos</a></li>
                        <li><a href='about.php'>Quem somos</a></li>
                        <li><a href='gallery.php'>Galeria</a></li>
                        <li><a href='login/p_login.php'>Iniciar sessão</a></li>
                    </ul>
                </div>
            </header>
            ";
        }
    ?>

    <div class="grid-container">
        <div class="grid-item">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50773.63895474563!2d-8.600383760199342!3d37.310478613466074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1b226cb062b98f%3A0xa9bf05c7974b0818!2sSerra%20de%20Monchique!5e0!3m2!1spt-PT!2spt!4v1591719893323!5m2!1spt-PT!2spt" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>

        <div class="grid-item">
            <h1>Quem somos?</h1>
            <p>Uma Associação de Caça jovem com o objetivo de proporcionar aos seus sócios, os melhores eventos de caça que alguma vez participaram</p>
            <br>
            <br>
            <p>📍 Morada : Rua de Pedra, nº2, 8551-909, Serra de Monchique.</p>
            <br>
            <p>📞 Contacto : +351 210000123</p>
            <br>
            <p>📧 E-Mail : associacao@gmail.com</p>
            <br>
            <br>
            <h1>Presidencia</h1>
            
            <?php
                $sql = "SELECT u.nome, up.dataInicio, up.dataFim FROM utilizador AS u INNER JOIN utilizadopresidente AS up ON (u.codUtilizador = up.codUtilizador) WHERE dataFim = 0000-00-00"; 
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);

                echo
                "
                <table>
                    <thead>
                        <th>Nome</th>
                        <th>Data Inicio</th>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td><p>".$row['nome']."</p></td>
                            <td><p>".$row['dataInicio']."</p></td>
                            <td><p> Até atualidade </p></td>  
                        </tr>
                    </tbody>
                </table>";
            ?>

        </div>
    </div>
</body>
</html>