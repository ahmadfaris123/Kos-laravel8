@extends('layouts.main')

@section('container')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Pembayaran Lunas</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pembayaran Lunas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            @if(count($tagihan) > 0)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tagihan Lunas</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                @php($i = 1)
                                @foreach($tagihan as $item)
                                <tbody>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->tagihan}}.000</td>
                                        <td>{{tgl_indo($item->tgl_bayar, 'd M  Y');}}</td>
                                        <td>
                                            @if($item->status == 0)
                                            <span class="badge badge-pill badge-danger">Belum Bayar</span>
                                            @else
                                            <span class="badge badge-pill badge-success">Lunas</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <h2 class="font-weight-light mb-0">Data tidak tersedia, silahkan tambahkan data</h2>
            @endif
            <!-- Column -->
        </div>
        <!-- Row -->
    </div>
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer">
        © 2020 Monster Admin by wrappixel.com
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
@endsection