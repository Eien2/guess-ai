<?php
  $usernameErr = $passwordErr = "";
  $isUsername = $isPassword = false;
  $usernameId = 0;
  include "./configs/conn.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login - GuessAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/guess-ai/css/defaults/default.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="/guess-ai/css/pages/login.css?v=<?php echo time(); ?>">
    <script src="/guess-ai/scripts/main.js" type="module" defer></script>
  </head>
  <body>
    <?php include "./templates/header.php" ?>

    <main>
      <form method="POST">
        <p class="title">Login</p>

        <?php
          if (isset($_POST["submit"])) {
            $sql = "SELECT id, username, email, password FROM users";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) == 0) {
              $usernameErr = "This username doesn't exist";
              $passwordErr = "Incorrect Password";
            } else {
              if (isset($_POST["username"]) && isset($_POST["password"])) {
                if (empty($_POST["username"])) $usernameErr = "Enter a username";
                if (empty($_POST["password"])) $passwordErr = "Enter a password";

                if (!empty($_POST["username"])) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["username"] == $_POST["username"]) {
                      $isUsername = true;
                      $usernameId = $row["id"];
                      break;
                    } else {
                      $isUsername = false;
                    }
                  }
                }

                if (!empty($_POST["password"])) {
                  $sql2 = "SELECT password FROM users WHERE id=$usernameId";
                  $result2 = mysqli_query($conn, $sql2);

                  while ($row = mysqli_fetch_assoc($result2)) {
                    if (password_verify($_POST["password"], $row["password"])) {
                      $isPassword = true;
                      break;
                    } else {
                      $isPassword = false;
                    }
                  }
                }

                if ($isPassword && $isUsername) {
                  header("Location: ./welcome.php");
                }

                if (!$isPassword) {
                  $passwordErr = "Incorrect Password";
                }

                if (!$isUsername) {
                  $usernameErr = "This username doesn't exist";
                }

              } 
            }
          }
        ?>

        <section class="inputs">
          <div class="cont-username">
            <input 
              type="text"
              id="username"
              name="username"
              placeholder="Username"
              class="
                <?php 
                  if (isset($_POST["submit"])) {
                    $sql = "SELECT username, password FROM users";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 0) {
                      echo "borderErr";
                    } else {
                      if (isset($_POST["username"]) && empty($_POST["username"])) {
                        echo "borderErr";
                      } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                          if ($row["username"] != $_POST["username"] && $usernameErr != "") {
                            echo "borderErr";
                            break;
                          }
                        }
                      }
                    }
                  }
                ?>
              "
            />
            <div class="err">
              <?php echo $usernameErr ?>
            </div>
          </div>

          <div class="cont-password">
            <input 
              type="password"
              id="password"
              name="password" 
              placeholder="Password" 
              class="
                <?php 
                  if (isset($_POST["submit"])) {
                    $sql = "SELECT username, password FROM users";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 0) {
                      echo "borderErr";
                    } else {
                      if (isset($_POST["password"]) && empty($_POST["password"])) {
                        echo "borderErr";
                      } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                          if (!password_verify($_POST["password"], $row["password"]) && $passwordErr != "") {
                            echo "borderErr";
                            break;
                          }
                        }
                      }
                    }
                  }
                ?>
              "
            />
            <div class="err">
              <?php echo $passwordErr ?>
            </div>
          </div>

          <input type="submit" id="submit" name="submit" value="Submit"/>
        </section>

        <section class="or-section">
          <p class="or">Or</p>

          <a class="sign-up-link" href="/guess-ai/expages/sign-up.php">Sign Up</a>
        </section>
      </form>
    </main>

    <?php include "./templates/footer.php"; mysqli_close($conn) ?>
  </body>
</html>
