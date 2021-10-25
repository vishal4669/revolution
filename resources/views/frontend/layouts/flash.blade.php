@if(session('success'))
    <div class="alert alert-success alert-dismissable">
        <button class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button>
        <strong><i class="fa fa-check"></i></strong> {!! Session::get('success') !!}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger alert-dismissable">
        <button class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button>
        <strong><i class="fa fa-warning"></i></strong> {!! Session::get('error') !!}
    </div>
@endif