@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.navadmin')
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="table-success">
                        <tr class="text-center">
                            <th class="fw-bold"></th>
                            <th class="fw-bold">Username</th>
                            <th class="fw-bold">Nama</th>
                            <th class="fw-bold">E-mail</th>
                            <th class="fw-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $item)
                            <tr class="text-center">
                                <td></td>
                                <td>
                                    <u>
                                        <a target="__blank" class="text-dark"
                                            href="{{ route('viewprofile', ['id' => $item->username]) }}">
                                            {{ $item->username }}
                                        </a>
                                    </u>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @switch($item->role)
                                        @case(2)
                                            Pelelang
                                        @break

                                        @case(3)
                                            Peserta
                                        @break

                                        @default
                                            -
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">
                                        <h3>Data Kosong</h3>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
