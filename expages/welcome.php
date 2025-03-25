<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Welcome - GuessAI</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/guess-ai/css/defaults/default.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="/guess-ai/css/pages/welcome.css?v=<?php echo time(); ?>">
    <script src="/guess-ai/scripts/main.js" type="module" defer></script>
  </head>

  <body>
    <?php include "./templates/header.php" ?>

    <main>
      <h1 id="welcome-banner">Welcome this are our current modes</h1>

      <section id="modes-section">
        <button class="mode-btn"><a class="mode-link" href="./logged-emotions.php">Emotion Detect AI</a></button>
        <button class="mode-btn"><a class="mode-link" href="./logged-images.php">Image AI</a></button>
      </section>
    </main>

    <?php include "./templates/footer.php" ?>
  </body>
</html>
