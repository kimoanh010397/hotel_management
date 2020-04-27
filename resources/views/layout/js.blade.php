<script src="{{asset("assets/plugins/bootstrap/js/jquery.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/bootstrap/js/lightbox-plus-jquery.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/bootstrap/js/instafeed.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/bootstrap/js/custom.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/summernote/summernote.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/summernote/summernote.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/summernote/summernote.min.css")}}" type="text/javascript"></script>

<script !src="">
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@stack('js')

