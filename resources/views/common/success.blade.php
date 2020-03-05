@if ($success = Session::get('success'))
       <div class="alert alert-success alert-dismissable " id='success'>
       <a type="button" class="close" data-dismiss="alert" aria-hidden="true"></a>
           
                <p><strong><i class="fa fa-check"></i></strong> {{ $success }}</p>
           
        </div>
 @endif
 <script type='text/javascript'>
 $('document').ready(function(){
     
    $('.close').click(function(){
        $('#error').hide();
    });
 });    
 </script>