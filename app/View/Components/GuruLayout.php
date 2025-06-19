<?php
// app/View/Components/GuruLayout.php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class GuruLayout extends Component
{
  public function render()
  {
    $guru = Auth::guard('guru')->user();
    return view('layouts.guru', compact('guru')); // Nama file layout tanpa ekstensi
  }
}
