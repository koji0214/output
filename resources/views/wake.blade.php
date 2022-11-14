
<div id="quiz" class="row">
    <!-- クイズを表示する部分 -->
    <div class="offset-3 col-6" v-if="!completed[0]">
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
    <div class="offset-3 col-6" v-if="completed[0]">
        <div class="card">
            <div class="card-body">
                <p class="badge badge-dark">結果</p>
                <div v-for="(question,index) in this.questions">
                    <h4 class="card-title"> @{{question.question}} </h4>
                    <ul>
                        <li v-for="answer in question.answers"> @{{answer}} </li>
                    </ul>
                    <span v-if="question.answer == answers[index]">正解 &#x1F44D;（ @{{question.answers[question.answer]}} ）</span>
                    <span v-else>不正解 &#x1F622;<br>正解は「 @{{question.answers[question.answer]}} 」でした。</span>
                    <hr>
                </div>
                <div v-if="completed[1]">
                    <a href="{{route('home.create')}}">睡眠時間登録へ</a>
                </div>
                <div v-if="!completed[1]">
                    <a href="">もう一度挑戦！</a>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>

<script>
    
new Vue({
    el: '#quiz',
    data: {
        answers: [],
        questionIndex: 0,
        questions: [
            @for($i=0;$i<3;$i++)
            {
                question: '{{$question[$i]->question}}',
                answers: [
                    @foreach($choices[$i] as $c)
                        '{{$c}}',
                    @endforeach
                ],
                answer: {{$correct_key[$i]}}
            },
            @endfor
            
        ]
    },
    methods: {
        addAnswer: function(index) {

            this.answers.push(index);

            if(!this.completed[0]) {

                this.questionIndex++;

            }

        }
    },
    computed: {
        currentQuestion: function() {

            return this.questions[this.questionIndex];

        },
        completed: function() {
            let isFinished = this.questions.length == this.answers.length;
            
            let correctCount = 0;
            for(let i in this.answers) {
                let answer = this.answers[i];
                if(answer == this.questions[i].answer) {
                    correctCount++;
                }
            }
            let isAllCorrected = correctCount==3;
            
            return ([isFinished,isAllCorrected]);

        }
    }
})

</script>
    
