@extends('template.main')
@section('titulo','Registro de Ingresos')

@section('content')
<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
          <div class="container box">

				<form name="" id="" method="POST">
					<input type="hidden" id="token" value="{{ csrf_token() }}">
					<div class="row">
						<label for="name">Tu nombre:</label><br />
						<input id="name" class="input" name="name" type="text" value="" size="30" /><br />
					</div>
					<div class="row">
						<label for="email">Tu email:</label><br />
						<input id="email" class="input" name="email" type="text" value="" size="30" /><br />
					</div>
					<div class="row">
						<label for="message">Tu mensaje:</label><br />
						<textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />
					</div>
					<input id="enviar" type="submit" value="Send email" />
				</form>
			</div>
		</div>
	</div>
</div>					

@endsection

@section('script')

<script src="{{ asset('/js/email/contactanos.js')}}"></script>

@endsection