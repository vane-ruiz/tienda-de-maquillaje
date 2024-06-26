<?php
    date_default_timezone_set("America/Bogota");
    require('conexion.php');

    // If form submitted, insert values into the database.
    if (isset($_REQUEST['usu_usu'])) {
        $usu_usu = stripslashes($_REQUEST['usu_usu']); // removes backslashes
        $usu_usu = mysqli_real_escape_string($mysqli,$usu_usu); //escapes special characters in a string
        $pass_usu = stripslashes($_REQUEST['pass_usu']);
        $pass_usu = mysqli_real_escape_string($mysqli,$pass_usu);
        $nom_usu = stripslashes($_REQUEST['nom_usu']);
        $tipo_usu = 9;
        
        // Check if the username already exists in the database
        $check_query = "SELECT * FROM usuarios WHERE usu_usu = '$usu_usu'";
        $check_result = mysqli_query($mysqli, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            // If the username already exists, show a message
            echo "<center><p style='border-radius: 20px;box-shadow: 10px 10px 5px #c68615; font-size: 23px; font-weight: bold;'>El usuario ya está registrado. Por favor, elija otro nombre de usuario.</p></center>";
        } else {
            // If the username doesn't exist, proceed with the registration
            $query = "INSERT INTO `usuarios` (usu_usu, pass_usu, tipo_usu, nom_usu) VALUES ('$usu_usu', '".sha1($pass_usu)."', '$tipo_usu', '$nom_usu')";
            $result = mysqli_query($mysqli, $query);
        
            // Check if data is inserted successfully
            if ($result) {
                echo "<center><p style='border-radius: 20px;box-shadow: 10px 10px 5px #c68615; font-size: 23px; font-weight: bold;'>REGISTRO CREADO SATISFACTORIAMENTE</p></center>
                    <div class='form' align='center'><h3>Regresar para iniciar la sesión... <br/><br/><center><a href='index.php'>Regresar</a></center></h3></div>";
            } else {
                echo "Error al insertar datos en la base de datos: " . mysqli_error($mysqli);
            }
        }
    } else {
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SENA</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.j"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fed2435e21.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .responsive {
            max-width: 100%;
            height: auto;
        }
    </style>
    <script>
        function ordenarSelect(id_componente)
        {
            var selectToSort = jQuery('#' + id_componente);
            var optionActual = selectToSort.val();
            selectToSort.html(selectToSort.children('option').sort(function (a, b) {
                return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
            })).val(optionActual);
        }
        $(document).ready(function () {
            ordenarSelect('selectIE');
        });
    </script>
</head>
<body>

<center>
            <img src='img/logoSena.png' class="responsive">
        </center>
<br />

<div class="container">
    <h1><b><i class="fas fa-users"></i> REGISTRO DE UN NUEVO USUARIO</b></h1>
    <p><i><b><font size=3 color=#c68615>*Datos obligatorios</i></b></font></p>
    <form action='' method="POST">
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <label for="nom_usu">* NOMBRES COMPLETOS (persona que se registra):</label>
                    <input type='text' name='nom_usu' class='form-control' id="nom_usu" required autofocus style="text-transform:uppercase;" />
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <label for="usu_usu">* USUARIO (minúsculas, sin espacios, ni caracteres especiales):</label>
                    <input type='text' name='usu_usu' id="usu_usu" class='form-control' required />
                </div>
                <div class="col-12 col-sm-6">
                    <label for="pass_usu">* PASSWORD (no tiene restricción):</label>
                    <input type='pass_usu' name='pass_usu' id="pass_usu" class='form-control' required style="text-transform:uppercase;" />
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-warning">
            <span class="spinner-border spinner-border-sm"></span>
            REGISTRAR USUARIO
        </button>
        <button type="reset" class="btn btn-outline-dark" role='link' onclick="history.back();" type='reset'><img src='img/atras.png' width=27 height=27> REGRESAR
        </button>
    </form>
</div>

</body>
</html>

<?php
    }
?>
