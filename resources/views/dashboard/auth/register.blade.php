
<head>
    @include('dashboard.layouts.head')
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900">Create an Admin Account</h1>
                                </div>
        
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
        
                                <form class="user" method="POST" action="{{ route('dashboard.register') }}">
                                    @csrf
        
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control form-control-user" placeholder="Full Name" value="{{ old('name') }}" required>
                                    </div>
        
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Email Address" value="{{ old('email') }}" required>
                                    </div>
        
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control form-control-user" placeholder="Phone (optional)" value="{{ old('phone') }}">
                                    </div>
        
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" name="password_confirmation" class="form-control form-control-user" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
        
                                    {{-- is_admin input: hidden because we want this register page to register admins only --}}
                                    <input type="hidden" name="is_admin" value="1">
        
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </button>
        
                                    <hr>
        
                                </form>
        
                                <hr>
                                {{-- <div class="text-center">
                                    <a class="small" href="{{ route('dashboard.login') }}">Already have an account? Login!</a>
                                </div> --}}
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>

