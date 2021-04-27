@isset($user->id)
    {{-- Id Field --}}
    <div class="form-group col-md-12">
        {{ Form::label("id", \Lang::get("attributes.id").":") }}
        <p>{{ $user->id }}</p>
    </div>
@endisset

@isset($user->name)
    {{-- Name Field --}}
    <div class="form-group col-md-12">
        {{ Form::label("name", \Lang::get("attributes.name").":") }}
        <p>{{ $user->name }}</p>
    </div>
@endisset

@isset($user->email)
    {{-- Email Field --}}
    <div class="form-group col-md-12">
        {{ Form::label("email", \Lang::get("attributes.email").":") }}
        <p>{{ $user->email }}</p>
    </div>
@endisset

@isset($user->readable_role_name)
    {{-- Role Field --}}
    <div class="form-group col-md-12">
        {{ Form::label("role_name", \Lang::get("attributes.role_name").':') }}
        <p>{{ $user->readable_role_name }}</p>
    </div>
@endisset

@isset($user->readable_is_active)
    {{-- Is Active Field --}}
    <div class="form-group col-md-12">
        {{ Form::label("is_active", \Lang::get("attributes.is_active").":") }}
        <p>{{ $user->readable_is_active }}</p>
    </div>
@endisset

@if(!$user->isPhotoDefault())
    {{-- Photo Field --}}
    <div class="form-group col-md-12">
        {{ Form::label("photo", \Lang::get("attributes.photo").":") }}
        <div class="restrict-link no-margin">
            <a href="{{ $user->photo }}" target="_blank">
                <img class="img-thumbnail" src="{{ $user->photo }}"/>
            </a>
        </div>
    </div>
@endif

@isset($user->readable_created_at)
    {{-- Created At Field --}}
    <div class="form-group col-md-12">
        {{ Form::label("created_at", \Lang::get("attributes.created_at").":") }}
        <p>{{ $user->readable_created_at }}</p>
    </div>
@endisset

@isset($user->readable_updated_at)
    {{-- Updated At Field --}}
    <div class="form-group col-md-12">
        {{ Form::label("updated_at", \Lang::get("attributes.updated_at").":") }}
        <p>{{ $user->readable_updated_at }}</p>
    </div>
@endisset

{{-- Bottom Buttons Field --}}
<div class="form-group col-md-12 no-margin">
    <a href="{{ route('users.index') }}" class="btn btn-default">{{ \Lang::get("text.back") }}</a>
</div>