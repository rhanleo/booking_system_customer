@if (count($errors) > 0 )
       <div class="alert alert-danger alert-dismissable id="errors"">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            @foreach ($errors->all() as $error)
                <p><strong><i class="fa fa-close"></i></strong> {{ $error }}</p>
            @endforeach
        </div>
 @endif
 <script type='text/javascript'>
 $('document').ready(function(){
     
    $('.close').click(function(){
        $('#errors').hide();
    });
 });    
 </script>