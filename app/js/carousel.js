const carousel = document.querySelector("div#worksK");

const carouselItem = document.querySelectorAll("div#worksK div.work");
const prewBtn = document.querySelectorAll("div#worksK i#prew");
const nextBtn = document.querySelectorAll("div#worksK i#next");
let counter = 0;
let time = 5000;
let intervalK;
function next() {
  if (counter >= carouselItem.length - 1) {
    counter = 0;
    carouselItem[carouselItem.length - 1].className = " work hidden";
    carouselItem[counter].className = " work active";
    setTimeout(() => {
      carouselItem[carouselItem.length - 1].className = " work pre";
    }, 1000);
  } else {
    counter++;
    carouselItem[counter - 1].className = " work hidden";
    carouselItem[counter].className = "work active";
    setTimeout(() => {
      carouselItem[counter - 1].className = " work pre";
    }, 1000);
  }
}
function prew() {
  if (counter == 0) {
    counter = carouselItem.length - 1;
    carouselItem[0].className = " work hidden";
    carouselItem[counter].className = " work active";
    setTimeout(() => {
      carouselItem[0].className = " work pre";
    }, 1000);
  } else {
    counter--;
    carouselItem[counter + 1].className = " work hidden";
    carouselItem[counter].className = " work active";
    setTimeout(() => {
      carouselItem[counter + 1].className = " work pre";
    }, 1000);
  }
}
nextBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    clearInterval(intervalK);
    intervalK = setInterval(next, time);
    next();
  });
});
prewBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    clearInterval(intervalK);
    intervalK = setInterval(next, time);
    prew();
  });
});
intervalK = setInterval(next, time);

// SONATA CAROUSEL
const carouselS = document.querySelector("div#worksK");

const carouselItemS = document.querySelectorAll("div#worksS div.work");
const prewBtnS = document.querySelectorAll("div#worksS i#prew");
const nextBtnS = document.querySelectorAll("div#worksS i#next");
let counterS = 0;
let intervalS;
function nextS() {
  if (counterS >= carouselItemS.length - 1) {
    counterS = 0;
    carouselItemS[carouselItemS.length - 1].className = " work hidden";
    carouselItemS[counterS].className = " work active";
    setTimeout(() => {
      carouselItemS[carouselItemS.length - 1].className = " work pre";
    }, 1000);
  } else {
    counterS++;
    carouselItemS[counterS - 1].className = " work hidden";
    carouselItemS[counterS].className = "work active";
    setTimeout(() => {
      carouselItemS[counterS - 1].className = " work pre";
    }, 1000);
  }
}
function prewS() {
  if (counterS == 0) {
    counterS = carouselItemS.length - 1;
    carouselItemS[0].className = " work hidden";
    carouselItemS[counterS].className = " work active";
    setTimeout(() => {
      carouselItemS[0].className = " work pre";
    }, 1000);
  } else {
    counterS--;
    carouselItemS[counterS + 1].className = " work hidden";
    carouselItemS[counterS].className = " work active";
    setTimeout(() => {
      carouselItemS[counterS + 1].className = " work pre";
    }, 1000);
  }
}
nextBtnS.forEach((btn) => {
  btn.addEventListener("click", () => {
    clearInterval(intervalS);
    intervalS = setInterval(nextS, time);
    nextS();
  });
});
prewBtnS.forEach((btn) => {
  btn.addEventListener("click", () => {
    clearInterval(intervalS);
    intervalS = setInterval(nextS, time);
    prewS();
  });
});

intervalS = setInterval(nextS, time);
