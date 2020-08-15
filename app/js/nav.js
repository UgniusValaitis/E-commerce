let stop = false;
const btn = document.querySelector("div#mainNavBtn");
btn.addEventListener("click", showNav);
const div = document.querySelector("div#mainNav");
const btnP = document.querySelector("div#mainProfileBtn");

btnP.addEventListener("click", showProf);
const prof = document.querySelector("div#mainProfile");
const img = document.querySelector("div#mainProfileBtn i");

function showNav() {
  if (prof.classList.contains("show") || prof.classList.contains("login")) {
    hideProf();
    btnP.removeEventListener("click", showProf);
    btn.removeEventListener("click", showNav);

    setTimeout(() => {
      div.classList.toggle("show");
      btn.classList.toggle("active");
      const nav = document.querySelectorAll("div#mainNav a");
      nav.forEach((element) => {
        element.classList.toggle("active");
      });
    }, 2000);
    setTimeout(() => {
      btnP.addEventListener("click", showProf);
      btn.addEventListener("click", showNav);
    }, 4000);
  } else {
    btnP.removeEventListener("click", showProf);
    btn.removeEventListener("click", showNav);
    div.classList.toggle("show");
    btn.classList.toggle("active");
    const nav = document.querySelectorAll("div#mainNav a");
    nav.forEach((element) => {
      element.classList.toggle("active");
    });
    setTimeout(() => {
      btnP.addEventListener("click", showProf);
      btn.addEventListener("click", showNav);
    }, 2000);
  }
}

function showProf() {
  if (div.classList.contains("show")) {
    hideNav();
    btnP.removeEventListener("click", showProf);
    btn.removeEventListener("click", showNav);
    setTimeout(() => {
      if (prof.classList.contains("show") || prof.classList.contains("login")) {
        prof.className = "hidden";
      } else {
        prof.className = "show";
      }
      if (btnP.classList.contains("active")) {
        btnP.className = "close";
      } else {
        btnP.className = "active";
      }
      setTimeout((e) => {
        if (img.classList.contains("fa-user")) {
          img.className = "fas fa-user-times";
        } else {
          img.className = "fas fa-user";
        }
      }, 550);
    }, 2000);
    setTimeout(() => {
      btnP.addEventListener("click", showProf);
      btn.addEventListener("click", showNav);
    }, 4000);
  } else {
    btnP.removeEventListener("click", showProf);
    btn.removeEventListener("click", showNav);
    if (prof.classList.contains("show") || prof.classList.contains("login")) {
      prof.className = "hidden";
    } else {
      prof.className = "show";
    }
    if (btnP.classList.contains("active")) {
      btnP.className = "close";
    } else {
      btnP.className = "active";
    }
    setTimeout((e) => {
      if (img.classList.contains("fa-user")) {
        img.className = "fas fa-user-times";
      } else {
        img.className = "fas fa-user";
      }
    }, 550);
    setTimeout(() => {
      btnP.addEventListener("click", showProf);
      btn.addEventListener("click", showNav);
    }, 2000);
  }
}

function hideNav() {
  div.classList.toggle("show");
  btn.classList.toggle("active");
  const nav = document.querySelectorAll("div#mainNav a");
  nav.forEach((element) => {
    element.classList.toggle("active");
  });
}

function hideProf() {
  if (prof.classList.contains("show") || prof.classList.contains("login")) {
    prof.className = "hidden";
  } else {
    prof.className = "show";
  }
  if (btnP.classList.contains("active")) {
    btnP.className = "close";
  } else {
    btnP.className = "active";
  }
  setTimeout((e) => {
    if (img.classList.contains("fa-user")) {
      img.className = "fas fa-user-times";
    } else {
      img.className = "fas fa-user";
    }
  }, 550);
}

// LANGUAGE

const lang = document.querySelector("input#hiddenLang");
const lt = document.querySelector("a#lt");
const en = document.querySelector("a#en");

if (lang.value == "lt") {
  lt.className = "on";
  en.className = "off";
} else if (lang.value == "en") {
  en.className = "on";
  lt.className = "off";
}
