<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <div class="container-fluid ">
  <div class="col-md-12 ">
    <div class="card">
      <div class="card-header">
      {!! !is_null($apps) ? 'Edit <span class ="apps-title">Mood</span>' : 'New App' !!}
        اضافة تطبيق جديد
      </div>
      <div class="card-body">
      @if(count($errors) > 0 )
          <div class="modal-body">
          <ul class="list-group">
          @foreach($errors->all() as $error )
  <li class="list-group-item">{{$error}}</li>
  @endforeach
  </ul>
  @endif
  </div>
        <form action="{{ (! is_null($apps)) ? route('app-update') : route('app-store') }}"
         method="post" class="row" enctype="multipart/form-data">
          @csrf

          @if(! is_null($apps))
          <input type="hidden" name ="_method" value="put" />
          <input type="hidden" name ="apps_id" value="{{$apps->id}}" />
          @endif

          <h3>التايتل </h3>
            <div class="input-group control-group " >
          <input type="file" name="tite_image" class="form-control" value="{{ ! is_null($apps) ? $apps->title_image  :'' }}" >
 </div> 



          <div class="modal-body">
            <div class="form-group col-md-12">
              <h3 for="game_title">التايتل</h3>
              <input type="text" class="form-control" id="app_title" placeholder=" عنوان الجولة" name="app_title"  
              value= "{{ ! is_null($apps) ? $apps->title  :'' }}">
            </div>

            <div class="form-group col-md-12">
              <h3 for="game_shortcut">ملخص</h3>
              <input type="text" class="form-control" id="app_shortcut" placeholder=" ملخص" name="app_shortcut" 
              value="{{ ! is_null($apps) ? $apps->shortcut  :'' }}">
            </div>



            <div class="form-group col-md-12">
              <h3 for="app_forchildren">يمكن للاطفال تحميلها؟</h3>
              <input type="text" class="form-control" id="app_forchildren" placeholder=" الخطورة" name="game_dengerous" 
              value="{{ ! is_null($apps) ? $apps->forchildren  :'' }}">
            </div>

            <div class="form-group col-md-12">
              <h3 for="app_forchildren">هل تحتاج الى مراقبة الوالدين ؟</h3>

              <input type="radio" name="app_forchildren" 
              value= 1
              
              <?php if(! is_null($apps) && $apps->monitoring== 1 ){ echo "checked=checked";}  ?> 
              
              > yes<br>

              <input type="radio" name="app_forchildren" 
              value= 0
              <?php if(! is_null($apps) && $apps->monitoring== 0 ){ echo "checked=checked";} ?> 
              
              > no<br>







            <div class="form-group col-md-12">
            <h3 for="game_description">وصف التطبيق</h3>
            <div class="form-group col-md-12">
              <textarea require class="form-control" name="app_description" id="app_description" cols="30" rows="10">
              {{! is_null($apps) ? $apps->description  :'' }}
              </textarea>
            </div></div>


            

         
          </div>


          <h3>المرئيات  </h3>
          <div class="clone hide row" style="padding-right:300px">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="vis[]" class="form-control" value="">
          </div>          </div>
    
    
          <input type="radio" name="video_or_image" 
          @if(! is_null($apps))
          @foreach ($visuals as $vis )
value="video" <?php if($vis->video_or_image== 'video' ){ echo "checked=checked";}  ?>  
>  
{{$vis->video_or_image}}<br>

<input type="radio" name="video_or_image" 
value="image" <?php if($vis->video_or_image== 'image' ){ echo "checked=checked";}  ?> 
>

{{$vis->video_or_image}}<br> 

@endforeach
@else

@foreach ($visuals as $vis )
<input type="radio" name="video_or_image" 
value="video" <?php if($vis->video_or_image== 'video' ){ echo "checked=checked";}  ?>  
>  
{{$vis->video_or_image}}<br>

<input type="radio" name="video_or_image" 
value="image" <?php if($vis->video_or_image== 'image' ){ echo "checked=checked";}  ?> 
>
@endforeach


@endif





        <hr class="dashed">


  
        <h3>category</h3>

        @if( is_null($apps))
        @foreach ($categories as $cat )
    <div class="row" style="padding-left:140px ; grid-auto-rows: 130px;">
        <input type="checkbox" name="category_id[]"
         value="{{$cat->name}} " >
          {{$cat->name}}
        @endforeach    
      </div>  
      @else 
              @foreach ($categories as $cat )
    <div class="row" style="padding-left:140px ; grid-auto-rows: 130px;">
        <input type="checkbox" name="category_id[]"
         value="{{$cat->name}} " 
         <?php 
         foreach ($games->category_names as $p) { 
         if($p ==$cat->name ){ echo "checked=checked";} 
         }
         ?> >
          {{$cat->name}}
        @endforeach      
      </div>        </div>        </div>  

      @endif 
        

              <h3>اكثر الدول تحميلات</h3>
              @if( is_null($apps))
              @foreach ($countries as $country )
    <div class="row" style="padding-left:140px ; grid-auto-rows: 130px;">
        <input type="checkbox" name="country_name[]"
         value="{{$country->many}} " >
                  {{$country->name}}
        @endforeach      
      </div>  
      @else
              @foreach ($players as $player )
    <div class="row" style="padding-left:140px ; grid-auto-rows: 130px;">
        <input type="checkbox" name="country_name[]"
         value="{{$country->name}} " 
         <?php 
          foreach ($apps->country as $con) { 
         if($con ==$country->name ){ echo "checked=checked";} } ?> >
         {{$country->name}}
        @endforeach       
      </div>        </div>  
      
      @endif
        
      <hr class="Dotted">


  
    

              <div class="form-group col-md-12">
              <button type="submit" class="btn btn-danger btn-sm">انشر الجولة</button>
              </div>

      </form>

    </div>    </div>
    </div>
</div>







<script>

function checkedBox(){
  var type = document.getElementsByName("game_coordinator")
    if (type[0].chicked){
      var val = type[0].value;
    }
    else if(type[1].chicked){
      var val = type[1].value;
    }
  

}
</script>

<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
</script>



        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
     
    </body>
</html>
