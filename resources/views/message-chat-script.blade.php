@section('javascript')

<style type="text/css">
	.chat_img.online::after {
	    background: #0ee60e;
	}
</style>
<script type="text/javascript">
@php 
	$a = request()->input('a');
	$chat_id = request()->input('chat_id');
	if($chat_id){}else{$chat_id=0;}
	$_pic = request()->input('pic');
	if($_pic){}else{$_pic='';}
	$first_name = request()->input('first_name');
	$last_name = request()->input('last_name');
	$name = strval($first_name.' '.$last_name);
	if($name){}else{$name='';}
	$received_by = request()->input('received_by');
	if($received_by){}else{$received_by=0;}
@endphp
var chat_id = {{$chat_id}};
if(chat_id!=0){
	var _pic = "{{$_pic}}";
	var name = "{{$name}}";
	var received_by = {{ $received_by }};
	var onlyMessageChatPage = 1;
	// getMessage(name, received_by);
}	

</script>

<link rel="stylesheet" href="{{ asset('assets/css/emojionearea.min.css') }}">
<script src="{{ asset('assets/js/emojionearea.min.js') }}" type="text/javascript"></script>




@stop


<!--SideBar-End---->