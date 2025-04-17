@extends('dashboard')

@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Github</th>
                        <th>Ale</th>
                        <th>Avatar</th>
                        <!-- <th>productname</th> -->
                        <th>Action</th>
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <th>{{ $user->name }}</th>
                        <th>{{ $user->email }}</th>
                        <th>{{ $user->github }}</th>
                        <th>{{ $user->ale }}</th>
                        <td>
                            @if ($user->avatar)
                                <img src="{{ asset('img/' . $user->avatar) }}" alt="Avatar" width="50" class="rounded-circle">
                            @else
                                <img src="{{ asset('storage/images/default.jpg') }}" alt="Default Avatar" width="50" class="rounded-circle">
                            @endif
                        </td>
                        


                            <th>
                                <a href="{{ route('user.readUser', ['id' => $user->id]) }}">View</a> |
                                <a href="{{ route('user.updateUser', ['id' => $user->id]) }}">Edit</a> |
                                <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}">Delete</a>
                            </th>
                            
                    </tr>
                    @endforeach
                    
                    
                </tbody>
                
            </table>
        </div>
    </div>
</main>
@endsection