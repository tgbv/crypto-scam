@extends('global')

@section('title') Crypto Scam - An open source online database of cryptocurrency addresses used by scammers @endsection
@section('head')
<style type="text/css">

	p {
		font-size: 22px;
		font-weight: 300;
		margin-left: 0.1rem;
	}

	a {
		cursor: pointer;
	}

	a[id="read_more"] {
		margin-left: 0.5rem;
		position: relative;
		bottom: 13px;
		font-style: italic;
	}

	a[id="read_more"]:hover {
		color: red;
		text-decoration: underline;
	}
</style>
@endsection
@section('main')


	<h3 class="hide-on-small-only" main-header>Search for an address:</h3>
	<h5 class="hide-on-med-and-up" main-header>Search for an address:</h5>

	@include('comps.search')

	<h3 class="hide-on-small-only" main-header>What is this?</h3>
	<h5 class="hide-on-med-and-up" main-header>What is this?</h5>

	<p class="flow-text">
		You've probably heard of the 
		"<a href="https://news.bitcoin.com/elon-musk-bitcoin-giveaway-scam-millions-dollars-btc/"
			target="_blank">Elon Musk bitcoins giveaway"</a>. 
		Or Bill Gates posting on his 
		<a href="https://www.forbes.com/sites/billybambrough/2020/07/15/bill-gates-and-elon-musk-twitter-accounts-hijacked-in-mass-bitcoin-scam-hack"
			target="_blank">Twitter account</a> he's doubling
		the amount of bitcoins anyone sends to a custom address.
		Or the fauced organized by
			<a href="https://www.businessinsider.com/barack-obama-twitter-account-hacked-in-cryptocurrency-scam-2020-7"
			target="_blank">Barack Obama</a> to help fight COVID19. 
	</p>

	<a id="read_more" onclick="switchReadMore()">Read more</a>

	<p id="first_p" hidden  class="flow-text">
		TLDR: many scammers have started 
		<a href="https://www.fbi.gov/scams-and-safety/common-scams-and-crimes/advance-fee-schemes"
			target="_blank">advance-fee schemes</a> using cryptocurrencies, mainly bitcoins.
		I believe in order to prevent people from falling for such baits it is necessary to 
		maintain a global database containing crypto addresses which have been identified as fraudulent.
		Each crypto wallet should query this database before executing a SEND order
		and warn the user about the potential danger in case a fraudulent address is the receipt.

			<br>
			<br>

		I do not seek to disclose the privacy of any cryptocurrency user, and you can
		check that in the source code of the project. 
		No IP address/cookie/user-agent data paired with the searched address is logged when
		querying this database.
		Below you have a search field to query the database for potential fraudulent addresses.
	</p>

@endsection

@section('script')
//<script type="text/javascript">

	var readMore = false

	var _ = function(e){
		return document.getElementById(e)
	}

	var switchReadMore = function(){
		if(!readMore){
			_('first_p').removeAttribute('hidden')
			_('read_more').setAttribute('hidden', '')
		}
		else{
			_('first_p').setAttribute('hidden', '')
			_('read_more').removeAttribute('hidden')
		}

		readMore = !readMore
	}

//</script>
@endsection