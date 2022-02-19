<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Arreglos Asociativos</title>
</head>

<body>

    <?php
    
    session_start(); //iniciar session

    if (!array_key_exists('form_counter', $_SESSION)) { //verificar que el contador exista
        $_SESSION['form_counter'] = 0;
    }
     //Reiniciar formulario 
    if (isset($_POST['reiniciar'])) { 
        unset($_SESSION['empleado']);
        $_SESSION['form_counter'] = 0;
        echo "Reinicio Completado";
    }
    //verificar que no ha alcanzado los tres empleados
    if ($_SESSION['form_counter'] >= 3 && isset($_POST['submit'])) {

        echo "solo se permiten tres empleados";
    } else { //Agregar empleado
        if (!isset($_SESSION['empleado'])) {
            $_SESSION['empleado'] = array(); //Creando arreglo asociativo del mismo
        }

        if (isset($_POST['submit'])) { 
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $cedula = $_POST["cedula"];
            $sueldo = $_POST["sueldo"];
            $dept = $_POST["dept"];
            $lugar = $_POST["lugar"];


            if (
                empty($cedula) || empty($nombre) || empty($apellido) || empty($sueldo)
                || empty($dept) || empty($lugar) //Revisar que todos los campos del formulario esten llenados
            ) { 
                echo "Rellena todos los campos";
            } else {
              
                $empleado = array( //Insertar key y values del arreglo asociativo
                    "cedula" => $cedula,
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "sueldo" => $sueldo,
                    "departamento" => $dept,
                    "lugar de trabajo" => $lugar
                );



                if (isset($_SESSION['empleado'][$cedula])) { //Verificar si el empleado ya existe
                    echo "se ha modificado el empleado con cedula: " . $cedula;
                } else {
                    echo "Se ha insertado un nuevo empleado";
                    
                }

                $_SESSION['empleado'][$cedula] = $empleado;

                $_SESSION['form_counter']++;     //Contador para las sesiones
               
            }
        }
    }

    ?>
         <!--Formulario con bootstrap -->
    <div class="container md-8">
        <form action="" method="post">
            <div class="form-group">
                <label for="Nombre">Nombre:</label>
                <input type="text" class="form-control"  name="nombre" placeholder="Ingrese Nombre">
            </div>
            <div class="form-group">
                <label for="Nombre">Apellido:</label>
                <input type="text" class="form-control"  name="apellido" placeholder="Ingrese Apellido">
            </div>
            <div class="form-group">
                <label for="Nombre">Cedula:</label>
                <input type="text" class="form-control"  name="cedula" placeholder="Ingrese Cedula">
            </div>
            <div class="form-group">
                <label for="Nombre">Sueldo:</label>
                <input type="text" class="form-control"  name="sueldo" placeholder="Ingrese Nombre">
            </div>
            <div class="form-group">
                <label for="Nombre">Departamento:</label>
                <input type="text" class="form-control"  name="dept" placeholder="Ingrese el Departamento">
            </div>
            <div class="form-group">
                <label for="Nombre">Lugar de Trabajo:</label>
                <input type="text" class="form-control"  name="lugar" placeholder="Ingrese Lugar de Trabajo">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Agregar</button>
            <button type="submit" class="btn btn-primary" name="mostrar">Mostrar</button>
            <button type="submit" class="btn btn-primary" name="reiniciar">Reiniciar</button>

        </form>
    </div>

        <?php
         //Tabla para mostrar los valores agregados
        if (isset($_POST['mostrar'])) {
            if (count($_SESSION['empleado']) === 0) {
                echo "<p>No hay empleados</p>";
            } else {
                echo "<table border=1>";
                echo "<tr>";

                echo "<th>Cedula</th>";
                echo "<th>Nombre</th>";
                echo "<th>Apellido</th>";
                echo "<th>Sueldo</th>";
                echo "<th>Departamento</th>";
                echo "<th>Lugar de trabajo</th>";
                echo "</tr>";

                foreach ($_SESSION['empleado'] as $key => $value) {
        ?>
                    <tr>
                        <td><?php echo $value['cedula']; ?></td>
                        <td><?php echo $value['nombre']; ?></td>
                        <td><?php echo $value['apellido']; ?></td>
                        <td><?php echo $value['sueldo']; ?></td>
                        <td><?php echo $value['departamento']; ?></td>
                        <td><?php echo $value['lugar de trabajo']; ?></td>


                    </tr>

        <?php
                }


                echo "</table>";
            }
        }


        ?>

        <?


        ?>


    </form>

</body>

</html>