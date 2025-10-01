<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormPengaduanController extends Controller
{
    public function index()
    {
        $list_kategori = ['Kebersihan', 'Keamanan', 'Infrastruktur', 'Lainnya'];
        $rt_list = range(1, 10);
        $rw_list = range(1, 5);

        return view('formpengaduan', compact(
            'list_kategori',
            'rt_list',
            'rw_list'
        ));
    }
}
