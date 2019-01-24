<?php


    require('conecta.php');
    
    $nome = $_POST['nome'];

    //Consultando banco de dados
    $qryLista = mysqli_query($con, "SELECT * FROM medicos WHERE nome like '%$nome%'");    
    while($resultado = mysqli_fetch_assoc($qryLista)){
        $vetor[] = array_map('utf8_encode', $resultado); 
    }    
    
    //Passando vetor em forma de json
    echo json_encode($vetor);

    ?>