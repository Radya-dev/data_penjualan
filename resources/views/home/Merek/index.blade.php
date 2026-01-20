@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Data Merek</h3>
                            <a href="{{ route('merek.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Nama Merek</th>
                                        <th>Logo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mereks as $merek)
                                    <tr>
                                        <td>{{ $merek->nama_merek }}</td>
                                        <td>
                                            @if($merek->logo)
                                            <img src="{{ asset('storage/' . $merek->logo) }}" alt="Logo Merek" style="width: 60px; height: auto;">
                                            @else
                                            <span>Tidak ada logo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('merek.edit', $merek->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('merek.destroy', $merek->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if($mereks->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">Data merek tidak tersedia.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection
