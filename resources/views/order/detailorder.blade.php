@extends('templates.master')
@section('title', 'Order List')

@section('main')
<div id="main">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <section id="horizontal-input">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-3">
                                                    <label class="col-form-label">Nomor Transaksi</label>
                                                </div>
                                                <div class="col-lg-10 col-9">
                                                    <input value="{{$order->invoice}}" type="text" id="disableInput" class="form-control" name="fname" placeholder="First Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-3">
                                                    <label class="col-form-label">Nama Pemesan</label>
                                                </div>
                                                <div class="col-lg-10 col-9">
                                                    <input value="{{$order->customer_name}}" type="text" id="disableInput" class="form-control" name="fname" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-3">
                                                    <label class="col-form-label">Nomor Meja</label>
                                                </div>
                                                <div class="col-lg-10 col-9">
                                                    <input value="{{$order->table->number}}" type="text" id="disableInput" class="form-control" name="fname" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="row" id="table-inverse">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>Item</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Keterangan</th>
                                                    <th>Jumlah Beli</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->detailorder as $item)
                                                <tr>
                                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                                    <td>{{$item->product->name}}</td>
                                                    <td class="text-bold-500">{{$item->product->price}}</td>
                                                    <td>{{$item->product->description}}</td>
                                                    <td>{{$item->quantity}}</td>
                                                    <td> {{$item->product->price * $item->quantity}}</td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 865px;"> <h6>Grand Total</h6> </td>
                                                    <td class="text-end ">{{$order->total}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection