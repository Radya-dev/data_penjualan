@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Merek</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('merek.update', $merek->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="nama_merek">Nama Merek</label>
                                    <input type="text" name="nama_merek" id="nama_merek" class="form-control" value="{{ old('nama_merek', $merek->nama_merek) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="logo">Logo Merek</label><br>
                                    @if($merek->logo)
                                    <img src="{{ asset('storage/' . $merek->logo) }}" alt="Logo Merek" style="width: 100px; height: auto; margin-bottom: 10px;">
                                    @endif
                                    <input type="file" name="logo" id="logo" class="form-control">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('merek.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col-md-8 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection
