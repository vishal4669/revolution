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
@elseif(session('message'))
    <div class="alert alert-info alert-dismissable">
        <button class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button>
        <strong><i class="fa fa-info"></i></strong> {!! Session::get('message') !!}
    </div>
@endif