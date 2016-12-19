<?php
namespace attribut_simple {
    $var1 = 1;
    function  exporter($var){
        $var++;
        return $var;
    }

    $var2 = exporter($var1);

    $var1++;

    var_dump($var1);
    var_dump($var2);
}
//-----------------------------------

namespace attribut_reference {
    $var1 = 1;

    function  exporter(&$var){
        $var++;
        return $var;
    }

    $var2 = exporter($var1);

    $var1++;

    var_dump($var1);
    var_dump($var2);
}
//-----------------------------------

namespace attribut_return_reference1 {
    $var1 = 1;

    function  &exporter(&$var){
        $var++;
        return $var;
    }

    $var2 = exporter($var1);

    $var1++;

    var_dump($var1);
    var_dump($var2);
}
//-----------------------------------
namespace attribut_return_reference2 {
    $var1 = 1;

    function  &exporter(&$var){
        $var++;
        return $var;
    }

    $var2 = &exporter($var1);

    $var1++;

    var_dump($var1);
    var_dump($var2);
}
//-----------------------------------
namespace return_reference {
    $var1 = 1;

    function  &exporter($var){
        $var++;
        return $var;
    }

    $var2 = &exporter($var1);

    $var1++;

    var_dump($var1);
    var_dump($var2);
}
//-----------------------------------
namespace objet_reference {
    class Foo {
       public $value = 42;

       public function &getValue() {
           return $this->value;
       }
    }

    $foo = new Foo();
    $var = &$foo->getValue();
    $foo->value = 2;

    var_dump($var);
}

namespace tableau_reference {

    $arr = array(1, 2, 3, 4);
    foreach ($arr as &$value) {
        $value = $value * 2;
    }
    var_dump($arr);//renvoie :  array(2, 4, 6, 8)
    // Détruit la référence sur le dernier élément
    unset($value);
}
namespace tableau_associatif_reference {
    
    $arr = array('a'=>'a', 'b'=>'b', 'c'=>'c');
    foreach ($arr as &$a);
    foreach ($arr as $a);
    var_dump($arr);//renvoie :  array('a'=>’a’, 'b'=>’b’, 'c'=>’b’);
}