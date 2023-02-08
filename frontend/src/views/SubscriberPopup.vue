<template>
    <b-modal id="subscriberPopup" title="BootstrapVue" hide-footer hide-header>
        <div class="popup-order">
            <div class="close-icon" @click="closePopup">
                <img src="../assets/img/close-icon.svg" class="line-left" />
                <img src="../assets/img/close-icon.svg" class="line-right" />
            </div>
            <div class="popup-order--discount">
                <span class="popup-order--discount-size">10%</span>
                <span class="popup-order--discount-text">off</span>
            </div>
            <div class="popup-order--description">your first order</div>
            <div class="popup-order--line-container">
                <span class="popup-order--line"></span>
            </div>
            <form name="subscriber" @submit="crateSubscription" method="post" class="form">
                <div class="form--group">
                    <label for="email" class="form--label">Email-address</label>
                    <input id="email" name="email" v-model="formItems.email" type="email" class="form--input-text">
                </div>
                <input type="submit" class="form--submit" value="Subscribe!">
                <div class="form-check">
                    <input id="confirm" name="confirm" type="checkbox" class="form-check-input">
                    <label class="form-check-label" for="confirm">
                        I'm agree with privacy policy
                    </label>
                </div>
            </form>
        </div>
    </b-modal>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            formItems: {
                email: ''
            },
            resultTest: [],
            questionForm: false,
            question: {},
            answer: {},
            endTestText: '',
            headers: {
                'Content-Type': 'text/plain'
            }
        };
    },
    methods: {
        closePopup: function () {
            this.$bvModal.hide('subscriberPopup')
        },
        crateSubscription: function(e) {
            e.preventDefault();
            const headers = this.headers;

            axios.post(`http://127.0.0.1:7777/create`, {
                    email: this.formItems.email,
                },
                {headers}
            )
                .then((response) => {
                    let data = response.data.userId;
                    this.formItems.userId = data;
                    this.questionForm = !!data;
                })
                .catch((error) => {
                    console.log(error);
                });

            return false;
        },
        // saveTest: function(e) {
        //     e.preventDefault();
        //     const headers = this.headers;
        //     this.formItems.questionId = this.question.id;
        //     this.formItems.sort = this.question.sort;
        //
        //     axios.post(`http://127.0.0.1:7777/save-test`,
        //         this.formItems,
        //         {headers}
        //     )
        //         .then((response) => {
        //             if (this.formItems.nextQuestion) {
        //                 this.getQuestion();
        //             } else {
        //                 this.endTestText = 'Благодарим за тест!';
        //                 this.getResultTest();
        //             }
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },
        // generalInformation: function(nextQuestion, answerId) {
        //     this.formItems.nextQuestion = !!nextQuestion;
        //     this.formItems.answerIds.push(answerId);
        // },
        // getQuestion: function() {
        //     axios.get(`http://127.0.0.1:7777/question?sort=${this.formItems.sort}`)
        //         .then((response) => {
        //             let data = response.data;
        //             this.question = data.question;
        //             this.answer = data.answer;
        //             this.formItems.answer = []
        //             this.formItems.answerIds = []
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },
        // getResultTest: function() {
        //     axios.get(`http://127.0.0.1:7777/result-test`)
        //         .then((response) => {
        //
        //             console.log('response', response)
        //
        //             this.resultTest = response.data.resultTest
        //
        //
        //             console.log('this.resultTest', this.resultTest)
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // }
    }
}


</script>