@extends('FrontEnd.templates.all')

@section('page_title', 'Daftar')

@section('cssAfter')
    <style>
        .btn:hover {
            color: white;
        }

    </style>
@endsection

@section('content')
    <div class="h-100">
        <div class="container mx-auto my-4 py-2 h-100">
            <div class="row d-flex justify-content-center align-items-center align-middle h-100 px-4">
                <div class="col-md-6 border p-4 shadow rounded">
                    <h1 class="text-center">Register form</h1>
                    <hr />
                    <form method="POST" action="{{ route('user.register.post') }}" class="w-100">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="name"
                                placeholder="Enter your name" name="nama" />
                            <div class="alert alert-danger" role="alert" v-if="errors.name">
                                {{-- {{ errors . name[0] }} --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter your email" name="email" />
                            <div class="alert alert-danger" role="alert" v-if="errors.email">
                                {{-- {{ errors . email[0] }} --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" class="form-control" id="phone" aria-describedby="phone"
                                placeholder="Enter your phone" name="phone" />
                            <div class="alert alert-danger" role="alert" v-if="errors.phone">
                                {{-- {{ errors . phone[0] }} --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                            <div class="alert alert-danger" role="alert" v-if="errors.password">
                                {{-- {{ errors . password[0] }} --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <p class="mb-0 mr-2">
                                    Sudah punya akun?
                                    <router-link :to="{ name: 'login' }">
                                        Login
                                    </router-link>
                                </p>
                            </div>
                            <div class="col-md-3 text-right">
                                <button type="submit" class="btn btn-outline-info ml-auto">
                                    Register
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
