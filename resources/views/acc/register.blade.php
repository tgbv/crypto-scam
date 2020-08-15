@extends('global')
@section('title') Crypto Scam - Register free account @endsection
@section('head')
	<!-- gCaptcha -->
	{!! htmlScriptTagJsApi(['form_id' => 'send_form']) !!}

	@if(config('app.env') === 'production')
		<!-- hCaptcha -->
		{!! HCaptcha::renderJs() !!}
	@endif

	<style type="text/css">
		form {
			margin-top: 2rem;
		}

		p {
			font-size: 22px;
			font-weight: 300;
			margin-left: 0.1rem;
		}
	</style>
@endsection
@section('main')
<h3 class="hide-on-small-only" main-header>Register account</h3>
<h4 class="hide-on-med-and-up" main-header>Register account</h4>

<p class="flow-text">An account will allow you to vote for useful reports enhancing their score.</p>

<form id="send_form" method="POST">
	@csrf

	<div class="input-field">
		<i class="material-icons prefix">email</i>
		<input id="email" type="text" class="validate" name="email" value="{{ old('email') }}">
		<label for="email">E-mail address <i>(ex: my_email_address@domain.tld)</i></label>
	</div>

	<div class="input-field tooltipped"
		data-tooltip="We'll message you a code to confirm you are human." 
	>
		<i class="material-icons prefix">phone</i>
		<input id="phone" 
				type="text" 
				class="validate " 
				name="phone"
				value="{{ old('phone') }}">
		<label for="phone">Full mobile phone number <i>(ex: +18722348822)</i></label>
	</div>

	<div class="input-field">
		<i class="material-icons prefix">vpn_key</i>
		<input id="password" type="password" class="validate" name="password">
		<label for="password">Password</label>
	</div>

	<div class="center-align">
		@if(config('app.env') === 'production')
			{!! HCaptcha::display() !!}
		@endif

		{!! htmlFormButton('Submit', ['class'=>'btn green waves-effect']) !!}
		
	</div>

</form>
@endsection