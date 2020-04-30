@csrf
                    <div class="form-group">
                        <label for="title">Question Title</label>
                        <input type="text" name="title" value="{{old('title', $question->title)}}" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}">

                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('title')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="body">Explain your question</label>
                        <textarea name="body" id="body" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}">{{old('body', $question->body)}}</textarea>

                        @if($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('body')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-lg">{{$buttonText}}</button>
                    </div>