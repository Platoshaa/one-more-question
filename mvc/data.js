export async function initData() {
  async function responseHandler(d) {
    d = await d.json();
    d = d[0].content.match(/>.*</gi)[0].split(",");
    d.pop();
    d.shift();
    return d;
  }
  const diffEnum = {
    0: { words: 17, grammar: 4, question: 11 },
    1: { words: 15, grammar: 3, question: 9 },
    2: { words: 13, grammar: 2, question: 7 },
  };
  let data = { story: [], grammar: [], question: [] };
  async function initStoryData() {
    await initGrammar();
    await initQuestions();
    for (let i = 0; i < 3; i++) {
      let newD = await fetch(
        `https://onemorequestion.platomyworks.ru/wp-json/myplug/v2/words?id=${diffEnum[i].words}`
      );
      newD = await responseHandler(newD);
      data.story.push(newD);
    }
    return data;
  }
  async function initGrammar() {
    for (let i = 0; i < 3; i++) {
      let d = await fetch(
        `https://onemorequestion.platomyworks.ru/wp-json/myplug/v2/grammar?id=${diffEnum[i].grammar}`
      );
      d = await d.json();
      data.grammar.push(d);
    }
  }
  async function initQuestions() {
    for (let i = 0; i < 3; i++) {
      let d = await fetch(
        `https://onemorequestion.platomyworks.ru/wp-json/myplug/v2/question?id=${diffEnum[i].question}`
      );
      d = await responseHandler(d);
      data.question.push(d);
    }
  }
  return await initStoryData();
}
