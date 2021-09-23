@include('layouts2.header')
@include('partials.menu') 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="m-0">Edit Trainer Package Rental</h1>
          </div><!-- /.col -->
          <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.packagerentals.index') }}"> Back</a>
        </div>          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
               @endforeach
            </ul>
          </div>
        @endif

        
        {!! Form::model($packagerental, ['method' => 'PATCH','route' => ['packagerentals.update', $packagerental->id]]) !!}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Trainer Package Rental Name:</strong>
                    {!! Form::text('trainer_name', null, array('placeholder' => 'Trainer Package Rental Name','class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Trainer Package Cafe Image:</strong>
                    <input type="file" name="trainer_image" class="form-control" placeholder="Trainer Package Cafe Image">
                    <img src="/trainer/{{ $packagerental->trainer_image_name }}" width="300px">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Trainer Package Cafe Description:</strong>
                    {!! Form::textarea('trainer_description', null, array('placeholder' => 'Trainer Package Cafe Description','class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}

      </div>
    </section>
</div>   

@include('layouts2.footer')

