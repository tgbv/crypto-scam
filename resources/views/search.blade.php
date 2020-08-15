@extends('global')

@section('title') 
	Crypto Scam - @if(isset($DATA) && $DATA) Address [{{ $DATA->address }}] information @else Search for potential fraudulent crypto addresses @endif

@endsection
@section('head')
<meta name="description" content="Search for potential fraudulent cryptocurrency addresses. Supports BTC, ETH, XRP, and many others.">
<style type="text/css">

	p {
		font-size: 20px;
	}

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
		transition: 0.1s
	}

	table tbody:hover {
		background-color: #f2f1f1;
	}

	td[baseline] {
		vertical-align: baseline;
	}

	table[reports] tbody:hover {
		background-color: #ececec;
	}

	table[reports] tbody tr td {
		vertical-align: top;
	}

	table[reports] {
		margin: -1px;
	}

	td ol {
		margin-top: 0;
		margin-left: -1rem;
	}

	ol li a {
		cursor: pointer;
	}

	span[span-within-li] {
		position: relative;
		top: 6px;
		left: 5px;
		cursor: pointer;
	}

	span[span-within-li] i:hover {
		color: grey;
	}

	span[span-within-li] i {
		color: black;
	}

	img {
		max-width: 100%;
		height: auto;
	}

	div.hide-on-med-and-up table {
		margin-bottom: 0.5rem;
		/*table-layout: fixed;*/
		width: 100%;
	}

	div.hide-on-med-and-up td[linebreak] {
		line-break: anywhere;
	}

	div.hide-on-med-and-up td ol {
		margin-left: -1.6rem;
		margin-top: 0;
	}

	div.hide-on-med-and-up tr td {
		padding: 9px 5px;
	}
</style>
@endsection
@section('main')
	<h3 class="hide-on-small-only" main-header>Search for an address:</h3>
	<h5 class="hide-on-med-and-up" main-header>Search for an address:</h5>
	@include('comps.search')

	@if(isset($DATA))
		<h3 class="hide-on-small-only" main-header>Query data:</h3>
		<h4 class="hide-on-med-and-up" main-header>Query data:</h4>

		<table main class=" hide-on-small-only">
			<tbody>
				<tr>
					<td>Address</td>
					<td><code>{{ request()->post('address') ?? request()->route('address') }}</code></td>
				</tr>
			</tbody>
			@if($DATA)
				<tbody>
					<tr>
						<td baseline>Status</td>
						<td>
							<b class="red-text">SCAM</b>
							<span class="red-text"><i>(view below reports)</i></span>
						</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td baseline>Reports</td>
						<td style="padding: 0">
							<table reports>
								<thead>
									<tr>
										<th>#</th>
										<th>Date</th>
										<th>Description</th>
										<th>Attachments (proofs)</th>
									</tr>
								</thead>
								@foreach($DATA->getReports as $key=> $Report)
								<tbody>
									<tr>
										<td>{{ $key+1 }}</td>
										<td>
											{{ $Report->created_at->diffForHumans() }}
											<br>
											<i>({{ $Report->created_at }})</i>
										</td>
										<td><code>{{ $Report->description ?? 'N/A'}}</code></td>
										<td>
											@if($Report->attachments)
											<ol>
												@foreach($Report->attachments as $att)
												<li>
													<a>{{ $att }}</a>
													<span span-within-li>
														<i class="material-icons tooltipped"
															data-tooltip="View proof"
															onclick="openProof('{{$att}}')">panorama</i>
														<a href="{{ route('proof-download', [$att]) }}"
															target="_blank">
															<i class="material-icons tooltipped"
																data-position="top"
																data-tooltip="Download proof">file_download</i>										
														</a>
													</span>
												</li>
												@endforeach
											</ol>
											@else
											<code>N/A</code>
											@endif
										</td>
									</tr>									
								</tbody>

								@endforeach
							</table>
						</td>
					</tr>
				</tbody>
			@else
				<tbody>
					<tr>
						<td baseline>Status</td>
						<td><b class="brown-text">Unknown</b>
							<div class="brown-text">Address has not been reported. 
								This however does not mean it isn't fraudulent.
								Please consult a group with experienced people, such as 
								<a href="https://reddit.com/r/scams" target="_blank">r/scams</a>.
							</div>
						</td>
					</tr>
				</tbody>

			@endif
		</table>

		<div class="hide-on-med-and-up">
			<table>
				<tr>
					<th>Address</th>
				</tr>
				<tr>
					<td><code>{{ request()->post('address') ?? request()->route('address') }}</code></td>
				</tr>
			</table>

			@if($DATA)
				<table>
					<tr>
						<th>Status</th>
					</tr>
					<tr>
						<td>
							<b class="red-text">SCAM</b>
							<span class="red-text"><i>(view below reports)</i></span>
						</td>
					</tr>
				</table>

				<table>
					<tr>
						<th colspan="3">Reports</th>
					</tr>
					<tr>
						<th style="width: 65px !important"><i>Time</i></th>
						<th style="width: 150px "><i>Description</i></th>
						<th><i>Proofs</i></th>
					</tr>

					@foreach($DATA->getReports as $key=> $Report)
					<tr>
						<td baseline>
							{{ $Report->created_at->diffForHumans(null, null, true) }}
						</td>
						<td baseline linebreak><code>{{ $Report->description ?? 'N/A'}}</code></td>
						<td baseline>
							@if($Report->attachments)
							<ol>
								@foreach($Report->attachments as $att)
								<li>
									<span span-within-li>
										<i class="material-icons tooltipped"
											data-tooltip="View proof"
											onclick="openProof('{{$att}}')">panorama</i>
										<a href="{{ route('proof-download', [$att]) }}"
											target="_blank"
											rel="nofollow">
											<i class="material-icons tooltipped"
												data-position="top"
												data-tooltip="Download proof">file_download</i>										
										</a>
									</span>
								</li>
								@endforeach
							</ol>
							@else
							<code>N/A</code>
							@endif
						</td>

					</tr>
					@endforeach
				</table>
			
			@else
				<table>
					<tr>
						<th>Status</th>
					</tr>
					<tr>
						<td>
							<b class="brown-text">Unknown.</b>
							<span class="brown-text">Address has not been reported. 
								This however does not mean it isn't fraudulent.
								Please consult a group with experienced people, such as 
								<a href="https://reddit.com/r/scams" target="_blank">r/scams</a>.
							</span>						
						</td>
					</tr>
				</table>
			@endif

		</div>
	@endif

  <div id="view-proof" class="modal modal-fixed-footer">
    <div class="modal-content">
    	<img class="materialboxed"  src="" loading="lazy" id="view-proof-src">
    </div>
    <div class="modal-footer">
      <a class="modal-close waves-effect waves-green btn-flat">Exit</a>
    </div>
  </div>

@endsection

@section('script')
	var openProof = function(src) {
		_('view-proof-src').setAttribute('src', '{{ route('proof-download', ['']) }}/'+src)
		M.Modal.getInstance(_('view-proof')).open()
		M.Modal.getInstance(_('view-proof')).options.onCloseEnd = ()=>{
			_('view-proof-src').setAttribute('src', '')
		}
	}
@endsection