import { imgHandling, guessBtn } from "./aiImageHandle.js";
import { loggedHeader } from "./changeHeader.js";
import { openCam } from "./aiEmotionHandle.js";

class Main {
  pages() {
    let defaultUrl = "http://localhost/guess-ai/";
    const homeUrl = defaultUrl + "index.php";
    const loginUrl = defaultUrl + "expages/login.php";
    const signUrl = defaultUrl + "expages/sign-up.php";
    const loggedImgUrl = defaultUrl + "expages/logged-images.php";
    const loggedEmoUrl = defaultUrl + "expages/logged-emotions.php";
    const welcomeUrl = defaultUrl + "expages/welcome.php";

    if (location.href == homeUrl || location.href == defaultUrl) {
    } else if (location.href == loginUrl) {
    } else if (location.href == signUrl) {
    } else if (location.href == loggedImgUrl) {
      loggedHeader();
      imgHandling("image");
      imgHandling("photo");
      guessBtn();
    } else if (location.href == loggedEmoUrl) {
      loggedHeader();
      openCam();
    } else if (location.href == welcomeUrl) {
      loggedHeader();
    }
  }
}

const main = new Main();

main.pages();
