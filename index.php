<!doctype html>
<html lang="en">
  <head>
    <title>Home - GuessAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/guess-ai/css/defaults/default.css" />
    <link rel="stylesheet" href="/guess-ai/css/pages/index.css">
    <script src="/guess-ai/scripts/main.js" type="module" defer></script>
  </head>
  <body>
    <?php include "./expages/templates/header.php" ?>

    <main>
      <section id="hero-section">
        <article class="explanation" id="emotion-mode">
          <h1 class="title">
            Emotion mode
          </h1>

          <p class="description">
            Script is connecting to media devices (web cam)<br>
            then it uses face-api.js to detect face and display your age, gender etc.
          </p>
        </article>

        <article class="explanation" id="images-mode">
          <h1 class="title">
            Images mode
          </h1>

          <p class="description">
            Script is reading a image you upload,<br>
            display it on a website<br>
            and connect to cocoSsd model that detects what's on the iamge. 
          </p>
        </article>

        <button class="access-btn">
          <a href="/guess-ai/expages/login.php">
            Login to get Access
          </a>
        </button>
      </section>
    </main>

    <?php include "./expages/templates/footer.php" ?>
  </body>
</html>
