import { View } from "./View.js";
import { Model } from "./Model.js";
import { initData } from "./data.js";
class Controller {
  constructor(view, model) {
    this.model = model;
    this.view = view;
    this.model.bindDataChanged(this.view.render.bind(this.view));
    this.view.changeDifficulty(this.switchDif.bind(this));
    this.view.changeGrammar(this.switchGrammar.bind(this));
    this.view.changeTask(this.switchTask.bind(this));
    this.view.get = this.screenHandler.bind(this);
    this.screenHandler();
  }
  switchDif(dif) {
    this.model.changeDifficulty(dif);
  }
  switchGrammar(t) {
    this.model.allGrammar = t;
  }
  switchTask(t) {
    this.model.changeTask(t);
  }
  screenHandler() {
    this.model.getTask();
  }
}

initData().then((d) => {
  new Controller(new View(), new Model(d));
});
