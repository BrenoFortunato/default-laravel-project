@extends("layouts.app")

@section("content")
    @include("flash::message")
    @include("adminlte-templates::common.errors")

    <div class="box box-primary">
        <section class="content-header">
            <h1>
                <span class="title-header-small">{{ mb_strtoupper(Lang::get("text.add"),"UTF-8") }} <i class="fas fa-angle-right"></i></span> 
                <span class="title-header">{{ mb_strtoupper(Lang::choice("tables.users", "s"),"UTF-8") }}</span>
            </h1>
        </section>

        <div class="box-body">
            {{ Form::open(["route" => ["users.store"], "files" => true]) }}
                <div class="row">
                    @include("users.fields")
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection