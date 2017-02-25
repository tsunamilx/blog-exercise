{{ csrf_field() }}

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-md-2 control-label"> Title </label>

    <div class="col-md-8">
        <input id="title" type="text" class="form-control" name="title" autofocus
               v-model="post.title">

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    <label for="body" class="col-md-2 control-label"> Body </label>

    <div class="col-md-8">
        <textarea id="body" class="form-control" name="body" rows="10"
                  v-model="post.body"></textarea>

        @if ($errors->has('body'))
            <span class="help-block">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="tags" class="col-md-2 control-label"> Tags </label>

    <div class="col-md-8">
        <input id="tags" class="form-control" name="tags" rows="10"
               :value="tagValues()"/>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-5">
        <button type="submit" class="btn btn-primary">
            Save
        </button>
        <a v-show="editing" class="btn btn-danger" data-toggle="modal" data-target="#modal">
            Delete
        </a>
    </div>
</div>

{{--Modal to confirm the deletion--}}
<div v-if="editing" id="modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"> Alert </h4>
            </div>
            <div class="modal-body">
                <p> Confirm deletion ? </p>
            </div>
            <div class="modal-footer">
                <button v-show="!loading" type="button"
                        class="btn btn-primary" data-dismiss="modal">
                    No
                </button>
                <button v-show="!loading" @click="confirmed"
                        type="button" class="btn btn-danger">
                    Yes
                </button>
                <button v-show="loading" class="btn btn-danger">
                    <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
                    Processing...
                </button>
            </div>
        </div>
    </div>
</div>