@extends('layouts.app')

@section('content')

    <h1> {{ $post->title }} </h1>
    <span>
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        {{ $post->user->name }}
    </span>
    <span class="tag label label-primary"
          v-for="tag in tags">
        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
        @{{ tag.name }}
    </span>
    <article>
        <p v-for="p in post.body.split('\n')"> @{{ p }} </p>
    </article>

    @if($post->isOwner())
        <a href="{{ route('posts_edit', ['post' => $post->id]) }}"
           class="btn btn-primary">
            Edit
        </a>
    @endif
    <hr>
    <div>
        <b>Comments</b>

        <template v-for="comment in comments">
            <section>
                @{{ comment.user.name }} : @{{ comment.body }}
                <a v-show="isCommentOwner(comment.user)" @click="editComment(comment)"
                    class="btn btn-sm btn-primary"> Edit </a>
                <a v-show="isCommentOwner(comment.user)" @click="deleteComment(comment)"
                    class="btn btn-sm btn-primary"> Delete </a>
                <!--Block for editing-->
                <div v-if="isCommentOwner(comment.user)" class="hidden"
                     :id="'comment-' + comment.id">
                    <div class="form-group">
                        <div class="col-md-6">
                            <textarea v-model="comment.body" class="form-control"
                                      name="body" rows="3"></textarea>
                            <button @click="saveComment(comment)"
                                class="btn btn-sm btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
                <!--Block for deletion-->
                <div v-if="isCommentOwner(comment.user)" class="hidden"
                     :id="'comment-' + comment.id + '-delete'">
                    <div class="form-group">
                        <div class="col-md-6">
                            <button @click="confirmDeleteComment(comment)"
                                class="btn btn-sm btn-primary">
                                Confirm
                            </button>
                        </div>
                    </div>
                </div>

            </section>
            <div class="clearfix"></div>
        </template>
        <br>

        Add your comment:
        @if(auth()->guest())
            <p>Login to add comment.</p>
        @else

            <form method="POST"
                  action="{{ route('comments_add', ['post' => $post->id]) }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                    <div class="col-md-8">
                        <textarea id="body" class="form-control" name="body"
                                  rows="3"></textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>

        @endif

    </div>

@endsection

@section('footer')
    <script>
        const post = {!! json_encode($post) !!};
        const tags = {!! json_encode($post->tags) !!};
        const comments = {!! json_encode($post->comments) !!};
        const user = {!! json_encode(auth()->user()) !!}
    </script>
    <script src="{{ asset('js/show.js') }}"></script>
@endsection