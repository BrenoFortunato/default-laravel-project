@push("css")
    <style type="text/css">
        .password-field {
            display: none;
        }
    </style>
@endpush

{{-- Name Field --}}
<div class="form-group col-md-6">
    {{ Form::label("name", \Lang::get("attributes.name").":") }}
    {{ Form::text("name", null, ["class" => "form-control"]) }}
</div>

{{-- Email Field --}}
<div class="form-group col-md-6">
    {{ Form::label("email", \Lang::get("attributes.email").":") }}
    {{ Form::email("email", null, ["class" => "form-control"]) }}
</div>

@isset($user)
    {{-- Keep Password --}}
    <div class="form-group col-md-12">
        <div class="icheck-material-primary">
            {{ Form::checkbox("keep_password", 1, true, ["id" => "keep_password"]) }}
            {{ Form::label("keep_password", \Lang::get("attributes.keep_password")) }}
        </div>
    </div>
@endisset

{{-- Password Field --}}
<div class="form-group col-md-6 password-field">
    {{ Form::label("password", \Lang::get("attributes.password").":") }}
    {{ Form::password("password", ["class" => "form-control"]) }}
</div>

{{-- Password Confirmation Field --}}
<div class="form-group col-md-6 password-field">
    {{ Form::label("password_confirmation", \Lang::get("attributes.password_confirmation").":") }}
    {{ Form::password("password_confirmation", ["class" => "form-control"]) }}
</div>

{{-- Role Name Field --}}
<div class="form-group col-md-12">
    {{ Form::label("role_name", \Lang::get("attributes.role_name").":") }}
    {{ Form::select("role_name", ["" => "Selecionar"] + $rolesArray, null, ["class" => "form-control"]) }}
</div>

{{-- Is Active Field --}}
<div class="form-group col-md-12">
    {{ Form::label("is_active", \Lang::get("attributes.is_active").":") }}
    <div class="icheck-material-primary">
        {{ Form::radio("is_active", 1, true, ["id" => "is_active_true"]) }}
        {{ Form::label("is_active_true", \Lang::get("text.yes")) }}
    </div>
    <div class="icheck-material-primary">
        {{ Form::radio("is_active", 0, false, ["id" => "is_active_false"]) }}
        {{ Form::label("is_active_false", \Lang::get("text.no")) }}
    </div>
</div>

{{-- Photo Field --}}
<div class="form-group col-md-12">
    {{ Form::label("photo", \Lang::get("attributes.photo").":") }}
    @if(isset($user) && !$user->isPhotoDefault())
        {{-- Preview img --}}
        <div class="restrict-link">
            <a href="{{ $user->photo }}" target="_blank">
                <img class="img-thumbnail" src="{{ $user->photo }}"/>
            </a>
        </div>
        {{-- Delete img --}}
        <div class="icheck-material-primary">
            {{ Form::checkbox("photo", "delete", false, ["id" => "photo"]) }}
            {{ Form::label("photo", \Lang::get("attributes.delete_img")) }}
        </div>
    @else
        {{-- Preview img --}}
        <img src=""/>
    @endif
    <div class="custom-file">
        {{ Form::file("photo", ["class" => "form-control custom-file-input"]) }}
        {{ Form::label("photo", \Lang::get("text.choose_one"), ["class" => "custom-file-label"]) }}
    </div>
</div>

{{-- Submit Field --}}
<div class="form-group col-md-12 no-margin">
    {{ Form::submit(\Lang::get("text.save"), ["class" => "btn btn-primary"]) }}
    <a href="{{ route("users.index") }}" class="btn btn-default">{{ \Lang::get("text.cancel") }}</a>
</div>

@push("js")
    <script type="text/javascript">

        // Select2
        $("[name='role_name']").select2({
            placeholder: "Selecionar"
        });

        // Actions on page load
        $(window).on("pageshow", function() {
            $("#keep_password").trigger("change");           
        });

        // Show password fields
        $(document).on("change", "#keep_password", function(){
            if ($(this).is(":checked")) {
                $(".password-field").hide();
            } else {
                $(".password-field").show();
            }
        });
    </script>
@endpush