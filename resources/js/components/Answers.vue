<template>
    <div class="row justify-content-center mt-4" v-cloak v-if="count">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ title }}</h2>
                </div>
                
                <answer @deleted="remove(index)" v-for="(answer, index) in answers" :answer="answer" :key="answer.id"></answer>    
           
                <div class="text-center my-3" v-if="nextUrl">
                    <button @click.prevent="fetch(nextUrl)" class="btn btn-outline-secondary">Load more</button>
                </div>      
            </div>
        </div>
    </div>
</template>

<script>

import Answer from './Answer.vue';

export default {
    props: ['question'],

    data(){
        return{
            questionId: this.question.id,
            count: this.question.answers_count,
            answers: [],
            nextUrl: null
        }
    },

    created(){
        this.fetch(`/questions/${this.questionId}/answers`);
    },

    methods: {
        remove(index){
            this.answers.splice(index, 1);
            this.count--;
        },
        fetch(endpoint){
            axios.get(endpoint)
            .then(({data})=> {
                this.answers.push(...data.data);
                this.nextUrl = data.next_page_url;
            })
        }
    },

    computed: {
        title(){
            return this.count + " " + (this.count > 1 ? 'Answers' : 'Answer');
        }
    },

    components: {Answer}
}
</script>

<style>

</style>