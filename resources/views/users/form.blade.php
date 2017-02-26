{{ csrf_field() }}

@if($user->image)
    <div class="user form-group">
        <img class="user-image"
             src="{{ asset(str_replace('public', 'storage', $user->image)) }}">
    </div>
@endif

<div class="form-group">
    <label for="image" class="col-md-2 control-label"> Image </label>

    <div class="col-md-8">
        <input id="image" type="file" class="form-control" name="image"
               value="{{ $user->image }}">
    </div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-2 control-label"> Name </label>

    <div class="col-md-8">
        <input id="name" type="text" class="form-control" name="name"
               value="{{ $user->name }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-2 control-label"> Email </label>

    <div class="col-md-8">
        <input id="email" type="text" class="form-control" name="email"
               value="{{ $user->email }}">

        @if ($errors->has('email'))
            <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-2 control-label"> Password </label>

    <div class="col-md-8">
        <input id="password" type="password" class="form-control" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="password-confirmation" class="col-md-2 control-label"> Password Confirmation </label>

    <div class="col-md-8">
        <input id="password-confirmation" type="password" class="form-control"
               name="password_confirmation">
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-5">
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </div>
</div>