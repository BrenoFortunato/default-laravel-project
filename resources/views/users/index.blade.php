@extends("layouts.app")

@section("content")
    <div class="content">
        @include("flash::message")
        @include("adminlte-templates::common.errors")

        <div class="box box-primary">
            <section class="content-header">
                <h1 class="title-header">{{ mb_strtoupper(Lang::choice("tables.users", "p"), "UTF-8") }}</h1>
                <a class="table-header-button" href="{{ route('users.create') }}"><i class="fas fa-plus table-header-icon"></i><span class="table-header-text">{{ mb_strtoupper(Lang::get("text.add"), "UTF-8") }}<span></a>
            </section>

            <div class="box-body">
                @include("users.table")
            </div>
        </div>
    </div>
@endsection