<?php 
    require __DIR__.'/vendor/autoload.php';

    use \App\Validation\Cpf;

    $resultado = Cpf::validar("044.726.539-30");
    var_dump($resultado);
?>