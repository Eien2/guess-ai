<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Emotions - GuessAI</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/guess-ai/css/defaults/default.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="/guess-ai/css/pages/logged-emotions.css?v=<?php echo time(); ?>">
    <script src="/guess-ai/scripts/face-api/face-api.min.js" defer></script>
    <script src="/guess-ai/scripts/main.js" type="module" defer></script>
  </head>

  <body>
    <?php include "./templates/header.php" ?>

    <main>
      <section id="ai-section">
        <section id="video-section">
          <video id="vid" width="500" height="400" autoplay muted></video>
        </section>

        <section id="detections-output">
        </section>
      </section>

      <button id="detect-btn" autoplay>
        Start Detecting
      </button>
    </main>

    <?php include "./templates/footer.php" ?>
  </body>
</html>
