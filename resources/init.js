import hotkeys from "hotkeys-js";
import "./visor.css";

export default class Visor {
  constructor() {
    this.isOpen = false;
    this.$toggle = document.querySelectorAll("[data-visor-toggle]");
    this.$modal = document.querySelector("[data-visor]");

    this.handleToggle = this.handleToggle.bind(this);
    this.open = this.open.bind(this);
    this.close = this.close.bind(this);

    // Change the initial display: none to display: block after DOM element added.
    // This prevents a "flash" of an animation that would've fired if a user clicked the Visor element
    this.$modal.querySelector(".Visor__modal").style.display = "block";

    this.events();
  }

  events() {
    this.$toggle.forEach(($toggle) =>
      $toggle.addEventListener("click", this.handleToggle)
    );

    hotkeys("`", this.handleToggle);
    hotkeys("esc", this.close);
  }

  handleToggle() {
    if (this.isOpen) {
      return this.close();
    }

    return this.open();
  }

  close() {
    this.isOpen = false;
    this.$modal.classList.remove("is-open");

    return true;
  }

  open() {
    this.isOpen = true;
    this.$modal.classList.add("is-open");

    return true;
  }
}
