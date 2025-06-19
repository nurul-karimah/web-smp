<?php
// app/View/Components/GuruLayout.php
namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class OrangtuaLayout extends Component
{
  public function render(): View
  {
    $orangtua = Auth::guard('orangtua')->user();
    return view('layouts.orangtua', compact('orangtua')); // Nama file layout tanpa ekstensi
  }
}
