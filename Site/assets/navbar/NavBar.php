<?php session_start(); ?>

<nav class="navbar" style="background-color: #164f63;" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="assets/images/car.png" alt="Logo" width="30" height="33" class="d-inline-block align-text-top">
      Chico Store
    </a>
    <div class="" role="group" aria-label="Default button group">

      <?php
      if (session_status() == PHP_SESSION_ACTIVE) {
        if (isset($_SESSION["NomeCliente"])) {
          $Name = $_SESSION["NomeCliente"];
          $Btn =
            '<a href="../Adm/ControleProdutos.php?Acao=compra" class="text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-cart me-2" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
          </a>
          <div class="btn-group">
          <button class="btn btn-outline-light btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="currentColor" class="bi bi-person-circle me-1" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg>' .
            $Name
            . '</button>
          <ul class="dropdown-menu dropdown-menu-lg-end">
            <li><a class="dropdown-item" href="../../SistemaERP/Adm/FormClientes.php">Atualizar Dados</a></li>
            <li><a class="dropdown-item" href="FormFaleConosco.php">Fale Conosco</a></li>
            <li><a class="dropdown-item" href="../Adm/ControleClientes.php?Logout">Log out</a></li>
          </ul>
        </div>';
        } else {
          $Btn = '<div class="btn-group">
          <button class="btn btn-outline-light btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle me-1" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg>
            Fazer Login
          </button>
          <ul class="dropdown-menu dropdown-menu-lg-end">
            <li><a class="dropdown-item" href="../../SistemaERP/Adm/FormClientes.php">Cadastre-se</a></li>
            <li><a class="dropdown-item" href="login.php">Login</a></li>
          </ul>
        </div>';
        }
      } else {
        $Btn = '<div class="btn-group">
      <button class="btn btn-outline-light btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle me-1" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>
        Fazer Login
      </button>
      <ul class="dropdown-menu dropdown-menu-lg-end">
        <li><a class="dropdown-item" href="../../SistemaERP/Adm/FormClientes.php">Cadastre-se</a></li>
        <li><a class="dropdown-item" href="login.php">Login</a></li>
      </ul>
    </div>';
      }

      echo $Btn;
      ?>

    </div>
  </div>
</nav>