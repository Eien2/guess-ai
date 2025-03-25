<!doctype html>
<html lang="en">
  <head>
    <title>Images - GuessAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/guess-ai/css/defaults/default.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="/guess-ai/css/pages/logged-images.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>
    <script src="/guess-ai/scripts/main.js" type="module" defer></script>
  </head>
  <body>
    <?php include "./templates/header.php" ?>

    <main>
      <section class="guess-section">
        <div id="img-output">
          I'm waiting for your image...
        </div>

        <div id="predictions-output">
        </div>
      </section>

      <hr class="separator"/>

      <section class="input-section">
        <div class="sendbar" action="" method="POST">
          <div class="photo-cont">
            <label id="photo-label" for="photo-input">
              <img src="/guess-ai/images/icons/photo.svg" alt="make-photo" class="photo-ico"> 
              <span class="photo-text">Take photo</span>
            </label>

            <input type="file" accept="image/*" capture="enviroment" id="photo-input" name="photo" />
          </div>

          <div class="image-cont">
            <label id="image-label" for="image-input">
              <img src="/guess-ai/images/icons/image.svg" alt="upload-image" class="image-ico"> 
              <span class="image-text">Select a file</span>
            </label>

            <input type="file" name="image" accept="image/*" id="image-input">
          </div>

          <button class="send-btn" type="submit" disabled>
            <img src="/guess-ai/images/icons/send.svg" alt="send-button" /> 
          </button>
        </div>
      </section>
    </main>

    <?php include "./templates/footer.php" ?>
  </body>
</html>
