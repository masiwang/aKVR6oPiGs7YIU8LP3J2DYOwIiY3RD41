@extends('_master')

@section('title')
    Import Data Perusahaan
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow bg-white rounded">
                    <div class="card-header">
                        <h5 class="mb-0 text-blue">Import data perusahaan</h5>
                    </div>
                    <div class="card-body">
                        <p><b>1. Download template</b></p>
                        <p>Berikut adalah link download template apabila Anda belum memiliki template import perusahaan.</p>
                        <p><a href="{{url('admin/download/template')}}" class="btn btn-primary btn-sm">Download template</a></p>
                        <p><b>2. Upload folder foto</b></p>
                        <p>Folder foto berisi dokumen foto perusahaan dengan format .jpg</p>
                        @if (Session::has('success_foto'))
                        <p><button disabled class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadFolderFotoModal">Folder foto berhasil di upload</button></p>
                        @else
                        <p><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadFolderFotoModal">Upload folder foto</button></p>    
                        @endif
                        <p><b>3. Upload spreadsheet</b></p>
                        <p>Sebelum melakukan upload, mohon periksa kembali file Anda. Proses upload tidak dapat dibatalkan.</p>
                        @if (Session::has('success_spreadsheet'))
                        <p><button disabled class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadSpreadsheetModal">Spreadsheet berhasil di upload</button></p>
                        @else
                        <p><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadSpreadsheetModal">Upload spreadsheet</button></p>    
                        @endif
                    </div>
                    <div class="card-footer text-right">
                        <a class="btn btn-primary" href="{{url('admin/perusahaan')}}">Selesai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uploadFolderFotoModal" data-backdrop="static" data-keyboard="false" tabindex="-1"aria-labelledby="uploadFolderFotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('admin/perusahaan/import/foto_save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadFolderFotoModalLabel">Upload Folder Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-file">
                            <input id="customFile" type="file" name="content[]" class="form-file-input" directory webkitdirectory>
                            <label class="form-file-label" for="customFile">
                                <span class="form-file-text">Pilih folder...</span>
                                <span class="form-file-button">Telusuri</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uploadSpreadsheetModal" data-backdrop="static" data-keyboard="false" tabindex="-1"aria-labelledby="uploadSpreadsheetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('admin/perusahaan/import/speadsheet_save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadSpreadsheetModalLabel">Upload Spreadsheet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="TahunData" class="form-label">
                                Tahun Data
                            </label>
                            <input placeholder="{{date('Y')}}" type="number" class="form-control" name="tahun_data" id="TahunData">
                        </div>
                        <div class="mb-3">
                            <label for="TipeIndustri" class="form-label">Tipe Industri</label>
                            <select id="TipeIndustri" class="form-select @error('tipe_industri') is-invalid @enderror" name="tipe_industri">
                                @foreach ($tipe_industri as $tipe)
                                <option value="{{$tipe->id}}">{{$tipe->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-file">
                            <input id="customFile" type="file" class="form-file-input" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel">
                            <label class="form-file-label" for="customFile">
                                <span class="form-file-text">Pilih file...</span>
                                <span class="form-file-button">Browse</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="height: 4rem"></div>
    @include('admin.desktop._footer')
@endsection

