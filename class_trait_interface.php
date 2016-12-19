<?php
interface Inter {
    const CONSTANTE_Inter1 = '<p>CONSTANTE_Inter1</p>';
}

interface Inter1  extends Inter {
    function fonction_inter1($var=1);
}

trait Trait1 {//pas de constantes dans les traits

    public $_var_trait1='<p>var_trait1</p>';

    public function fonction_trait(){
        echo '<p>appel 2 '.__TRAIT__.'::'.__FUNCTION__.'</p>';
        echo '<p>appel 2 '.__CLASS__.'::'.__FUNCTION__.'</p>';
    }
    
    static protected function static_fonction_trait1() {
        echo '<p>appel 5 '.__TRAIT__.'::'.__FUNCTION__.'</p>';
    }

}

trait Trait2 {

    public $_var_trait2='<p>var_trait2</p>';

    private function fonction_trait(){//conflit de nom entre les méthodes de Trait1 et Trait2
        echo '<p>appel 2 '.__TRAIT__.'::'.__FUNCTION__.'</p>';
        echo '<p>appel 2 '.__CLASS__.'::'.__FUNCTION__.'</p>';
    }

    static function static_fonction_trait2() {
        echo '<p>appel 6 '.__TRAIT__.'::'.__FUNCTION__.'</p>';
    }
}

Trait Trait3 {
	Public function acces_a_variable (){
		return $this->_varDepuisTrait;//la variable  n’est pas définie dans le trait
}
}

abstract class Abstrait1 {

    const CONSTANTE_ABSTRAIT1 = '<p>CONSTANTE_ABSTRAIT1</p>';
    
    abstract protected function abstract_function2Abstrait1();
    
    protected function protected_function_Abstrait1(){
         echo '<p>appel 0 '.__CLASS__.'::'.__FUNCTION__.'</p>';
    }
}

abstract class Abstrait2 extends Abstrait1 implements Inter1{

    use Trait1;
    use Trait2 {
        
        Trait1::fonction_trait insteadof Trait2;
        Trait2::fonction_trait as public fonction_trait2;//on peut changer visibilité
    }
    
    public $_var_abstrait2='<p>var_abstrait2</p>';
    
    public function __construct() {//autorisé mais pas implicitement appelé par la fille
        
        parent::protected_function_Abstrait1();

        $this->protected_function_Abstrait1();

        $this->abstract_function2Abstrait1();
        
        echo '<p>appel 1 '.__CLASS__.'::'.__FUNCTION__.'</p>';
    }

    protected function protected_function_Abstrait1(){
        echo '<p>appel 0.5 '.__CLASS__.'::'.__FUNCTION__.'</p>';
    }

    protected function abstract_function2Abstrait1() {
        echo '<p>appel 0.7 '.__CLASS__.'::'.__FUNCTION__.'</p>';
    }

    public function fonction_Objet1() {
        echo '<p>appel 4 '.__CLASS__.'::'.__FUNCTION__.'</p>';
    }

}

class Objet1 extends Abstrait2  {

	Private $_varDepuisTrait;
use Trait3;
    
    const CONSTANTE_OBJET1 = '<p>CONSTANTE_OBJET1</p>';

    public function __construct($constante='CONSTANTE_Objet1_construite') {

$this->_varDepuisTrait = ‘varDepuisTrait’;
                
      define('CONSTANTE_Objet1_construite',$constante);

        parent::__construct();

echo '<hr />';
        $this->fonction_trait();
        self::fonction_trait();
        parent::fonction_trait();
echo '<hr />';
echo '<hr />';
        $this->fonction_trait2();
        self::fonction_trait2();
        parent::fonction_trait2();
echo '<hr />';
    }
    
    public function fonction_inter1($var='variable') {//cette fonction peut être définie dans Objet1 et pas Abstrait2 car elle est abstraite, sinon il faudrait la définir dans Abstrait2
        echo '<p>appel 3 '.__CLASS__.'::'.__FUNCTION__.' la variable est : '.$var.'</p>'; 
    }
    
    public function appels_static() {
echo '<hr />';     
        $this->static_fonction_trait1();
        self::static_fonction_trait1();
        static::static_fonction_trait1();
        parent::static_fonction_trait1();
echo '<hr />';
        
    }
    
}

$Objet1 = new Objet1('CONSTANTE_Objet1_construite');
$Objet1->fonction_inter1();
$Objet1->fonction_Objet1();

$Objet1->appels_static();

//TRAIT1::static_fonction_trait1();//on ne peut pas l'appeler ainsi car elle est protected
TRAIT2::static_fonction_trait2();

echo '<hr />';
var_dump($Objet1->_var_trait2);
var_dump($Objet1::CONSTANTE_Inter1);

var_dump($Objet1::CONSTANTE_OBJET1);

var_dump(CONSTANTE_Objet1_construite);

echo $Objet1->acces_a_variable ();