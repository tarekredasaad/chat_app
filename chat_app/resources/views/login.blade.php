<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Login Form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <style>
            .form{
                width:300px;
                margin:100px auto;
            }
        </style>
        @livewireStyles
    </head>
<body style="font-family: tohoma; background-color:#d0d8e4;">
<div  id="blue_bar">
        <div style="width: 800px; ">
            MyBook &nbsp &nbsp
           
        </div>
    </div>
    <div class="container">
    @if( session()->has('msg'))
                <div class="alert alert-danger">
                    {{session('msg')}}
                </div>@endif
        <form class="form" action="{{url('check_login')}}" method="post" wire:submit.prevent="saveContact">
            @csrf
            <div class="form-group">
                <label for="" class="text-info">Email</label>
                <input type="email" name="email" wire:model="email" class="form-control" require>
                @error('email') <span class="alert alert-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" wire:model="password" class="form-control" require>
                @error('password') <span class="alert alert-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success btn-block" >
            </div>
        </form>
            <a href="{{url('signup')}}">Sign Up</a>
        <style>
    #blue_bar{
            background-color:#405d9b;
            height:50px;
        }
</style>



    </div>
    @livewireScripts
</body>