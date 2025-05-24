@extends('dashboard')

@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Update User</h3>
                    <div class="card-body">
                        <form action="{{ route('user.postUpdateUser') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="id" type="hidden" value="{{$user->id}}">
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                    value="{{ $user->name }}" required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email_address" class="form-control"
                                    value="{{ $user->email }}" name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Github" id="github" class="form-control"
                                    value="{{ $user->github }}" name="github" required autofocus>
                                @if ($errors->has('github'))
                                <span class="text-danger">{{ $errors->first('github') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Ale" id="ale" class="form-control"
                                    value="{{ $user->ale }}" name="ale" required autofocus>
                                @if ($errors->has('ale'))
                                <span class="text-danger">{{ $errors->first('ale') }}</span>
                                @endif
                                <div class="form-group mb-3">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" id="avatar" class="form-control" name="avatar">
                                    @if ($errors->has('avatar'))
                                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                    @endif
                                    @if ($user->avatar)
                                    <div class="mt-2">
                                        <img src="{{ asset('img/' . $user->avatar) }}" alt="Avatar" width="100">
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Update</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection