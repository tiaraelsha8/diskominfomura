@extends('backend.layout.master')

@section('judul')
    Halaman Edit Profile
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit data user</h3>
                    </div>
                    <!-- /.card-header -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <!-- form start -->
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                            </div>
                            @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" name="current_password" class="form-control" required
                                    placeholder="isikan password lama saat mengubah email,username,nama">
                            </div>
                            @error('current_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Kosongkan jika tidak ingin mengubah">
                            </div>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Konfirmasi Password </label>
                                <input type="password" class="form-control" placeholder="isikan jika mengubah password" name="password_confirmation">
                            </div>
                            @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('backend.dashboard') }}" class="btn btn-default">Batal</a>
                        </div>

                        @if (session('secondsRemaining'))
                            <div class="alert alert-warning">
                                Anda telah mencoba terlalu banyak. Tunggu <span id="countdown"
                                    style="font-weight: bold"></span>
                            </div>
                        @endif
                    </form>
                </div>
                <!-- /.card -->
                <!--/.col (right) -->
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection

@push('scripts')
    <script>
        let seconds = {{ session('secondsRemaining') }};

        function formatClock(secs) {
            const m = Math.floor(secs / 60);
            const s = secs % 60;
            return `${m < 10 ? '0' : ''}${m}:${s < 10 ? '0' : ''}${s}`;
        }

        function updateCountdown() {
            const el = document.getElementById('countdown');
            if (seconds <= 0) {
                el.innerText = '00:00';
                return;
            }
            el.innerText = formatClock(seconds);
            seconds--;
            setTimeout(updateCountdown, 1000);
        }

        updateCountdown();
    </script>
@endpush
