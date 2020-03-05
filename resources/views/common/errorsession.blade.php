
@if ($error = Session::get('error'))
    
       <div class="alert alert-danger alert-dismissable " id='error'>
       <a type="button" class="close" data-dismiss="alert" aria-hidden="true"></a>
           
                <p><strong><i class="fa fa-close"></i></strong> {{ $error }}</p>
           
        </div>
 @endif
 <script type='text/javascript'>
 $('document').ready(function(){
     
    $('.close').click(function(){
        $('#error').hide();
    });
 });    
 </script>