@if($address->address_type == 'shipping')
	<div class="chshaddr">
		<p>{{ $address->name }}</p>
		<p>{{ $address->address .', ' .$address->street }}</p>
		<p>{{ $address->city .', '. $address->state}}</p>
		<p>{{ $address->country.' ('.$address->zipcode.')' }}</p>
		<p>{{ 'phone - '.$address->phone }}</p>
	</div>
@elseif($address->address_type == 'billing')
	<div class="chbladdr">
		<p>{{ $address->name }}</p>
		<p>{{ $address->address .', ' .$address->street }}</p>
		<p>{{ $address->city .', '. $address->state}}</p>
		<p>{{ $address->country.' ('.$address->zipcode.')' }}</p>
		<p>{{ 'phone - '.$address->phone }}</p>
	</div>
@endif