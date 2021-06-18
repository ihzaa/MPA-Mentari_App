@extends('FrontEnd.templates.all')

@section('page_title', 'Login')

@section('cssAfter')
@endsection

@section('content')
<div class="h-100">
    <!-- <header>
      <Nav />
    </header> -->
    <div class="container mx-auto my-4 py-2 h-100">
        <div class="row d-flex justify-content-center align-items-center align-middle h-100 px-4">
            <div class="col-md-6 border p-4 shadow rounded">
                <h1 class="text-center">Login form</h1>
                <hr />
                <form method="POST" action="{{ route('user.login.post') }}" class="w-100">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter your email" {{-- autocomplete="email"
                                v-model="email"
                                v-bind:class="{ 'is-invalid': errors.email }" --}} />
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control"
                            {{-- v-bind:class="{ 'is-invalid': errors.password }" --}} id="exampleInputPassword1"
                            placeholder="Password" {{-- autocomplete="password"
                                v-model="password" --}} />
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- remember me  --}}

                    <div class="rememberme">
                        <label for="checkbox"><input type="checkbox" name="remember">
                            remember me</label>
                    </div>

                    <div class="col-md-12 d-flex justify-content-between">
                        <p class="mb-0 mr-2">
                            <a href="{{route('user.register.get')}}">Belum punya akun?</a>
                            {{-- <router-link :to="{ name: 'register' }"> --}}
                            Daftar Sekarang
                            {{-- </router-link> --}}
                        </p>
                        Lupa password?
                        {{-- <router-link --}}
                        {{-- :to="{ name: 'reset-password' }" --}}
                        {{-- > --}}
                        Reset password
                        {{-- </router-link> --}}
                        </p>
                    </div>
                    <div class="col-md-3 text-right">
                        <button type="submit" class="btn btn-outline-info ml-auto">
                            Login
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('jsAfter')

@endsection
