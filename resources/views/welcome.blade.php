<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  
 

  <!-- Fonts -->
  <link rel='shortcut icon' href="{{URL::to('/')}}/favicon.ico" type='image/x-icon' /> 
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Acme|Anton|Bree+Serif|Cinzel|Courgette|Creepster|Dancing+Script|Dynalight|EB+Garamond|Engagement|Girassol|Great+Vibes|Indie+Flower|Noto+Sans+JP|Pacifico|Permanent+Marker|Righteous|Sail|Satisfy&display=swap" rel="stylesheet">           

 
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <link href="{{asset('/dist/css/adminlte.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="{{asset('/dist/js/adminlte.min.js')}}"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>
<body>
<div id="app">
  <index></index>
</div>
 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>
 <script>
   
</script>
</body>
</html>