<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
</head>
<body>

<section class="vh-100" style="background-color: #C2D8B9;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="img/hero_student_collage_US_1x.png"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <img src="img/WhatsApp Image 2024-09-04 at 9,55,54 PM_processed.jpeg" alt="Logo" style="height: 80px; margin-right: 10px;">
                    <span class="h1 fw-bold mb-0">Unity Class</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <input type="email" id="correo" name="correo" class="form-control form-control-lg" required />
                    <label class="form-label" for="correo">Email address</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="contrasena" name="contrasena" class="form-control form-control-lg" required />
                    <label class="form-label" for="contrasena">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? 
                    <!-- en este href estoy poniendo el link del login.php una vez que den click lo redigira al registro -->
                    <a href="index.php" style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include 'conexion.php'; 

                    $correo = $_POST['correo'];
                    $contrasena = $_POST['contrasena'];

                    // Prepara la consulta
                    $stmt = $con->prepare("SELECT contrasena FROM Beneficiarios WHERE correo = ?");
                    $stmt->bind_param("s", $correo);
                    $stmt->execute();
                    $stmt->store_result();

                    // Verifica si el usuario existe
                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($hashedPassword);
                        $stmt->fetch();

                        // Verifica la contraseña
                        if (password_verify($contrasena, $hashedPassword)) {
                            echo "<div class='alert alert-success'>Inicio de sesión exitoso.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Contraseña incorrecta.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>El correo electrónico no está registrado.</div>";
                    }

                    
                    $stmt->close();
                    $con->close();
                }
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>
</html>
