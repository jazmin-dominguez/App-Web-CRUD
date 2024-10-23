<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css" rel="stylesheet">

  <style>
    .cascading-right {
      margin-right: -50px;
    }

    @media (max-width: 991.98px) {
      .cascading-right {
        margin-right: 0;
      }
    }
    
    .underline {
      text-decoration: underline;
      cursor: pointer;
      color: blue;
    }

    /* Custom button color */
    .btn-custom {
      background-color: #0097A7;
      border: none;
      color: white;
    }
  </style>
</head>
<body>

<section class="text-center text-lg-start">
  <div class="container py-4">
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right bg-body-tertiary" style="backdrop-filter: blur(30px);">
          <div class="card-body p-5 shadow-5 text-center">
            <div class="d-flex align-items-center mb-3 pb-1">
              <img src="../SRC/logo2.png" alt="Logo" style="height: 150px; margin-right: 10px;">
              <span class="h1 fw-bold mb-0">Sign into your account</span>
            </div>
            <form method="post" onsubmit="return validateForm()">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" id="correo" name="correo" class="form-control" required />
                <label class="form-label" for="correo">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="contrasena" name="contrasena" class="form-control" required />
                <label class="form-label" for="contrasena">Password</label>
              </div>
              <a class="small text-muted" href="#!">Forgot password?</a>
              <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register.php">Register here</a></p>
              
              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" />
                <label class="form-check-label" for="form2Example33">
                  I accept the <span class="underline" onclick="openTerms()">terms and conditions</span>.
                </label>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-custom btn-block mb-4" name="submit">
                LOGIN
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0">
        <img src="../SRC/niño_login.png" class="w-100 rounded-4 shadow-4" alt="" />
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->

<!-- MDBootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>

<!-- Custom JS for form validation -->
<script>
  function validateForm() {
    var checkbox = document.getElementById('form2Example33');
    if (!checkbox.checked) {
      alert('You must accept the terms and conditions to log in.');
      return false;
    }
    return true;
  }

  function openTerms() {
    window.open('../Terminos/terminosyconciones.html', '_blank');
  }
</script>

</body>
</html>

<?php
  if(isset($_POST['submit']))
  {
    $correo = $_POST['correo'];
    $password = $_POST['contrasena'];

    require_once('../Conexion/contacto.php');
    $obj = new Contacto();
    $obj->login($correo, $password);
  }
?>
