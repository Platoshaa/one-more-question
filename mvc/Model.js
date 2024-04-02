export class Model {
  constructor(data = "", d = 2, task = "story", allGrammar = true) {
    this.difficulty = d;
    this.currentTask = task;
    this.allGrammar = allGrammar;
    this.data = data;
  }

  bindDataChanged(cb) {
    this.onDataChanged = cb;
  }

  getStory() {
    let arr = new Set();
    let d = [];
    if (this.difficulty > 0) {
      for (let i = 0; i <= this.difficulty; i++) {
        d = [...d, ...this.data.story[i]];
      }
    } else {
      d = [...this.data.story[0]];
    }
    for (let i = 0; arr.size < 5; i++) {
      arr.add(randomizeArray(d));
    }

    if (this.allGrammar) {
      return [
        Array.from(arr).join(" "),
        randomizeArray([
          ...this.data.grammar[0],
          ...this.data.grammar[1],
          ...this.data.grammar[2],
        ]),
      ];
    } else {
      return [
        Array.from(arr).join(" "),
        randomizeArray(this.data.grammar[this.difficulty]),
      ];
    }
  }
  getQuestion() {
    return randomizeArray(this.data.question[this.difficulty]);
  }
  changeDifficulty(dif) {
    this.difficulty = dif;
    this.getTask();
  }
  changeTask(t) {
    this.currentTask = t;
    this.getTask();
  }
  getTask(t = this.currentTask) {
    const res = () => {
      switch (t) {
        case "story": {
          return this.getStory();
        }
        case "question": {
          return this.getQuestion();
        }
      }
    };
    this.onDataChanged(res(), this.currentTask);
  }
}
