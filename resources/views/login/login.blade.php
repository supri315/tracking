@extends('login.layout')

@section('content')
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">
            <div class="text-center">
        <img src="{{url('/assets/img/logobulat.png')}}"  width="90"/>
        </div>
              <h4 class="mb-2 d-flex justify-content-center">SILAHKAN LOGIN</h4>
              <form class="mb-3" action="{{route('cekLogin')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="mb-3 text-center">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                  <br>
                  <br>
                 
                  <a href="{{route('cekongkir')}}" class="btn btn-secondary text-center" type="submit">Enter As Public</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection
