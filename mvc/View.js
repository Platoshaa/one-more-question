export class View {
  constructor() {
    this.scr = document.querySelector(".game-screen");
    this.difficultyBtns = document.querySelectorAll(
      '.custom-radio[name="dif"]'
    );
    this.allGrammar = document.getElementById("grammar");
    this.taskBtns = document.querySelectorAll('.custom-radio[name="task"]');
    this.handler = (e) => {
      if (e.target.nodeName === "A") {
      } else {
        this.scr.removeEventListener("click", this.handler);
        this.get();
      }
    };
  }

  render(data, type) {
    this.scr.className = `game-field ${type}`;
    window.addEventListener("keyword", this.get, { once: true });
    this.scr.addEventListener("click", this.handler);
    if (type === "story") {
      document.querySelector(".story__words-words").innerHTML = data[0];
      document.querySelector(".story__pl").innerHTML = data[1].title;
      document.querySelector(".popup__title").innerHTML = data[1].title;
      document.querySelector(
        ".content-popup__examples"
      ).innerHTML = `<span>Hi, i'm SO lazy about writing examples SOOORY. Actually if you want to train you could write them yourself and send me to add it. You can contact me via <a class="link" target='_blank' href='https://t.me/kiborgPlatosha'>telegram</a></span>`;
      if (data[1].examples) {
        document.querySelector(".content-popup__examples").innerHTML =
          data[1].examples;
      }
    } else {
      document.querySelector(".story__pl").innerHTML = "";
      document.querySelector(".story__words-words").innerHTML = data;
    }
  }

  changeDifficulty(difSwitchHandler) {
    this.scr.removeEventListener("click", this.handler);
    this.difficultyBtns.forEach((e) => {
      e.addEventListener("change", () => {
        let dif = Number(
          document.querySelector('.custom-radio[name="dif"]:checked').id
        );
        difSwitchHandler(dif);
      });
    });
  }
  changeTask(taskSwitchHandler) {
    this.scr.removeEventListener("click", this.handler);
    this.taskBtns.forEach((e) => {
      e.addEventListener("change", () => {
        let t = document.querySelector('.custom-radio[name="task"]:checked').id;
        taskSwitchHandler(t);
      });
    });
  }
  changeGrammar(taskSwitchHandler) {
    this.scr.removeEventListener("click", this.handler);
    this.allGrammar.addEventListener("change", (e) => {
      taskSwitchHandler(e.target.checked);
    });
  }
}
