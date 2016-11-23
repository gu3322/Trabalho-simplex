<?php
	class simplex{
		private $indice = array("Z","X1","X2","F1","F2","F3","B");
		private $table = array(
			"0" => array(),
			"1" => array(),
			"2" => array(),
			"3" => array()
		);
		
		public function montaTabela($l1, $l2, $l3, $l4){
			$this->table["0"] = $l1;
			$this->table["1"] = $l2;
			$this->table["2"] = $l3;
			$this->table["3"] = $l4;
		}
		
		public function iniciar($l1, $l2, $l3, $l4){
			$nl1 = array(1, -$l1[0], -$l1[1], 0, 0, 0, 0);
			$nl2 = array(0, $l2[0], $l2[1], 1, 0, 0, $l2[2]);
			$nl3 = array(0, $l3[0], $l3[1], 0, 1, 0, $l3[2]);
			$nl4 = array(0, $l4[0], $l4[1], 0, 0, 1, $l4[2]);
			$this->montaTabela($nl1, $nl2, $nl3, $nl4);
			$this->printTable();
			$cp = $this->localiza();
			$lp = $this->attTable($cp);
			$pivo = $this->table[$lp][$cp];
			$this->zeralinha($pivo, $lp);
			$this->novaLinha($cp, $lp);
			$this->axei();
		}
		
		public function localiza(){
			for($i = 0; $i < count($this->table[0]) - 2; $i++){
				if(abs($this->table[0][$i]) > abs($this->table[0][$i+1]))
					$n = $i;
			}
			return $n;
		}
		
		public function zeralinha($pivo, $lp){
			foreach($this->table[$lp] as $key => $value){				
				if($value > 0) $value /= $pivo;
				$this->table[$lp][$key] = $value;
			}
		}
		
		public function novaLinha($cp, $lp){
			$table = array();
			for($i=0; $i < count($this->table); $i++){
				if($i != $lp){
					$c = $this->table[$i][$cp] * -1;
					foreach($this->table[$lp] as $key => $value){
						$nvalue = 0;
						if($value > 0) $nvalue += $value * $c;
						$table[$i][$key] = $this->table[$i][$key] + $nvalue;
					}
				}else{
					foreach($this->table[$lp] as $key => $value){
						$table[$i][$key] = $value;
					}
				}
			}
			$this->table = $table;
			$this->printTable();
		}
		
		public function attTable($p){
			$table = $this->table;
			$n = $table[count($table) - 1][count($table[count($table) - 1]) - 1];
			for($i = 1; $i < count($table); $i++){
				$table[$i][count($table[$i]) - 1] /= $table[$i][$p];
			}
			for($i = 1; $i < count($table) - 1; $i++){
				if(($table[$i][count($table[$i]) - 1] < $table[$i+1][count($table[$i]) - 1]) && ($table[$i][count($table[$i]) - 1] > -1))
					$n = $i;
			}
			return $n;
		}
		
		public function axei(){
			echo "Para Z = ".$this->table[0][count($this->table[0]) - 1] ."</br>";
			foreach($this->table[0] as $key => $value){
				if($value == 0){
					for($i = 0; $i < count($this->table); $i++){
						if($this->table[$i][$key] == 1) echo $this->indice[$key] ." = ". $this->table[$i][count($this->table[0]) - 1] ."</br>";
					}
				}else if(($key != 0) && ($key < count($this->table[0]) - 1))echo $this->indice[$key] ." = 0 </br>";
			}
		}
		
		public function printTable(){
			echo "<table><tr>";
			for($u = 0; $u < count($this->table); $u++){
				for($i = 0; $i < count($this->table[0]); $i++){
					echo"<td>". number_format($this->table[$u][$i],2) ."</td>";
				}
				echo "</tr><tr>";
			}
			echo "</tr></table><br/>";
		}
	}
?>