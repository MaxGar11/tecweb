<?php 

    namespace backend;
    
    require_once __DIR__.'/myapi/Products.php';

    $productos = new \Products\Products('marketzone');
    $productos->add( file_get_contents('php://input') );
    echo $productos->getData();
?>