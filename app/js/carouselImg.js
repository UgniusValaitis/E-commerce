const carousel = document.querySelectorAll("div.photoActive");
const body = document.querySelector("body");
carousel.forEach((slider) => {
  let time = 5000;
  let interval;
  let counter = 1;
  const images = slider.children;
  let size = images[1].clientWidth;
  if (images.length > 3) {
    slider.style.transform = "translateX(" + -size * counter + "px)";
    function slide() {
      slider.style.transition = "transform 0.5s linear";
      counter++;
      slider.style.transform = "translateX(" + -size * counter + "px)";
      setTimeout(() => {
        if (counter >= images.length - 1) {
          slider.style.transition = "none";
          counter = 1;
          slider.style.transform = "translateX(" + -size * counter + "px)";
        }
      }, 1000);
    }
    window.addEventListener("resize", () => {
      size = images[0].clientWidth;
      slider.style.transition = "none";
      slider.style.transform = "translateX(" + -size * counter + "px)";
    });

    // slider.addEventListener("transitionend", () => {
    //   if (counter >= images.length - 1) {
    //     slider.style.transition = "none";
    //     counter = 1;
    //     slider.style.transform = "translateX(" + -size * counter + "px)";
    //   }
    // });
    interval = setInterval(slide, time);
  }
  slider.addEventListener("click", () => {
    if (images.length > 3) {
      clearInterval(interval);
      const photos = slider.cloneNode(true);
      photos.style = "";
      photos.className = "photos";
      const frame = document.createElement("div");
      frame.className = "frame";
      frame.appendChild(photos);
      const next = document.createElement("i");
      next.className = "next fas fa-chevron-right";
      const prev = document.createElement("i");
      prev.className = "prev fas fa-chevron-left";
      const exit = document.createElement("button");
      exit.textContent = "x";
      exit.className = "exit secondaryBtn";

      const fullScreen = document.createElement("div");
      fullScreen.className = "fullScreen";
      fullScreen.appendChild(prev);
      fullScreen.appendChild(next);
      fullScreen.appendChild(exit);
      fullScreen.appendChild(frame);
      body.appendChild(fullScreen);
      if (fullScreen.clientWidth > fullScreen.clientHeight) {
        frame.style.width = "100vh";
        frame.style.height = "100vh";
      } else {
        frame.style.width = "100%";
        frame.style.height = "auto";
      }

      let counterFS = counter;
      let sizeFS = frame.clientWidth;
      photos.style.transform = "translateX(" + -sizeFS * counterFS + "px)";
      window.addEventListener("resize", () => {
        if (fullScreen.clientWidth < fullScreen.clientHeight) {
          frame.style.width = "100%";
          frame.style.height = "auto";
        } else {
          frame.style.width = "100vh";
          frame.style.height = "100vh";
        }
      });
      fullScreen.addEventListener("click", (e) => {
        if (
          e.target.classList.contains("fullScreen") ||
          e.target.classList.contains("exit")
        ) {
          interval = setInterval(slide, time);
          body.removeChild(fullScreen);
        } else if (e.target.classList.contains("next")) {
          photos.style.transition = "transform 0.5s linear";
          counterFS++;
          photos.style.transform = "translateX(" + -sizeFS * counterFS + "px)";

          setTimeout(() => {
            if (counterFS >= images.length - 1) {
              photos.style.transition = "none";
              counterFS = 1;
              photos.style.transform =
                "translateX(" + -sizeFS * counterFS + "px)";
            }
          }, 500);
        } else if (e.target.classList.contains("prev")) {
          photos.style.transition = "transform 0.5s linear";
          counterFS--;
          photos.style.transform = "translateX(" + -sizeFS * counterFS + "px)";
        }
        setTimeout(() => {
          if (counterFS <= 0) {
            photos.style.transition = "none";
            counterFS = images.length - 2;
            photos.style.transform =
              "translateX(" + -sizeFS * counterFS + "px)";
          }
        }, 500);
      });
    } else {
      const photos = slider.cloneNode(true);
      photos.style = "";
      photos.className = "photos";
      const frame = document.createElement("div");
      frame.className = "frame";
      frame.appendChild(photos);
      const exit = document.createElement("button");
      exit.textContent = "x";
      exit.className = "exit secondaryBtn";
      const fullScreen = document.createElement("div");
      fullScreen.className = "fullScreen";
      fullScreen.appendChild(exit);
      fullScreen.appendChild(frame);
      body.appendChild(fullScreen);
      if (fullScreen.clientWidth > fullScreen.clientHeight) {
        frame.style.width = "100vh";
        frame.style.height = "100vh";
      } else {
        frame.style.width = "100%";
        frame.style.height = "auto";
      }

      window.addEventListener("resize", () => {
        if (fullScreen.clientWidth < fullScreen.clientHeight) {
          frame.style.width = "100%";
          frame.style.height = "auto";
        } else {
          frame.style.width = "100vh";
          frame.style.height = "100vh";
        }
      });
      fullScreen.addEventListener("click", (e) => {
        if (
          e.target.classList.contains("fullScreen") ||
          e.target.classList.contains("exit")
        ) {
          body.removeChild(fullScreen);
        }
      });
    }
  });
});
