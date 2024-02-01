"use strict";

let addButton = document.querySelector(".add-button button");

addButton.addEventListener("click", () => {
  let text = document.querySelector(".add-field input").value;
  if (text.trim() != "") {
    createElements(text);
    selection();
  }
});
selection();
/**
 *
 * @param  {string} text
 */
function createElements(text) {
  let date = Date.now();
  let str = `<div class="list-container"><div class="list" id="${date}">${text}</div><button class="delete-button" id="${date}">Delete</button></div>`;
  document.querySelector(".list-area").innerHTML += str;
}

function selection() {
  document.querySelectorAll(".list-container").forEach((element) => {
    element.addEventListener("click", (e) => {
      if (e.target.classList.contains("delete-button")) return;
      element.classList.toggle("list-container");
      element.classList.toggle("selected");
    });
    element.querySelector(".delete-button").addEventListener("click", () => {
      console.log("clicked");
      deletion(element);
    });
  });
}
/**
 * @param {HTMLElement} element
 */
function deletion(element) {
  if (element.classList.contains("selected")) element.remove();
}
