@extends('template.main')
@extends('template.nav')
@section('title','titulo')

@section('content')




  <div id="page-wrapper">
      <div class="row"><br>




          <div class="panel-body">
              <div class="col-lg-12">
                  <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">

                  </table>
              </div>
              <!-- /.col-lg-12 -->
          </div>



          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->
@endsection

@section('script')


<script src="{{ asset('js/prueba.js')}}">

@endsection
