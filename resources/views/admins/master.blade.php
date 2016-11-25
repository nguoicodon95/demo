@include('admins._partials.header')

@if ($errors->has('error'))
	<div class="container-fluid">
		<div class="col-md-10 col-md-offset-1 alert alert-danger margin-top">
		    <span class="help-block">
		        {{ trans($errors->first('error')) }}
		    </span>
		</div>
	</div>
@endif

@if (Session::has('status'))
	<div class="container-fluid">
		<div class="col-md-10 col-md-offset-1 alert alert-info margin-top">
		    <span class="help-block">
		        {!! Session::get('status') !!}
		    </span>
		</div>
	</div>
@endif

@yield('content')

@include('admins._partials.footer')