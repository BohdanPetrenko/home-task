@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i>Error(s) occured during processing request</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
