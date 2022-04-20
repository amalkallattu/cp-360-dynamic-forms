<!DOCTYPE html>
<html lang="en">

<head>
  <title>Interview - CP 360</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">CP 360</a>
      </div>
      <ul class="nav navbar-nav">

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Forms
            <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('forms') }}">All Forms</a></li>
            <li><a href="{{ route('forms.create') }}">Create New Form</a></li>
          </ul>
        </li>

      </ul>

      <ul class="nav navbar-nav">

        <li><a href="{{ route('public.forms') }}">Public Forms Listing</a></li>

      </ul>

      <ul class="nav navbar-nav navbar-right">


      </ul>
    </div>
  </nav>
  <div class="jumbotron text-center">
    <h3>Interview - Amal</h3>
  </div>


  @yield('content')

</body>

</html>