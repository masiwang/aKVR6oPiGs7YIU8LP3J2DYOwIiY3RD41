@extends('_master')

@section('title')
Dashboard
@endsection

@section('content')
@include('admin.components._navbar')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card shadow bg-white rounded">
                <div class="card-header">
                    <h5 class="mb-0 text-blue">Form Perusahaan Baru</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3 mt-0 p-3" action="{{url('admin/perusahaan/create_save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="TahunData" class="form-label">
                                    Tahun Data
                                </label>
                                <input placeholder="2020" type="number" class="form-control" name="tahun_data" id="TahunData">
                            </div>
                            <div class="col-md-3">
                                <label for="TipeIndustri" class="form-label">Tipe Industri</label>
                                <select id="TipeIndustri" class="form-select @error('tipe_industri') is-invalid @enderror" name="tipe_industri">
                                    @foreach ($tipe_industri as $tipe)
                                    <option value="{{$tipe->id}}">{{$tipe->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="SkalaIndustri" class="form-label">Skala Industri</label>
                                <select id="SkalaIndustri" class="form-select" name="skala_industri">
                                    @foreach ($skala_industri as $skala)
                                    <option value="{{$skala->id}}">{{$skala->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="FotoPerusahaan" class="form-label">Foto Perusahaan</label><br />
                                <input type="file" class="form-control-file" name="file" id="addSlideImage">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="BadanUsaha" class="form-label">
                                    Badan Usaha
                                </label>
                                <input placeholder="PT" type="text" class="form-control" name="badan_usaha" id="BadanUsaha">
                            </div>
                            <div class="col-md-9">
                                <label for="NamaIndustri" class="form-label">
                                    Nama Industri
                                </label>
                                <input placeholder="Indonesia Raya" type="text" class="form-control" name="nama_perusahaan" id="NamaIndustri">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="NamaPemilik" class="form-label">
                                    Nama Pemilik
                                </label>
                                <input placeholder="" type="text" class="form-control" name="nama_pemilik" id="NamaPemilik">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" name="telepon" id="Telepon">
                            </div>
                            <div class="col-md-6">
                                <label for="Fax" class="form-label">Fax</label>
                                <input type="text" class="form-control" name="fax" id="Fax">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Email" class="form-label">Email</label>
                                <input placeholder="user@email.com" type="email" class="form-control" name="email" id="Email">
                            </div>
                            <div class="col-md-6">
                                <label for="Website" class="form-label">Website</label>
                                <input placeholder="www.website.com" type="text" class="form-control" name="website" id="Website">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="Jalan" class="form-label">Jalan</label>
                                <input placeholder="Jl. Burung Elang" type="text" class="form-control" name="alamat_usaha" id="Jalan">
                            </div>
                            <div class="col-md-3">
                                <label for="Kecamatan" class="form-label">Kecamatan</label>
                                <select id="Kecamatan" class="form-select" name="kecamatan">
                                    <option selected>Pilih Kecamatan</option>
                                    @foreach ($kecamatan as $k)
                                    <option value="{{$k->id}}">{{$k->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="Kelurahan" class="form-label">
                                    Kelurahan
                                </label>
                                <select id="Kelurahan" class="form-select" name="kelurahan">
                                    <option selected>Pilih Kelurahan</option>
                                    @foreach ($kelurahan as $k)
                                    <option value="{{$k->id}}">{{$k->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="IzinUsaha" class="form-label">
                                    Izin Usaha
                                </label>
                                <input placeholder="TDI 530/014/XI/2013 NIPIK 5309.3317.01037" type="text" class="form-control" name="izin_usaha" id="IzinUsaha">
                            </div>
                            <div class="col-md-3">
                                <label for="TahunIzin" class="form-label">Tahun Izin</label>
                                <select id="TahunIzin" class="form-select" name="tahun_izin">
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="KBLI" class="form-label">
                                    KBLI
                                </label>
                                <input placeholder="" type="text" class="form-control" name="kbli" id="KBLI">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="Komoditas" class="form-label">
                                    Komoditas
                                </label>
                                <input placeholder="Industri air minum" type="text" class="form-control" name="komoditas" id="Komoditas">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="JenisProduk" class="form-label">
                                    Jenis Produk
                                </label>
                                <input placeholder="Air minum isi ulang" type="text" class="form-control" name="jenis_produk" id="JenisProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="KaryawanLaki" class="form-label">
                                    Karyawan Laki-laki
                                </label>
                                <input placeholder="0" type="number" class="form-control" name="karyawan_laki" id="KaryawanLaki">
                            </div>
                            <div class="col-md-6">
                                <label for="KaryawanPerempuan" class="form-label">
                                    Karyawan Perempuan
                                </label>
                                <input placeholder="0" type="number" class="form-control" name="karyawan_perempuan"
                                    id="KaryawanPerempuan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="NilaiInvestasi" class="form-label">
                                    Nilai Investasi
                                </label>
                                <input placeholder="Dalam Rp." type="number" class="form-control" name="nilai_investasi" id="NilaiInvestasi">
                            </div>
                            <div class="col-md-12">
                                <label for="NilaiProduksi" class="form-label">
                                    Nilai Produksi
                                </label>
                                <input placeholder="Dalam Rp." type="number" class="form-control" name="nilai_produksi" id="NilaiProduksi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="JumlahKapasitasProduksi" class="form-label">
                                    Jumlah Kapasitas Produksi
                                </label>
                                <input placeholder="1000" type="number" class="form-control" name="jumlah_kapasitas_produksi"
                                    id="JumlahKapasitasProduksi">
                            </div>
                            <div class="col-md-4">
                                <label for="SatuanKapasitasProduksi" class="form-label">
                                    Satuan Kapasitas Produksi
                                </label>
                                <input placeholder="galon" type="text" class="form-control" name="satuan_kapasitas_produksi"
                                    id="SatuanKapasitasProduksi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="BahanBakuUtama" class="form-label">
                                    Bahan Baku Utama
                                </label>
                                <input placeholder="Air" type="text" class="form-control" name="bahan_baku_utama" id="BahanBakuUtama">
                            </div>
                            <div class="col-md-4">
                                <label for="NilaiBahanBaku" class="form-label">
                                    Nilai Bahan Baku (Rp.)
                                </label>
                                <input placeholder="Dalam Rp." type="number" class="form-control" name="nilai_bahan_baku" id="NilaiBahanBaku">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="BahanPenolong" class="form-label">
                                    Bahan Penolong
                                </label>
                                <input placeholder="Galon" type="text" class="form-control" name="bahan_penolong" id="BahanPenolong">
                            </div>
                            <div class="col-md-4">
                                <label for="NilaiBahanPenolong" class="form-label">
                                    Nilai Bahan Penolong
                                </label>
                                <input placeholder="Dalam Rp." type="number" class="form-control" name="nilai_bahan_penolong"
                                    id="NilaiBahanPenolong">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="WilayahPemasaran" class="form-label">
                                    Wilayah Pemasaran Dalam Negeri
                                </label>
                                <input placeholder="Surakarta" type="text" class="form-control" name="wilayah_pemasaran" id="WilayahPemasaran">
                            </div>
                            <div class="col-md-6">
                                <label for="NegaraTujuanExport" class="form-label">
                                    Negara Tujuan Eksport
                                </label>
                                <input placeholder="Singapura" type="text" class="form-control" name="negara_tujuan_export"
                                    id="NegaraTujuanExport">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="Energi" class="form-label">
                                    Energi yang dibutuhkan
                                </label>
                                <input placeholder="Listrik" type="text" class="form-control" name="energi" id="Energi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="LimbahDihasilkan" class="form-label">
                                    Limbah yang dihasilkan
                                </label>
                                <input type="text" class="form-control" name="limbah_dihasilkan" id="LimbahDihasilkan">
                            </div>
                            <div class="col-md-4">
                                <label for="JumlahLimbah" class="form-label">
                                    Jumlah Limbah
                                </label>
                                <input type="number" class="form-control" name="jumlah_limbah" id="JumlahLimbah">
                            </div>
                            <div class="col-md-2">
                                <label for="SatuanLimbah" class="form-label">
                                    Satuan Limbah
                                </label>
                                <input type="text" class="form-control" name="satuan_limbah" id="SatuanLimbah">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="OlahanLimbah" class="form-label">
                                    Olahan Limbah
                                </label>
                                <input type="text" class="form-control" name="olahan_limbah" id="OlahanLimbah">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="NIK" class="form-label">
                                    NIK
                                </label>
                                <input type="number" class="form-control" name="nik" id="NIK">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Latitude" class="form-label">
                                    Latitude (Geografis)
                                </label>
                                <input placeholder="Dalam UTM" type="number" class="form-control" name="latitude" id="Latitude">
                            </div>
                            <div class="col-md-6">
                                <label for="Longitude" class="form-label">
                                    Longitude (Geografis)
                                </label>
                                <input placeholder="Dalam UTM" type="number" class="form-control" name="longitude" id="Longitude">
                            </div>
                        </div>
                        <hr />
                        <div class="col-12 d-flex justify-content-end">
                            <a href="#" class="btn btn-secondary mr-3">Kembali</a>
                            <button type="submit" id="buttonSimpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="height: 4rem"></div>
@include('admin.desktop._footer')
<script>$('select[name="kelurahan"]').change(function(){var o=$(this).val(),n=$('select[name="kecamatan"]');o<16?n.html('<option value="1" selected>Banjarsari</option>'):o<27?n.html('<option value="2" selected>Jebres</option>'):o<38?n.html('<option value="3" selected>Laweyan</option>'):o<47?n.html('<option value="4" selected>Pasar Kliwon</option>'):o<54?n.html('<option value="5" selected>Serengan</option>'):console.log("error")}),$('select[name="kecamatan"]').change(function(){var o=$(this).val(),n=$('select[name="kelurahan"]');switch(o){case"1":n.html('<option value="1">Banyuanyar</option><option value="2">Banjarsari</option><option value="3">Gilingan</option><option value="4">Joglo</option><option value="5">Kadipiro</option><option value="6">Keprabon</option><option value="7">Kestalan</option><option value="8">Ketelan</option><option value="9">Manahan</option><option value="10">Mangkubumen</option><option value="11">Nusukan</option><option value="12">Punggawan</option><option value="13">Setabelan</option><option value="14">Sumber</option><option value="15">Timuran</option>');break;case"2":n.html('<option value="16">Gendekan</option><option value="17">Jagalan</option><option value="18">Jebres</option><option value="19">Kepatihan Kulon</option><option value="20">Kepatihan Wetan</option><option value="21">Mojosongo</option><option value="22">Pucangsawit</option>       <option value="23">Purwodiningratan</option><option value="24">Sewu</option><option value="25">Sudiroprajan</option><option value="26">Tegalharjo</option>');break;case"3":n.html('<option value="27">Bumi</option><option value="28">Jajar</option><option value="29">Karangasem</option><option value="30">Kerten</option><option value="31">Laweyan</option><option value="32">Pajang</option><option value="33">Panularan</option><option value="34">Panumping</option><option value="35">Purwosari</option><option value="36">Sondakan</option><option value="37">Sriwedari</option>');break;case"4":n.html('<option value="38">Baluwarti</option><option value="39">Gajahan</option><option value="40">Joyosuran</option><option value="41">Kampung Baru</option><option value="42">Kauman</option><option value="43">Kedung Lumbu</option><option value="44">Mojo</option><option value="45">Pasar Kliwon</option><option value="46">Semanggi</option>');break;case"5":n.html('<option value="47">Danukusuman</option><option value="48">Jayengan</option><option value="49">Joyotakan</option><option value="50">Kemlayan</option><option value="51">Kratonan</option><option value="52">Serengan</option><option value="53">Tipes</option>')}});</script>
<script>var latitude=document.querySelector('input[name="latitude"'),longitude=document.querySelector('input[name="longitude"'),buttonSimpan=document.querySelector("#buttonSimpan");latitude.addEventListener("change",function(){this.value<474e3||this.value>486e3?(alert("Nilai latitude anda salah!\nNilai latitude harus diantara 474000 hingga 486000"),buttonSimpan.setAttribute("disabled",!0)):buttonSimpan.removeAttribute("disabled",!0)}),longitude.addEventListener("change",function(){this.value<916e4||this.value>9169e3?(alert("Nilai longitude anda salah!\nNilai longitude harus diantara 9160000 hingga 9169000"),buttonSimpan.setAttribute("disabled",!0)):buttonSimpan.removeAttribute("disabled",!0)});</script>
@endsection