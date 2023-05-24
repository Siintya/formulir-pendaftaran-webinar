@extends('layouts.master')

@section('content')
<main>
  <div class="container col-xl-11 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-6 text-center text-lg-start">
          <h1 class="display-5 fw-bold lh-1 mb-3">
            Formulir Pendaftaran Webinar
          </h1>
          <p class="col-lg-10">
            <strong class="text-primary">Webinar AI for Cybersecurity</strong> bertujuan memberikan wawasan tentang penggunaan AI sebagai alat penting dalam melindungi organisasi dari serangan siber.
            <br> <br>Webinar ini akan diselenggarakan pada Sabtu, 25 Mei 2023. Untuk mendaftar, silakan isi formulir data diri yang tersedia di samping.
          </p>
        </div>
        <div class="col-md-10 mx-auto col-lg-6">
          <form class="p-4 p-md-5 border rounded-3 bg-light" action="{{route('addParticipant')}}" method="POST" enctype="multipart/form-data" role="form">
            {!! csrf_field() !!}
            <div class="row">
              <div class="col-sm-12">
                <!--Notif success-->
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

              </div>
              <div class="col-sm-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="nama" id="Nama" placeholder="Nama Lengkap" value="{{old('nama')}}">
                  <label for="Nama">Nama Lengkap</label>
                  <!--Notif error-->
                  @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                
              </div>
              <div class="col-sm-6">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="{{old('email')}}">
                  <label for="email">Email</label>
                  <!--Notif error-->
                  @error('email')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="perusahaan" id="perusahaan" placeholder="Perusahaan" value="{{old('perusahaan')}}">
                  <label for="perusahaan">Perusahaan</label>
                  <!--Notif error-->
                  @error('perusahaan')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="notelp" name="notelp" placeholder="No. Telepon" value="{{old('notelp')}}">
                  <label for="notelp">No. Telepon</label>
                  <!--Notif error-->
                  @error('notelp')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-sm-12 mb-3">
                <label for="foto">Foto Peserta</label>
                <div class="input-group mt-1">
                  <input type="file" class="form-control" id="foto" name="foto" value="{{old('foto')}}">
                </div>
                <!--Notif error-->
                @error('foto')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-sm-12">
                <button class="w-100 btn btn-md btn-primary" type="submit">Daftar</button>
              </div>
            </div>               
            
            <hr class="my-4">
            <small class="text-muted">
              Untuk user admin silahkan login <a href="{{url('login')}}">disini</a> !
            </small>
          </form>
        </div>
      </div>
    </div>
</main>
@endsection