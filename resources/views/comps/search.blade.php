<div>
	@csrf
	<style type="text/css" scoped="">
		div[search-field] {
			/*width: 50%;*/
			margin-top: 0;
		}
		input[type=text] {
			/*color: #14fb00;*/
			font-size: 20px !important;
			font-family: Consolas;
			letter-spacing: 0.5px;
			text-align: center;
		}

		/* Inactive/Active Default input field color */
		.input-field input[type=text]:not([readonly]),
		.input-field input[type=text]:focus:not([readonly]),
		.input-field textarea:not([readonly]),
		.input-field textarea:focus:not([readonly]) {
		    /*border-bottom: 1px solid red;*/
		    /*box-shadow: 0 1px 0 0 #01579b;*/
		}

		.input-field input[type=text]:focus {
		    border-bottom: 1px solid #e33 !important; 
		    box-shadow: none !important;
		}


		/* Inactive/Active Default input label color */
		.input-field input[type=text]:focus:not([readonly])+label,
		.input-field textarea:focus:not([readonly])+label {
		    color: red;
		}

		.input-field > label:not(.label-icon).active {
		    -webkit-transform: translateY(-14px) scale(1);
		    transform: translateY(-14px) scale(1);
		    -webkit-transform-origin: 0 0;
		    transform-origin: 0 0;
		    text-align: center;
		    width: 100%;
		}

		.input-field > label {
		    text-align: center;
		    /*left: -1.3rem !important;*/
		}

		.material-icons.active {
			/*color: #14fb00 !important;*/
		}

		input[type="submit"] {
			color: white;
			cursor: pointer;
		}
	
		div.input-field label {
			cursor: pointer;
		}
	</style>
	<div class="row">
		<div class="col s12 m10 l10">
			<div class="input-field tooltipped" 
				search-field
				data-tooltip="Use this input to search for a potential fraudulent address"
			>
				<input id="search_address" 
						name="address"
						type="text" 
						class="validate "
						required
						autofocus
						onclick="this.select()"
						value="{{ request()->post('address') ?? null }}"
						onkeydown="
							if(event.keyCode === 13 || event.which === 13)
								window.location = '/search/'+event.target.value
						" 
						>
				<label for="search_address">It can be BTC, ETH, XRM, etc...</label>
			</div>
		</div>
		<div class="col s1 m2 l2 offset-s4">
			<button class="btn green waves-effect" 
					onclick="window.location = '/search/'+document.getElementById('search_address').value">Search</button>
		</div>
		<div class="col s12">
		</div>
	</div>
</div>