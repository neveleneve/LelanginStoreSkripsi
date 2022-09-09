@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2 class="fw-bold text-center">
                            Item
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" placeholder="Pencarian...">
                            </div>
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-sm btn-outline-success btn-block">
                                    Tambah Item
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered text-nowrap">
                                        <thead class="table-success">
                                            <tr class="text-center">
                                                <th></th>
                                                <th class="fw-bold">ID</th>
                                                <th class="fw-bold">Nama</th>
                                                <th class="fw-bold">Harga Buka</th>
                                                <th class="fw-bold">Tanggal Mulai</th>
                                                <th class="fw-bold">Tanggal Berakhir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($item as $item)
                                                <tr class="text-center">
                                                    <td></td>
                                                    <td>
                                                        <a
                                                            href="{{ route('viewitem', ['id' => $item->id_item, 'name' => strtolower(str_replace(' ', '_', $item->name))]) }}">
                                                            {{ $item->id_item }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>Rp. {{ number_format($item->start_price, 0, ',', '.') }}</td>
                                                    <td>
                                                        {{ App\Http\Controllers\Controller::tanggalIndo($item->start_date) }}
                                                    </td>
                                                    <td>
                                                        {{ App\Http\Controllers\Controller::tanggalIndo($item->end_date) }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <h3 class="text-center fw-bold">Data Kosong</h3>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
