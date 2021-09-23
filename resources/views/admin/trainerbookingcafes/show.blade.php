@include('layouts2.header')
@include('partials.menu') 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="m-0">Show Trainer Package Rental</h1>
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
        
        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Trainer Name:</strong>
                        {{ $trainer->trainer_name }}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Trainer Image:</strong>
                        <img src="/trainer/{{ $trainer->trainer_image_name }}" width="500px">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Trainer Description:</strong>
                        {{ $trainer->trainer_description }}
                    </div>
                </div>
            </div>

       

      </div>
    </section>
</div>   

@include('layouts2.footer')

