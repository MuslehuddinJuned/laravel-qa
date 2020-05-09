<answer :answer="{{ $answer }}" inline-template>
    <div class="media">
        <div class="d-flex flex-column vote-controls">
            <vote :model="{{$answer}}" name="answer"></vote>
            <accept :answer="{{ $answer }}"></accept>
        </div>


        <div class="media-body"> 
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea rows="10" class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-primary" :disabled="isInvalid">Update</button>
                <button class="btn btn-outline-secondary" @click="cancel" type="button">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can('update', $answer)
                                <a @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                            @endcan
                            @can('delete', $answer)
                                <button @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                            @endcan
                        </div>
                    </div>
                    <div class="col-4">

                    </div>
                    <div class="col-4">
                        <user-info :model="{{ $answer }}" label="Answered"></user-info>
                    </div>
                </div>
            </div>
        </div>
    </div>
</answer>