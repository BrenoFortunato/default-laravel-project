{{ Form::open(["route" => ["users.destroy", $id], "method" => "delete"]) }}
    <div class="btn-group">
        <a href="{{ route('users.show', [$id]) }}" class="btn btn-default btn-xs" data-toggle="tooltip" title="{{ Lang::get('text.details') }}">
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route('users.edit', [$id]) }}" class="btn btn-default btn-xs" data-toggle="tooltip" title="{{ Lang::get('text.edit') }}">
            <i class="fas fa-edit"></i>
        </a>
        {{ Form::button("<i class='fas fa-trash'></i>", [
            "type"        => "submit",
            "onclick"     => "confirmMessage(event)",
            "class"       => "btn btn-danger btn-xs",
            "data-toggle" => "tooltip",
            "title"       => Lang::get("text.remove"),
        ]) }}
    </div>
{{ Form::close() }}