<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $recentNews = News::orderBy('tanggal_publikasi', 'desc')->limit(5)->get(); // Ambil berita terbaru
        
        return view('admin.dashboard', [
            'user' => $user,
            'recentNews' => $recentNews,
        ]);
    }
    

    public function upload()
    {
        $user = Auth::user();
        return view('admin.upload', ['user' => $user]);
    }

    public function newslist(){
        $news = News::all(); // Ambil semua data berita
        return view('admin.listberita', ['news' => $news]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = News::orderBy('tanggal_publikasi', 'asc')->get();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ]);
    }

    public function latestNews()
{
    $latestNews = News::orderBy('tanggal_publikasi', 'asc')->limit(5)->get();
    return response()->json([
        'message' => 'success',
        'data' => $latestNews
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required',
            'author' => 'required',
            'tanggal_publikasi' => 'required|date',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data gagal ditambahkan',
                'data' => $validator->errors()
            ], 400);
        }

        $databerita = new News;
        $databerita->judul = $request->judul;
        $databerita->author = $request->author;
        $databerita->tanggal_publikasi = $request->tanggal_publikasi;
        $databerita->deskripsi = $request->deskripsi;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $databerita->image = $imageName;
        } else {
            $databerita->image = null; // Atur ke null jika tidak ada file yang diupload
        }

        $databerita->save();

        return redirect()->route('listberita')->with('success', 'News added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = News::find($id);
    
        if (!$news) {
            abort(404, 'News not found');
        }
    
        return view('admin.show', ['news' => $news]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::find($id);
        if (!$news) {
            return redirect()->route('newslist')->with('error', 'News not found.');
        }
        return view('admin.editberita', ['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // Temukan berita berdasarkan ID
    $databerita = News::find($id);

    if (!$databerita) {
        return redirect()->route('newslist')->with('error', 'News not found.');
    }

    // Validasi input
    $rules = [
        'judul' => 'required',
        'author' => 'required',
        'tanggal_publikasi' => 'required|date',
        'deskripsi' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Update data berita
    $databerita->judul = $request->judul;
    $databerita->author = $request->author;
    $databerita->tanggal_publikasi = $request->tanggal_publikasi;
    $databerita->deskripsi = $request->deskripsi;

    // Update gambar jika ada file baru
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($databerita->image) {
            $oldImagePath = public_path('images/' . $databerita->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Upload gambar baru
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $databerita->image = $imageName;
    }

    $databerita->save();

    return redirect()->route('listberita')->with('success', 'News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Temukan berita berdasarkan ID
    $databerita = News::find($id);

    if (!$databerita) {
        return redirect()->route('newslist')->with('error', 'News not found.');
    }

    // Hapus gambar terkait jika ada
    if ($databerita->image) {
        $imagePath = public_path('images/' . $databerita->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Hapus berita dari database
    $databerita->delete();

    return redirect()->route('listberita')->with('success', 'News deleted successfully.');
    }

    public function showWelcomePage()
{
    $recentNews = News::orderBy('tanggal_publikasi', 'desc')->take(6)->get(); // Ambil 6 berita terbaru
    return view('welcome', ['recentNews' => $recentNews]);
}

}
