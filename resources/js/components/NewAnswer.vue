<template>
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Post your Answer</h2>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="10" v-model="body" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" :disabled="isInvalid" class="btn btn-lg btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['questionId'],

    methods: {
        create(){
            axios.post(`/questions/${this.questionId}/answers`, {
                body: this.body
            })
            .then(({data}) =>{
                this.$toast.success(data.message, "Success");
                this.body = '';
                this.$emit('created', data.answer);
            })
            .catch(error => {
                this.$toast.error(error.response.data.message, "Error");
            })
        }
    },
    data(){
        return{
            body: ''
        }
    },

    computed: {
        isInvalid(){
            return !this.signedIn || this.body.length < 10;
        }
    }

}
</script>

<style>

</style>