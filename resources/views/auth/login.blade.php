<x-layouts.auth title="Login">
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Masuk Ke Aplikasi</h2>
            <form action="{{ route('login') }}" method="POST" autocomplete="off">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Alamat Surel (email)</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                        placeholder="contoh@email.com" required autofocus>
                </div>

                <div class="mb-2">
                    <label class="form-label">
                        <span>Kata Sandi</span>

                        <span>
                            @if (Route::has('password.request'))
                                <span class="form-label-description">
                                    <a class="text-red" href="{{ route('password.request') }}">
                                        Lupa kata sandi?
                                    </a>
                                </span>
                            @endif
                        </span>
                    </label>

                    <div class="input-group input-group-flat">
                        <input class="form-control" name="password" type="password" placeholder="******"
                            autocomplete="current-password" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" />
                        <span class="form-check-label">Ingat akun saya</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-red w-100">Masuk</button>
                </div>
                <div class="hr-text">or</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col"><a href="{{ route('login-google') }}" class="btn w-100">
                                Masuk Dengan Google
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.auth>
