<?php 
  $usernameErr = $passwordErr = $emailErr = "";
  include "./configs/conn.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Sign Up - GuessAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/guess-ai/css/defaults/default.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="/guess-ai/css/pages/sign-up.css?v=<?php echo time(); ?>">
    <script src="/guess-ai/scripts/main.js" type="module" defer></script>
  </head>
  <body>
    <?php include "./templates/header.php" ?>

    <main>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <p class="title">Sign Up</p>

        <?php 
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["username"])) $usernameErr = "Username is required";

            $sql = "SELECT username, email FROM users";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
              if ($row["username"] == $_POST["username"]) {
                $usernameErr = "This username is already taken";
              }

              if ($row["email"] != "" && $row["email"] == $_POST["email"]) {
                $emailErr = "This email is already taken";
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
                    if (empty($_POST["username"])) echo "borderErr";

                    $sql = "SELECT username, email FROM users";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                      if ($row["username"] == $_POST["username"]) { 
                        echo "borderErr";
                        break;
                      }
                    }
                  }
                ?>
              "
            />
            <?php echo "<div class='err'>$usernameErr</div>"; ?>
            <div class="asterisk">
              <img class="asterisk-ico" src="/guess-ai/images/icons/asterisk.svg" alt="required">
              <div class="tooltip">
                This is required
              </div>
            </div>
          </div>

          <div class="cont-email">
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Email"
              class="
                <?php
                  if (isset($_POST["submit"])) {
                    $sql = "SELECT username, email FROM users";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                      if ($row["email"] != "") {
                        if ($row["email"] == $_POST["email"]) {
                          echo "borderErr";
                          break;
                        }
                      }
                    }
                  }
                ?>
              "
            />
            <?php echo "<div class='err'>$emailErr</div>"; ?>
          </div>

          <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if ($_POST["password"] != $_POST["conf-password"]) {
                $passwordErr = "Passwords are not the same";
              }
              
              if (empty($_POST["password"]) || empty($_POST["conf-password"])) {
                $passwordErr = "Password is required";
              }
            }
          ?>

          <div class="cont-password">
            <input
              type="password"
              id="password"
              class="
                <?php
                  if (isset($_POST["submit"])) {
                  if (
                    (empty($_POST["password"]) || empty($_POST["conf-password"])) ||
                    ($_POST["password"] != $_POST["conf-password"])) echo "borderErr"; 
                  }
                ?>
              "
              name="password"
              placeholder="Password"
            />
            <?php echo "<div class='err'>$passwordErr</div>"; ?>
            <div class="asterisk">
              <img class="asterisk-ico" src="/guess-ai/images/icons/asterisk.svg" alt="required">
              <div class="tooltip">
                This is required
              </div>
            </div>
          </div>

          <div class="cont-conf-password">
            <input
              type="password"
              id="conf-password"
              class="
                <?php
                  if (isset($_POST["submit"])) {
                  if (
                    (empty($_POST["password"]) || empty($_POST["conf-password"])) ||
                    ($_POST["password"] != $_POST["conf-password"])) echo "borderErr"; 
                  }
                ?>
              "
              name="conf-password"
              placeholder="Confirm Password"
            />
            <?php echo "<div class='err'>$passwordErr</div>"; ?>
            <div class="asterisk">
              <img class="asterisk-ico" src="/guess-ai/images/icons/asterisk.svg" alt="required">
              <div class="tooltip">
                This is required
              </div>
            </div>
          </div>

          <input type="submit" id="submit" name="submit" value="Submit"/>
        </section>

        <section class="or-section">
          <p class="or">Or</p>

          <a class="login-link" href="/guess-ai/expages/login.php">Login</a>
        </section>

        <?php 
          if (isset($_POST["submit"])) {
            if ((isset($_POST["username"]) && !empty($_POST["username"])) &&
                (isset($_POST["password"]) && !empty($_POST["password"])) &&
                ($_POST["password"] == $_POST["conf-password"]))
            {
              $select = "SELECT username, email FROM users";
              $result = mysqli_query($conn, $select);

              if (mysqli_num_rows($result) == 0) {
                if ($_POST["email"] == "") {
                  $username = $_POST["username"];
                  $email = $_POST["email"];
                  $password = $_POST["password"];
                  $hash_password = password_hash("$password", PASSWORD_DEFAULT);
                  
                  $insert = "INSERT IGNORE INTO users (username, email, password) VALUES ('$username', NULL, '$hash_password')";
                  mysqli_query($conn, $insert);
                }
              } elseif (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);

                if ($_POST["email"] == "") {
                  $username = $_POST["username"];
                  $email = $_POST["email"];
                  $password = $_POST["password"];
                  $hash_password = password_hash("$password", PASSWORD_DEFAULT);
                  $insert = "
                    INSERT IGNORE INTO users (username, email, password) VALUES ('$username', NULL, '$hash_password')
                  ";

                  mysqli_query($conn, $insert);
                } else if ($row[0] != $_POST["username"] && $row[1] != $_POST["email"]) {
                  $username = $_POST["username"];
                  $email = $_POST["email"];
                  $password = $_POST["password"];
                  $hash_password = password_hash("$password", PASSWORD_DEFAULT);
                  $insert = "
                    INSERT IGNORE INTO users (username, email, password) VALUES ('$username', '$email', '$hash_password')
                  ";

                  mysqli_query($conn, $insert);
                } else {
                  $username = $_POST["username"];
                  $email = $_POST["email"];
                  $password = $_POST["password"];
                  $hash_password = password_hash("$password", PASSWORD_DEFAULT);
                  $insert = "
                    INSERT IGNORE INTO users (username, email, password) VALUES ('$username', '$email', '$hash_password')
                  ";

                  mysqli_query($conn, $insert);
                }
              }
            }
          }
        ?>
      </form>
    </main>

    <?php include "./templates/footer.php"; mysqli_close($conn) ?>
  </body>
</html>
