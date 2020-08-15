@extends('global')

@section('title') Crypto Scam - An open source online database of cryptocurrency addresses used by scammers @endsection
@section('head')
<meta name="description" content="Search or report fraudulent cryptocurrency addresses. Supports BTC, ETH, XRP, and many others.">
<style type="text/css">
	table {
		border-spacing: collapse;
	}

	table tr td {
		border: 1px solid #e0e0e0;
	}

	table tr th {
		border: 1px solid #e0e0e0;
	}

	table.hide-on-small-only tbody tr {
		transition: 0.1s;
		cursor: pointer;
	}

	table.hide-on-small-only tbody tr:hover {
		background-color: #f2f1f1;
	}

	table.hide-on-small-only thead th:nth-child(1) {
		width: 50px;
	}

	table.hide-on-small-only thead th:nth-child(2) {
		width: 150px;
	}

	table.hide-on-small-only thead th:nth-child(3) {
		width: 100px;
	}

	table.hide-on-small-only td a i.material-icons {
		font-size: 28px;
		color: black !important;
	}

	table.hide-on-small-only td a i.material-icons:hover {
		color: grey !important;
	}

	table.hide-on-small-only td code {
		font-size: 20px;
		background-color: white;
	}

	table.hide-on-small-only td span {
		position: relative;
		top: 0.45rem;
		left: 0.4rem;
	}

	table.hide-on-med-and-up {
		table-layout: fixed;
		width: 100%;
	}

	table.hide-on-med-and-up thead th:nth-child(1) {
		width: 75px;
	}

	table.hide-on-med-and-up thead th:nth-child(2) {
		width: 70px;
	}

	table.hide-on-med-and-up tbody tr:hover {
		background-color: #f2f1f1;
	}

	table.hide-on-med-and-up td a i.material-icons {
		color: black !important;
		cursor: pointer;
	}
</style>
@endsection
@section('main')


	<h3 class="hide-on-small-only" main-header>Search for an address:</h3>
	<h5 class="hide-on-med-and-up" main-header>Search for an address:</h5>

	@include('comps.search')


	<h3 class="hide-on-small-only" main-header>Latest reports:</h3>
	<h4 class="hide-on-med-and-up" main-header>Latest reports:</h4>

	<table class="hide-on-small-only">
		<thead>
			<th>#</th>
			<th>Reported</th>
			<th>Status</th>
			<th>Address</th>
		</thead>
		<tbody>
			@foreach($DATA as $Report)
			<tr>
				<td>{{ $Report->id }}</td>
				<td>{{ $Report->created_at->diffForHumans() }}</td>
				<th><b class="red-text"><code>SCAM</code></b></th>
				<td>
					<code>{{ $Report->getAddresses->first()->address }}</code>
					<span>
    					<a onclick="
    						M.toast({html: copyToClipboard('{{ $Report->getAddresses->first()->address }}') ?
								'Address copied!' : 'Error occurred.'
							})"
							class="tooltipped"
							data-tooltip="Copy address to clipboard"
							data-position="top">
							<i class="material-icons">content_copy</i>
						</a>
						<a href="{{ route('site-search-address', $Report->getAddresses->first()->address) }}"
							class="tooltipped"
							data-tooltip="View detalied reports">
							<i class="material-icons">info</i>
						</a>
					</span>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<table class="hide-on-med-and-up">
		<thead>
			<th>Reported</th>
			<th>Status</th>
			<th>Address</th>
		</thead>
		<tbody>
			@foreach($DATA as $Report) 
			<tr>
				<td>{{ $Report->created_at->diffForHumans(['parts'=>1], null, true) }}</td>
				<th><b class="red-text"><code>SCAM</code></b></th>
				<td>
					<span class="truncate"><code>{{ $Report->getAddresses->first()->address }}</code></span>
					<span>
    					<a onclick="
    						M.toast({html: copyToClipboard('{{ $Report->getAddresses->first()->address }}') ?
								'Address copied!' : 'Error occurred.'
							})"
							class="tooltipped"
							data-tooltip="Copy address to clipboard"
							data-position="top">
							<i class="material-icons">content_copy</i>
						</a>
						<a href="{{ route('site-search-address', $Report->getAddresses->first()->address) }}"
							class="tooltipped"
							data-tooltip="View detalied reports">
							<i class="material-icons">info</i>
						</a>
					</span>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection


