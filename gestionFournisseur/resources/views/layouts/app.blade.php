<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{asset('css/gestion.css')}}">
  <title>@yield('title')</title>
</head>
<body>
  
  @if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach
    </div>
  @endif
  @if(session('message'))
    <div class="alert alert-success">
        <p>{{ session('message') }}</p>
    </div>
  @endif
    @yield('contenu')
  <footer>
    <p>&copy 2024-2025 Gestion, Inc.</p>
    <p>Simon Beaulieu &copy 2024</p>
    <p>Mathys Lessard &copy 2024</p>
    <p>Xavier Ricard &copy 2024</p>
  </footer> 
</body>
</html>