<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>{{title}}</h1>                    
                        <div class="ml-auto">
                            <a href="/questions" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </div>                    
                </div>

                <form class="card-body" v-if="editing" @submit.prevent="update">
                    <div class="card-title">
                        <input type="text" class="form-control form-control-lg" v-model="title">
                    </div>
                    <div class="media-body">
                        <div class="form-group">
                            <textarea rows="10" class="form-control" v-model="body"></textarea>
                        </div>
                        <button class="btn btn-primary" :disabled="isInvalid">Update</button>
                        <button class="btn btn-outline-secondary" @click="cancel" type="button">Cancel</button> 
                    </div>
                </form>

                <div class="card-body" else> 
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <vote :model="question" name="question"></vote> 
                            <favorite :question="question"></favorite>
                        </div>
                        <div class="media-body">                   
                            <div v-html="bodyHtml"></div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        <a v-if="authorize('modify', question)" @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                                        <button v-if="authorize('deleteQuestion', question)" @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <user-info :model="question" label="Asked"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['question'],

    data(){
        return{
            title: this.question.title,
            body: this.question.body,
            bodyHtml: this.question.body_html,
            editing: false,
            id: this.question.id,
            beforeEditCache: {}
        }
    },

    computed: {
        isInvalid (){
            return this.body.length < 10 || this.title.length < 10;
        },

        endpoint(){
            return `/questions/${this.id}`;
        }
    },

    methods: {
        edit(){
            this.beforeEditCache = {
                body: this.body,
                title: this.title
            };
            this.editing = true;
        },

        cancel() {
            this.body = this.beforeEditCache.body;
            this.title = this.beforeEditCache.title;
            this.editing = false;
        },

        update() {
            axios.put(this.endpoint, {
                body: this.body,
                title: this.title
            })
            .then(({data}) => {
                this.bodyHtml = data.body_html;
                this.$toast.success(data.message, "Success", {timeout: 3000});
                this.editing = false;
            })
            .catch(({response}) => {
                this.$toast.error(response.data.message, "Error", {timeout: 3000});
            })
        },

        destroy () {
            this.$toast.question('Are you sure about that?', "Confirm", {
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Hey',            
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', (instance, toast) => {
                    
                    axios.delete(this.endpoint)
                    .then(({data}) => {
                        this.$toast.success(data.message, 'Success', { timeout: 2000})                        
                    });

                    setTimeout(() => {
                        window.location.href = "/questions";
                    }, 3000);
                    
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }, true],
                ['<button>NO</button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }],
            ]            
            });            
        }
    }
}
</script>

<style>

</style> 