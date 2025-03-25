let video = document.getElementById("vid");

export function openCam() {
  let detectBtn = document.getElementById("detect-btn");
  let mediaDevs = navigator.mediaDevices;

  detectBtn.addEventListener("click", () => {
    mediaDevs
      .getUserMedia({
        video: true,
        audio: false,
      })
      .then((stream) => {
        video.srcObject = stream;
        video.addEventListener("loadedmetadata", () => {
          video.play();
          emotionDetecting();
        });
      })
      .catch((error) => {
        console.error(error);
      });
  });
}

function emotionDetecting() {
  Promise.all([
    faceapi.nets.tinyFaceDetector.loadFromUri(
      "/guess-ai/scripts/face-api/models",
    ),
    faceapi.nets.faceRecognitionNet.loadFromUri(
      "/guess-ai/scripts/face-api/models",
    ),
    faceapi.nets.faceExpressionNet.loadFromUri(
      "/guess-ai/scripts/face-api/models",
    ),
    faceapi.nets.ageGenderNet.loadFromUri("/guess-ai/scripts/face-api/models"),
  ]).then(openCam);

  video.addEventListener("loadeddata", async () => {
    const detectionsOut = document.getElementById("detections-output");

    setInterval(async () => {
      const detections = await faceapi
        .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
        .withFaceExpressions()
        .withAgeAndGender();

      document.querySelectorAll(".outputs").forEach(el => el.remove());


      detections.forEach((detection) => {
        const outputsDiv = document.createElement("div");
        outputsDiv.className = "outputs";

        const outputAgeP = document.createElement("p");
        outputAgeP.className = "output";
        outputAgeP.innerText = `Age: ${Math.round(detection.age)}`;

        const outputGenderP = document.createElement("p");
        outputGenderP.className = "output";
        outputGenderP.innerText = `Gender: ${detection.gender}`;

        const outputEmotionP = document.createElement("p");
        outputEmotionP.className = "output";
        outputEmotionP.innerText = `Emotions: ${Object.entries(detection.expressions).reduce((a, b) => a[1] > b[1] ? a : b)[0]}`;

        outputsDiv.append(outputAgeP);
        outputsDiv.append(outputGenderP);
        outputsDiv.append(outputEmotionP);

        detectionsOut.append(outputsDiv);
      });
    }, 1000);
  });
}
