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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./styles.css">
</head>
<body>
  <main data-bs-theme="dark">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center content-wrapper">
        <div>
          <form method="post">
            <div class="mb-3">
              <label for="grossSalary" class="form-label p-0">Salário bruto</label>
              <input type="number" class="form-control" id="grossSalary" name="grossSalary">
            </div>

            <div class="mb-3">
              <label for="numberOfDependents" class="form-label p-0">Número de dependentes</label>
              <input type="number" class="form-control" id="numberOfDependents" name="numberOfDependents">
            </div>

            <button type="submit" class="btn btn-primary w-100">Calcular <i class="bi bi-calculator"></i></button>
          </form>

          <?php
            function handleFormatAmount($amount) {
              return number_format($amount, 2, ",", ".");
            }

            if (isset($_POST['grossSalary']) && isset($_POST['numberOfDependents'])) {
              $grossSalary = $_POST['grossSalary'];
              $numberOfDependents = $_POST['numberOfDependents'];

              $salaryController = new SalaryController();

              [$netSalary, $inss, $irrf] = $salaryController->handleGetNetSalary($grossSalary, $numberOfDependents);

              ?>

                <div>
                  <div class="result-container mt-5 p-3 rounded">
                    <div class="row amount">
                      <h5>Salário bruto (provento)</h5>
                      <span class="text-success">+ R$ <?php echo handleFormatAmount($grossSalary) ?></span>
                    </div>

                    <div class="row amount">
                      <h5>INSS (desconto)</h5>
                      <span class="text-danger">- R$ <?php echo handleFormatAmount($inss) ?></span>
                    </div>

                    <div class="row amount">
                      <h5>IRRF (desconto)</h5>
                      <span class="text-danger">- R$ <?php echo handleFormatAmount($irrf) ?></span>
                    </div>

                    <div class="row amount">
                      <h5>Salário líquido</h5>
                      <span class="text-success">+ R$ <?php echo handleFormatAmount($netSalary) ?></span>
                    </div>

                    <a class="btn btn-outline-primary w-100 mt-3" href="./index.php">Limpar <i class="bi bi-trash3"></i></a>
                  </div>
                </div>

              <?php
            }
          ?>

        </div>
      </div>
    </div>
  </main>
</body>
</html>
