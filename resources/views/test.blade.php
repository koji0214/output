<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body {
            padding: 50px;
        }

    </style>
</head>
<body>
    <div id="app" class="row">
        <!-- クイズを表示する部分 -->
        <div class="offset-3 col-6" v-if="!completed">
            <div class="card">
                <div class="card-body">
                    <p class="badge badge-dark">第 @{{(questionIndex+1)}}  問</p>
                    <br>
                    <h4 class="card-title"> @{{currentQuestion.question}} </h4>
                    <hr>
                    <button
                        type="button"
                        class="btn btn-primary btn-lg btn-block text-left"
                        v-for="(answer,index) in currentQuestion.answers"
                        @click="addAnswer(index)"> @{{(index+1)}}. @{{answer}} </button>
                </div>
            </div>
        </div>

        <!-- 結果表示する部分 -->
        <div class="offset-3 col-6" v-if="completed">
            <div class="card">
                <div class="card-body">
                    <p class="badge badge-dark">結果</p>
                    <div v-for="(question,index) in this.questions">
                        <h4 class="card-title"> @{{question.question}} </h4>
                        <ul>
                            <li v-for="answer in question.answers"> answer </li>
                        </ul>
                        <span v-if="question.answer == answers[index]">正解 &#x1F44D;（ @{{question.answers[question.answer]}} ）</span>
                        <span v-else>不正解 &#x1F622;<br>正解は「 @{{question.answers[question.answer]}} 」でした。</span>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
    <script>

        new Vue({
            el: '#app',
            data: {
                answers: [],
                questionIndex: 0,
                questions: [
                    {
                        question: '囲碁の石の大きさはどっちが大きい？',
                        answers: [
                            '白い石',
                            '黒い石',
                            'どちらも同じ',
                        ],
                        answer: 1
                    },
                    {
                        question: 'コンビニチェーン・セブンイレブンのアルファベット表記で１文字だけ小文字なのは？',
                        answers: [
                            'N',
                            'L',
                            'V',
                        ],
                        answer: 0
                    },
                    {
                        question: 'カラオケは「空○○」略です。空欄に入る言葉は何？',
                        answers: [
                            'OK',
                            'オーケストラ',
                            'おけら',
                        ],
                        answer: 1
                    }
                ]
            },
            methods: {
                addAnswer: function(index) {

                    this.answers.push(index);

                    if(!this.completed) {

                        this.questionIndex++;

                    }

                }
            },
            computed: {
                currentQuestion: function() {

                    return this.questions[this.questionIndex];

                },
                completed: function() {

                    return (this.questions.length == this.answers.length);

                }
            }
        })

    </script>
</body>
</html>
