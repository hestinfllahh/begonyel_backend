@extends('templates.master')
@section('title', 'Order List')

@section('main')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Cart List</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/master-data/cart/create') }}" class="btn btn-primary rounded-pill"> Add Cart</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>product_id</th>
                                <th>description</th>
                                <th>quantity</th>
                                <th>table_id</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $cartz)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cartz->product->name }}</td>
                                <td>{{ $cartz->description}}</td>
                                <td>{{ $cartz->quantity }}</td>
                                <td>{{ $cartz->table_id->number}}</td>
                                <td>
                                    <a href="{{ url ('/master-data/cart/'.$cartz->id. '/edit') }}" class="btn btn-warning rounded-pill">edit</a>
                                    <form action="{{ url ('/master-data/cart/'.$cartz->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger rounded_pill" onclick="return confirm('Yakin ?')">delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                    </table>
                </div>
            </div>

        </section>
    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2021 &copy; Mazer</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
            </div>
        </div>
    </footer>
</div>

@endsection