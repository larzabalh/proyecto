@include('template.meta')
@include('template.nav')


<div class="content-wrapper">
@yield('content')

</div><!-- /.content-wrapper -->

@include('template.footer')

@yield('script')
