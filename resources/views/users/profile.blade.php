@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    {{-- Profile Section --}}
    <main class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 mx-auto my-4">
            <div class="col-12">
                <form method="POST" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12 text-center mb-4">
                        <img src="{{ asset('images/users/'.$user->image) }}" width="200" alt="profile Picture">
                    </div>
                    <div class="col-12 text-center mb-4">
                        <input type="file" name="image" >
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div>
                                <label for="first_name" class="form-label">Name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $user->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" name="email" id="email" class="form-control"
                            value="{{ $user->email }}">
                    </div>

                    <div class="mb-4 accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Change Password
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password:</label>
                                        <input type="password" name="current_password" id="current_password"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password:</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button name="update" id="update" type="submit" class="btn btn-outline-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
{{-- Profile Section --}}
