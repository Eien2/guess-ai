let imgEl;

export function imgHandling(el) {
  const fileInput = document.getElementById(`${el}-input`);
  const fileLabel = document.getElementById(`${el}-label`);
  const uploadText = document.querySelector(`.${el}-text`);
  const imgContainer = document.getElementById("img-output");
  const guessBtn = document.querySelector(".send-btn");
  
  fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = (e) => {
        uploadText.innerText = file.name;

        imgEl = new Image(600, 400);
        imgEl.src = reader.result;
        imgEl.onload = () => {
          imgContainer.innerHTML = "";
          imgContainer.appendChild(imgEl);
          guessBtn.disabled = false;
        };
      };

      reader.readAsDataURL(file);
    }
  });

  fileLabel.addEventListener("click", () => {
    fileInput.click();
  });
}

export function guessBtn() {
  const guessBtn = document.querySelector(".send-btn");
  const predictionsContainer = document.getElementById("predictions-output");
    
  guessBtn.addEventListener("click", async () => {
    if (!imgEl) return;
    predictionsContainer.innerHTML = "";
    
    const model = await cocoSsd.load();
    const predictions = await model.detect(imgEl);

    if (predictions.length > 0) {
      predictionsContainer.innerHTML = `
        <h2>
          Detected Object: ${predictions.map(pred => `<span style='font-weight: normal; color: grey;'>${pred.class}</span>`).join("")}
        </h2>
      `;
    } else {
      predictionsContainer.innerHTML = `<p>Couldn't detect object.</p>`;
    }
  });
}
