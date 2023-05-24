@extends('layouts.master')

@section('content')
<main>
    <div class="container col-xl-11 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-md-7 mx-auto col-lg-5">
                <div class="card">
                    <div class="card-header display-5 fw-bold text-center">
                        Login
                    </div>
                    <div class="card-body">
                        <form class="p-3" class="row g-3 m-1" role="form" action="{{ route('login.action') }}" method="POST">
                            {!! csrf_field() !!}
                            @if(Session::has('login_failed'))
                              <div class="mb-2">
                                <small class="text-danger">{!! Session::get('login_failed') !!}</small>
                              </div>
                            @endif
                            <div class="form-floating mb-3">
                              <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                              <label for="email">Email</label>
                              <!--Notif error-->
                              @error('email')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-floating mb-3">
                              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                              <label for="password">Password</label>
                              <!--Notif error-->
                              @error('password')
                                <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                      
                            <button class="w-100 btn btn-md btn-primary" type="submit">Login</button>
                        </form>
                        
                    </div>
                </div>
                <p class="mt-5 mb-3 text-muted text-center"><a href="/">Home</a> &copy; 2023</p>
            </div>
            
        </div>
        
    </div>
</main>
@endsection