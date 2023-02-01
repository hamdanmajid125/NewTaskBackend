@extends('user.layouts.main')
@section('title', 'Dashboard')
@section('content')
    @php
        $countries = DB::table('countries')->get();
    @endphp
    <div class="sign-in-page">
        <div class="signin-popup">
            <div class="signin-pop">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="cmp-info">
                            <div class="cm-logo">
                                <img src="{{ asset($logo) }}" alt="">
                                <p>Workwise, is a global freelancing platform and social networking where businesses and
                                    independent professionals connect and collaborate remotely</p>
                            </div>
                            <img src="images/cm-main-img.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login-sec">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <ul class="sign-control">
                                <li data-tab="tab-1" class="current"><a href="#" title="">Sign in</a></li>
                                <li data-tab="tab-2"><a href="#" title="">Sign up</a></li>
                            </ul>
                            <div class="sign_in_sec current" id="tab-1">
                                <h3>Sign in</h3>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 no-pdd">
                                            <div class="sn-field">
                                                <input type="email" name="email" placeholder="Email" required>
                                                <i class="la la-user"></i>
                                            </div>
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 no-pdd">
                                            <div class="sn-field">
                                                <input type="password" name="password" placeholder="Password" required>
                                                <i class="la la-lock"></i>
                                            </div>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 no-pdd">
                                            <div class="checky-sec">
                                                <div class="fgt-sec">
                                                    <input type="checkbox" name="cc" id="c1">
                                                    <label for="c1">
                                                        <span></span>
                                                    </label>
                                                    <small>Remember me</small>
                                                </div>
                                                {{-- <a href="#" title="">Forgot Password?</a> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-12 no-pdd">
                                            <button type="submit" value="submit">Sign in</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- <div class="login-resources">
                    <h4>Login Via Social Account</h4>
                    <ul>
                    <li><a href="#" title="" class="fb"><i class="fa fa-facebook"></i>Login Via Facebook</a></li>
                    <li><a href="#" title="" class="tw"><i class="fa fa-twitter"></i>Login Via Twitter</a></li>
                    </ul>
                    </div> -->
                            </div>
                            <div class="sign_in_sec" id="tab-2">
                                <h3>Sign Up</h3>
                                <div class="dff-tab current" id="tab-3">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="text" name="name" placeholder="Full Name" required>
                                                    <i class="la la-user"></i>
                                                </div>

                                                @error('name')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="email" name="email" placeholder="Email" required>
                                                    <i class="la la-user"></i>
                                                </div>
                                                @error('email')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <select type="text" name="country" placeholder="Country" required>
                                                        @foreach ($countries as $item)
                                                            <option {{ $item->name == 'Pakistan' ? 'selected' : '' }}
                                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                        required
                                                    </select>
                                                    <i class="la la-globe"></i>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="password" name="password" placeholder="Password" required>
                                                    <i class="la la-lock"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="password" name="password_confirmation" name="password"
                                                        required placeholder="Repeat Password">
                                                    <i class="la la-lock"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <div class="checky-sec st2">
                                                    <div class="fgt-sec">
                                                        <input type="checkbox" name="cc" id="c2">
                                                        <label for="c2">
                                                            <span></span>
                                                        </label>
                                                        <small>Yes, I understand and agree to the workwise Terms &
                                                            Conditions.</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <button type="submit" value="submit">Get Started</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@push('js')
@endpush
@push('css')
    <style>
        .sign-in-page {
            background: #e44d3a;
        }
    </style>
@endpush
