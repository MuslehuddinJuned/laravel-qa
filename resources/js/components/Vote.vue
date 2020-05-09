<template>
    <div>
        <a @click.prevent="voteUp" :title="title('up')" 
            class="vote-up" :class="classes">
            <i class="fas fa-caret-up fa-4x"></i>
        </a>
        <span class="votes-count">{{count}}</span>
        <a @click.prevent="voteDown" :title="title('down')" 
            class="vote-down" :class="classes">
            <i class="fas fa-caret-down fa-4x"></i>
        </a>
    </div>
</template>

<script>
export default {
    props:['name', 'model'],

    computed:{
        classes(){
            return this.signedIn ? '' : 'off';
        },

        endpoint(){
            return `/${this.name}s/${this.id}/vote`
        }
    },

    data (){
        return{
            count: this.model.votes_count,
            id: this.model.id
        }
    },

    methods:{
        title(voteType){
            let titles = {
                up: `This ${this.name} is useful`,
                down: `This ${this.name} is not useful`
            };

            return titles[voteType];
        },

        voteUp(){
            this._vote(1);
        },

        voteDown(){
            this._vote(-1);
        },

        _vote(vote){
            if(! this.signedIn){
                this.$toast.warning('Lonin Please', 'Warning', {
                    timeout: 3000,
                    position: 'bottomLeft'
                });
                return;
            }
            axios.post(this.endpoint, {vote})
            .then(res=>{
                this.$toast.success(res.data.message, "Sucess", {
                    timeout: 3000,
                    position: 'bottomLeft'
                });
                this.count = res.data.votesCount;
            })
        }
    }

}
</script>

<style>

</style>