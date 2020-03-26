<?php
class Employee {
	protected $code;
	function setCode($code) {
		if ($code == "") {
			echo "Name cannot be blank!";
		} else {
			$this->code = $code;
		}
	}
	function getCode() {
		echo "<br />"."Code: ".$this->code."<br />";
	}
}
interface Person {
	// costanti
	const COSTANTE = "valore";
	// definizione dei metodi
	public function getName();
	public function setName($name, $lastname);
}
class Student extends Employee implements Person {
	private $name = "";
	private $lastname = "";
	// implementazione dei metodi
	public function getName(){
		// corpo del Metodo
		echo "$this->name $this->lastname";
	}
	public function setName($name, $lastname){
		// corpo del Metodo
		$this->name = $name;
		$this->lastname = $lastname;
	}
    function setCode($code,$prefix="") {
		
			$this->code =$prefix."/".$code;
		}
}
$student = new Student();
$student->setName( "Giulia", "Q" );
$student->getName();
$student->setCode("04022","Plz: ");
$student->getCode();
?>