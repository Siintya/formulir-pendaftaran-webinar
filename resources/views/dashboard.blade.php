@extends('layouts.master')
@section('custom_css')
<style>
    /* Custom CSS untuk sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 100;
      padding: 48px 35px;
      background-color: #f8f9fa;
      overflow-x: hidden;
    }

    @media (max-width: 991.98px) {
      .sidebar {
        padding-top: 60px;
      }
    }

    .sidebar .list-group-item {
      border-radius: 0;
      background-color: transparent;
      border: none;
      padding: 10px 20px;
      color: #000;
    }

    .sidebar .list-group-item:hover {
      background-color: #e9ecef;
    }

    .content {
      margin-left: 230px;
      padding: 20px;
    }
</style>
@endsection
@section('content')

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="#" class="text-decoration-none text-dark"> 
                    <svg class="me-2 mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{url('logout')}}" class="text-decoration-none text-dark">
                    <svg class="me-2 mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content p-5">
        <h1>Selamat Datang, <span class="text-capitalize">{!! $user->name !!}</span></h1>
        <p class="text-muted">Berikut ini adalah daftar peserta yang telah berhasil mendaftar.</p>

        <table id="daftarPeserta" class="table table-striped table-bordered p-2" style="width:100%">
          <thead>
              <tr>
                <th class="text-center fw-bold">No</th>
                <th class="text-center fw-bold">Foto</th>
                <th class="text-center fw-bold">Nama</th>
                <th class="text-center fw-bold">Email</th>
                <th class="text-center fw-bold">No. Telepon</th>
                <th class="text-center fw-bold">Perusahaan</th>
                <th class="text-center fw-bold">Tanggal</th>
              </tr>
          </thead>
          <tbody>
            @if(count($participants) > 0)
              @foreach ($participants as $participant)
                <tr>
                  <td class="text-center">
                    {{ $loop->iteration }}.
                  </td>
                  <td class="text-center">
                    <!-- Foto Profil -->
                    @if (!empty($participant->photo))
                        
                        <!-- Button trigger modal -->
                        <a data-bs-toggle="modal" data-bs-target="#fotoModal{{$participant->id}}">
                          <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($participant->photo)) }}" class="card-img-top rounded-circle" alt="gambar" style="width:80px;">
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="fotoModal{{$participant->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5 text-capitalize" id="staticBackdropLabel">{!! $participant->name !!}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($participant->photo)) }}" class="card-img-top rounded" alt="gambar" style="width:400px;">
                              </div>
                            </div>
                          </div>
                        </div>
                    @else
                        <img class="rounded-circle mx-auto" width="200px" src="{{ asset('images/people.jpg') }}">
                    @endif
                  </td>
                  <td class="text-capitalize">{!! $participant->name !!}</td>
                  <td>
                    <a href="mailto:{{$participant->email}}">{!! $participant->email !!}</a>
                  </td>
                  <td>{!! $participant->phone !!}</td>
                  <td>{!! $participant->company !!}</td>
                  <td>{!! date('d-m-Y', strtotime($participant->created_at)) !!}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td class="text-muted text-center" colspan="7">
                    Tidak ada data yang tersedia
                </td>
              </tr>
            @endif
          </tbody>
      </table>
    </div>
@endsection
@section('scripts_js')
<script type="text/javascript">
  $(document).ready(function () {
    $('#daftarPeserta').DataTable();
  });
</script>
@endsection