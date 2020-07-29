@extends('global')

@section('title') Crypto Scam - Latest reported addresses @endsection
@section('head')
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

	table tbody {
		transition: 0.1s;
		cursor: pointer;
	}

	table tbody:hover {
		background-color: #f2f1f1;
	}

	table thead th:nth-child(1) {
		width: 50px;
	}

	table thead th:nth-child(2) {
		width: 150px;
	}

	table thead th:nth-child(3) {
		width: 100px;
	}

	td a i.material-icons {
		font-size: 28px;
		color: black !important;
	}

	td a i.material-icons:hover {
		color: grey !important;
	}

	td code {
		font-size: 20px;
		background-color: white;
	}

	td span {
		position: relative;
		top: 0.45rem;
		left: 0.4rem;
	}
</style>
@endsection

@section('main')
	<h3 class="hide-on-small-only" main-header>Latest reports:</h3>
	<h4 class="hide-on-med-and-up" main-header>Latest reports:</h4>

	<table>
		<thead>
			<th>#</th>
			<th>Reported</th>
			<th>Status</th>
			<th>Address</th>
		</thead>
		<tbody>
			@foreach($DATA as $Address)
			<tr>
				<td>{{ $Address->id }}</td>
				<td>{{ $Address->created_at->diffForHumans() }}</td>
				<th><b class="red-text"><code>SCAM</code></b></th>
				<td>
					<code>{{ $Address->address }}</code>
					<span>
    					<a onclick="
    						M.toast({html: copyToClipboard('{{ $Address->address }}') ? 
								'Address copied!' : 'Error occurred.'
							})"
							class="tooltipped"
							data-tooltip="Copy address to clipboard"
							data-position="top">
							<i class="material-icons">content_copy</i>
						</a>	
						<a href="{{ route('site-search-address', $Address->address) }}"
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
@section('script')



@endsection