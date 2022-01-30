"use strict";

//time function
(function () {
  function uhrzeit() {
    var jetzt = new Date(),
      h = jetzt.getHours(),
      m = jetzt.getMinutes(),
      s = jetzt.getSeconds();
    m = fuehrendeNull(m);
    s = fuehrendeNull(s);
    document.getElementById("uhr").innerHTML = h + ":" + m + ":" + s;
    setTimeout(uhrzeit, 500);
  }

  function fuehrendeNull(zahl) {
    zahl = (zahl < 10 ? "0" : "") + zahl;
    return zahl;
  }
  document.addEventListener("DOMContentLoaded", uhrzeit);
})();

//animate registered users counter
const valueCounter = document.getElementById("registeredValueCounter");
let counter = parseInt(valueCounter.innerText);
valueCounter.innerText = 0;
let i = 0;
valueCounter.classList.remove("d-none");

let inv = setInterval(function () {
  if (i < counter + 1) {
    valueCounter.innerText = i++;
  } else {
    clearInterval(inv);
  }
}, 3000 / 100);
