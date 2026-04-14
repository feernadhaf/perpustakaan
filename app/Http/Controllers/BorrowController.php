<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowController extends Controller
{
    public function store (Request $request)
    {
        $borrowDate = Carbon::today();
        $dueDate = $borrowDate->copy()->addDays(7);

        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrowed_date' => $borrowDate,
            'due_date' => $dueDate,
            'status' =>'diajukan',
        ]);

        $book = Book::find($request->book_id);
        $book->status = 1;
        $book->save();

        $user = User::find($request->user_id);
        
        return redirect()->route('borrows', $user->slug)->with('success', "Book borrowed successfully");
    }



    public function index()
    {
        $title = 'Borrow - index'  ;
        $borrows = Borrow::latest()->paginate(10);
        return view('dashboard.borrow.index', compact('borrows', 'title'));
    }

    public function edit (Borrow $borrow)
    {
        $title ="Borrow - Edit";
        
        return view ('dashboard.borrow.edit',compact('title','borrow'));
    }


public function update(Request $request, Borrow $borrow)
{
    // 1. Update status peminjaman
    $borrow->status = $request->status;
    if ($request->filled('message')) {
        $borrow->message = $request->message; // Simpan pesan jika status ditolak
    }
    $borrow->save();

    // 2. Ambil data buku terkait
    $book = $borrow->book; 

    // 3. Logika update status buku (cek typo 'status' dan 'status')
    if ($request->status == 'diajukan' || $request->status == 'dipinjam') {
        $book->status = 1; // Pakai 'status', bukan 'satus'
        $book->save();
    } elseif ($request->status == 'dikembalikan' || $request->status == 'ditolak') {
        $book->status = 0;
        $book->save();
    }

    // 4. Return dengan key 'success' yang benar
    return redirect('/dashboard/borrow')->with('success', "Borrow updated successfully");
}

public function delete(Borrow $borrow)
{
    Borrow::destroy($borrow->id);

    return redirect('dashboard/borrow')->with('success',"Borrow deleted successfully");
}

public function userIndex(User $user)
{
   $title = $user->name . ' borrows';
   $borrows = $borrows = Borrow::where('user_id', $user->id)->latest()->paginate(10);  
   return view('borrow',compact('title','borrows'));
}




public function detail(Borrow $borrow)
{
    $title = 'Detail peminjaman';
    return view('borrow-detail', compact('title', 'borrow'));


}


}