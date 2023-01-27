<?php
$nombre = $_POST['nombre'];
$identificacion = $_POST['identificacion'];
$contacto = $_POST['contacto'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$municipio = $_POST['municipio'];

if(!empty($nombre) || !empty($identificacion) || !empty($contacto) || !empty($email) || !empty($direccion) || !empty($municipio)){

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "clientes";

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error()){
        die('connect error('.mysqli_connect_error().')'.myslqi_conect_error());
    }
}

else{
    $SELECT = "SELECT identificacion from usuario where telefono = ? limit 1 ";
    $INSERT = "INSERT INTO usuario (nombre,identificacion,contacto,email,direccion,municipio)values(?,?,?,?,?,?)";

    $stmt = $conn->prepare($SELECT);
    $stmt ->bind_param("i", $identificacion);
    $stmt ->execute();
    $stmt ->bind_result($identificacion);
    $stmt ->store_result();
    $rnum = $stmt ->num_rows;
    if($rnum == 0){
        $stmt ->close();
        $stmt = $conn->prepare($INSERT); 
        $stmt ->bind_param("siisss", $nombre,$identificacion,$contacto,$email,$direccion,$municipio);
        $stmt ->execute();
        echo "REGISTRO EXITOSO.";
    }
    else{
        echo "alguien ya se registro. ";
    }
    $stmt->close();
    $conn->close();
    
}

else{
    echo "todos los datos son obligatorios"
    die();
}



?>