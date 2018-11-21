@section('script')
<script type="text/javascript">
  
var simplemde1 = new SimpleMDE({ element: document.getElementById("excerpt") });
var simplemde2 = new SimpleMDE({ element: document.getElementById("body") });

$('#datetimepicker1').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss',
    showClear: true
});

$('#draft-btn').click(function(e){
    e.preventDefault();
    $('#published_at').val("");
    $('#post-form').submit();
    
});

</script>
@endsection