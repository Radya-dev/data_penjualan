@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data Merek</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('merek.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nama_merek">Nama Merek</label>
                                    <input type="text" name="nama_merek" id="nama_merek" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="logo">Logo Merek</label>
                                    <input type="file" name="logo" id="logo" class="form-control" required>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('merek.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
