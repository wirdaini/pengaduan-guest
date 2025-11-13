@extends('layouts.guest.app')

@section('title', 'Tambah User')

@section('content')
<main class="main">
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Tambah User Baru</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('user.index') }}">Users</a></li>
                    <li class="current">Tambah User</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="section">
        <div class="container">
            <!-- Include Partial View -->
            @include('partials.form-header')

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.store') }}" method="POST">
                                @csrf

                                <!-- Include Partial User Form -->
                                @include('partials.user-form')

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Simpan User</button>
                                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
