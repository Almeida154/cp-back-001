<?php
include "./SalaryController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculadora do salário líquido (2023)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles.css">
</head>
<body>
  <main data-bs-theme="dark">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center content-wrapper">
        <div>
          <form method="post">
            <div class="mb-3 row">
              <label for="grossSalary" class="form-label p-0">Salário bruto</label>
              <input type="number" class="form-control" id="grossSalary" name="grossSalary" placeholder="R$ 3.500,00">
            </div>

            <div class="mb-3 row">
              <label for="numberOfDependents" class="form-label p-0">Número de dependentes</label>
              <input type="number" class="form-control" id="numberOfDependents" name="numberOfDependents" placeholder="3">
            </div>

            <div class="row">
              <button type="submit" class="btn btn-primary">Calcular</button>
            </div>
          </form>

          <div class="row">
            <?php
              if (isset($_POST['grossSalary']) && isset($_POST['numberOfDependents'])) {
                $grossSalary = $_POST['grossSalary'];
                $numberOfDependents = $_POST['numberOfDependents'];

                $salaryController = new SalaryController();

                [$netSalary, $inss, $irrf] = $salaryController->handleGetNetSalary($grossSalary, $numberOfDependents);

                echo $netSalary;
                echo "<a href='./index.php'>Limpar</a>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
