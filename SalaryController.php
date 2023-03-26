<?php

class SalaryController {
  private $INSSTable = [
    [1_302.00, 1_302.00, 0.075],
    [1_302.01, 2_571.29, 0.09],
    [2_571.30, 3_856.94, 0.12],
    [3_856.95, 7_507.49, 0.14],
  ];

  public function handleCalculateINSS($grossSalary) {
    if ($grossSalary <= 1_302.00) return $grossSalary * $this->INSSTable[0][2];
    
    $accumulated = 0;
  
    foreach ($this->INSSTable as $index => [$from, $to, $percentage]) {
      if ($grossSalary <= $to) {
        $netSalary = (($grossSalary - $this->INSSTable[$index - 1][1]) * $percentage) + $accumulated;
        return $netSalary;
      }
  
      $to == $this->INSSTable[0][1]
        ? $accumulated += $from * $percentage 
        : $accumulated += (($to - $from) * $percentage);
    }
  
    return $accumulated;
  }
  
  public function handleCalculateIRRF($baseAmount, $numberOfDependents) {
    $IR2BaseAmount = $baseAmount - ($numberOfDependents * 189.59);
  
    if ($IR2BaseAmount <= 1_903.98) return 0;
    if ($IR2BaseAmount <= 2_826.65) return ($IR2BaseAmount * 0.075) - 142.80;
    if ($IR2BaseAmount <= 3_751.05) return ($IR2BaseAmount * 0.15) - 354.80;
    if ($IR2BaseAmount <= 4_664.68) return ($IR2BaseAmount * 0.225) - 636.13;
    return ($IR2BaseAmount * 0.275) - 869.36;
  }
  
  public function handleGetNetSalary($grossSalary, $numberOfDependents) {
    $inss = round($this->handleCalculateINSS($grossSalary), 2);
    $irrf = round($this->handleCalculateIRRF($grossSalary - $inss, $numberOfDependents), 2);
    
    $netSalary = $grossSalary - $inss - $irrf;
  
    return [$netSalary, $inss, $irrf];
  }

  public function oi() {
    return 10;
  }
}

?>