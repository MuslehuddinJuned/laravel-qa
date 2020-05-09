<answer :answer="{{ $answer }}" inline-template>
    <div class="media">
        <div class="d-flex flex-column vote-controls">
            <a title="This answer is useful"
            class="vote-up {{Auth::guest() ? 'off' : ''}}"
            onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();">
            <i class="fas fa-caret-up fa-4x" aria-hidden="true"></i>
            </a>
            <form id="up-vote-answer-{{ $answer->id }}" action="/answers/{{$answer->id}}/vote" method="POST" style="display:none;">
                @csrf
                <input type="hiden" name="vote" value="1">
            </form>
            <span class="votes-count">{{$answer->votes_count}}</span>
            <a title="This answer is not useful" 
                class="vote-down {{Auth::guest() ? 'off' : ''}}"
                onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();">
                <i class="fas fa-caret-down fa-4x" aria-hidden="true"></i>
            </a>
            <form id="down-vote-answer-{{ $answer->id }}" action="/answers/{{$answer->id}}/vote" method="POST" style="display:none;">
                @csrf
                <input type="hiden" name="vote" value="-1">
            </form>

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