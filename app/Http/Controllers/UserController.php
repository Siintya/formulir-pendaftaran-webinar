<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use DB;
use Validator;
use Image;
use Carbon\Carbon;
use App\User; 
use App\UserRole; 

class UserController extends Controller
{
    public function index()
	{
		return view('welcome', [
			'title'   => 'Homepage'
		]);
	}
    
    // Pendaftaran Peserta Webinar
    public function addParticipant(Request $request)
    {
        // $file = $request->file('foto');
        // dd($file);
        // validasi
        $rules = [
            'nama'       => 'required',
            'email'      => 'required|email',
            'notelp'     => 'required',
            'perusahaan' => 'required',
            'foto'       => 'required|mimes:jpg,png,jpeg|max:2048'
        ];
      
        $messages = [
            'required'  => 'Kolom ini harus diisi!',
            'unique'    => ':attribute sudah digunakan',
            'image'     => 'File yang diunggah bertipe data gambar',
            'mimes'     => 'Hanya diizinkan gambar yang bereksistensi png, jpg, dan jpeg',
            'max'       => 'Gambar yang diunggah maks. 2 MB'
        ];
      
        $request->validate($rules, $messages);
        // dd($request);
        // Tambah user
        $date  = Carbon::now();
        $user = new User;
        $user->name          = $request->nama;
        $user->email         = $request->email;
        $user->user_role_id  = 2;
        $user->password      = bcrypt('password123');
        $user->phone         = $request->notelp;
        $user->company       = $request->perusahaan;
        $user->created_at    = $date;

        if($request->hasFile('foto')){
            $file         = $request->file('foto');
            $imageType    = $file->extension();
            $image_resize = Image::make($file)->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($imageType);
            $user->photo = $image_resize;
        }
        $user->save();
        // Notifikasi success
        Session::flash('success', 'Pendaftaran peserta webinar berhasil dilakukan!');
        return redirect()->back();
    }

    // Hal. Login
    public function loginPage(Request $request)
    {
        return view('login', [
			'title'   => 'Login'
		]);
    }

    // Action Login
	public function loginAction(Request $request)
	{
		// dd($request->all());
		// Validasi input
		$rules = [
			'email'    => 'required',
			'password' => 'required'
		];
		$messages = [
			'required' => 'kolom ini harus di isi!'
		];
		$this->validate($request, $rules, $messages);

		if(Auth::attempt($request->only('email', 'password')))
		{
			$user = User::where('email', $request->email)->first();

			if($user->user_role_id == 1){
				return redirect('/dashboard-admin');
			}else{
                return redirect('/login')->with("login_failed", "Email atau password tidak ditemukan!");
            }

		}else{
            return redirect('/login')->with("login_failed", "Email atau password tidak ditemukan!");
        }

	}
    

    // Logout
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    } 

    // Hal. dashboard admin
    public function dashboard()
    {
        $user   	  = User::where('id', Auth::user()->id)->first();
		$participants = User::where('user_role_id', 2)->get();
		return view('dashboard', [
			'title'         => 'Dashboard',
            'user'          => $user,
            'participants'  => $participants,
		]);
    }
}
