<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{asset('bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('bootstrap/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>
    @guest
    @else
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 70px;">
        <div class="container">
            <a class="navbar-brand" href="#">MaaS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('servicios') }}">Servicios <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('usuarios') }}">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('calendario') }}">Calendario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Cerrar Sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endguest
    @if(session()->has('message') && session()->get('message') != 'You are not allowed to access')
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Exito!</strong> {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @php
            session()->forget('message');
        @endphp
    @endif
    @if(session()->has('error') && session()->get('error') != 'You are not allowed to access')
        <div class="container">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @php
            session()->forget('error');
        @endphp
    @endif