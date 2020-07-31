@extends('global')

@section('title') Crypto Scam - Report a fraudulent address @endsection
@section('head')
<style type="text/css">
	input[type=text] {
		/*color: #14fb00;*/
		font-size: 20px !important;
		font-family: Consolas;
		letter-spacing: 0.5px;
	}

	textarea {
		font-size: 20px !important;
		font-family: Consolas;
		letter-spacing: 0.5px;
	}

	input[type="file"] {
		display: none;
	}

	input[type="file"] + label {
		border-bottom: 1px solid;
		padding-bottom: 0.5rem;
		cursor: pointer;
	}

	i.prefix-second {
		right: 0 !important;
		cursor: pointer;
	}

	i.prefix-second input[type="file"] {
		display: none;
	}

	i.prefix-second i.material-icons {
		color: black;
		font-size: 30px;
		position: relative;
		left: 0.5rem;
		bottom: 0.2rem;
	}

	i.prefix-second label {
		border-bottom: none;
	}

	i.prefix-second i.material-icons:hover {
		color: grey;
	}
</style>
@endsection
@section('main')
	<h3 class="hide-on-small-only" main-header>Report an address:</h3>
	<h4 class="hide-on-med-and-up" main-header>Report an address:</h4>
<br>
	<form method="POST" enctype="multipart/form-data" action="/report">
		@csrf
	    <div class="input-field">
	    	<i class="material-icons prefix">layers</i>

			<i class="prefix prefix-second">
				<input type="file" 
						id="image_scan"
						onchange="(async ()=>{
							document.getElementById('address').value = await scanQrCode(this)
							M.updateTextFields();
						})()">
				<label for="image_scan">
					<i class="material-icons  tooltipped" 
						data-tooltip="Scan QR code">camera_alt</i>
				</label>					
			</i>
	      <input 
	      		id="address" 
	      		type="text" 
	      		class="validate"
	      		required=""
	      		autofocus=""
	      		name="address"
	      		value="{{ old('address') }}">
	      <label class="hide-on-small-only" for="address">Input crypto address here. It can be BTC, ETH, XRM, etc...</label>
	      <label class="hide-on-med-and-up" for="address">Input crypto address here</label>
	    </div>	

	    <div class="input-field">
	    	<i class="material-icons prefix">info</i>
	    	<textarea id="description" 
	    			class="materialize-textarea"
	    			name="description"
	    			data-length="1023"
	    			required="" >{{ old('description') }}</textarea>

	      <label class="hide-on-small-only" for="description">A brief description about why this address is fraudulent.</label>
	      <label class="hide-on-med-and-up" for="description">Why address is fraudulent?</label>
	    </div>	

	    <div class="input-field">
	    	<i class="material-icons prefix">image</i>
	    	<input type="file" 
	    		multiple 
	    		id="proofs" 
	    		name="proofs[]" 
	    		accept=".jpg,.jpeg,.png" 
	    		onchange="labelProofsUpdate(this)" >
	    	<label for="proofs" id="label_proofs">
	    		Optional. Upload images which prove your report. 
	    		<b>DO NOT include personal information in them!!</b>
	    	</label>
	    </div>
	    <div class="hide-on-small-only" style="margin-bottom: 6rem"></div>
	    <div class="hide-on-med-and-up" style="margin-bottom: 8rem"></div>
	    <div class="center-align">
	    	<button class="btn green waves-effect">Submit</button>
	    </div>
	</form>

@endsection

@section('script')
//<script type="text/javascript">
	(()=>{
		M.updateTextFields();
		M.CharacterCounter.init(document.querySelectorAll('#description'));
	})()

	var labelProofsUpdate = function(elem){
		if(elem.files.length > 3){
			alert('You can upload only 3 proofs at most.')
			//elem.files.slice(0, 3)
		}
		
		let str='';

		for(i in elem.files){
			if(elem.files[i] instanceof File)
				str += elem.files[i].name+' | '
		}

		document.getElementById("label_proofs").innerHTML = str;
	}
//</script>
@endsection