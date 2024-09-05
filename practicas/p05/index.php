<?php
# EJERCICIO 1
$variables = [
    '$_myvar' => 'valida',
    '$_7var' => 'valida',
    'myvar' => 'invalida',
    '$myvar' => 'valida',
    '$var7' => 'valida',
    '$_element1' => 'valida',
    '$house*5' => 'inválida'
];

# EJERCICIO 2

$a = "ManejadorSQL";
$b = 'MySQL';
$c = &$a;

print_r($a);
echo '<br>';
print_r($b);
echo '<br>';
print_r($c);
echo '<br>';


#  inciso b

$a = "PHP server";
$b = &$a;

echo $a. '<br>';
echo $b. '<br>';

?>
