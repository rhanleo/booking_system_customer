@if ($uninstalled = Session::get('uninstalled'))
       <div class="alert alert-danger alert-dismissable " id='error'>
       <a type="button" class="close" data-dismiss="alert" aria-hidden="true"></a>
           
                <h3 ><strong><i class="fa fa-close"></i></strong> {{ $uninstalled }}</h3>
           
        </div>
 @endif
 <script type='text/javascript'>
 $('document').ready(function(){

     var unable = "{{$uninstalled }}";
     if(unable){
         $('.uform').hide();
         $('#banner-left').hide();
         $('#banner').hide();
         $('#footer').hide();
         $('body').css('background', '#e6e7e8')
         $('#unable').css('background', 'none').addClass('col-md-12').removeClass('col-md-4 col-sm-5 col-sm-push-7 col-md-push-8');
     }
     
    $('.close').click(function(){
        $('#error').hide();
    });
 });    
 </script>