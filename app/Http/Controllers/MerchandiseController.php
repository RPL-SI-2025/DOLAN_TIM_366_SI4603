<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchandiseController extends Controller
{
    public function indexAdmin()
    {
        // Data dummy untuk Admin
        $merchandises = [
            (object)[
                'id' => 1,
                'name' => 'Kaos Dolan Putih',
                'location' => 'Bandung, Indonesia',
                'stock' => 120,
                'price' => 120000,
                'image_main' => 'https://via.placeholder.com/100x70?text=Kaos+Putih',
            ],
            (object)[
                'id' => 2,
                'name' => 'Topi Dolan',
                'location' => 'Yogyakarta, Indonesia',
                'stock' => 80,
                'price' => 75000,
                'image_main' => 'https://via.placeholder.com/100x70?text=Topi+Dolan',
            ],
            (object)[
                'id' => 3,
                'name' => 'Tote Bag Dolan',
                'location' => 'Surabaya, Indonesia',
                'stock' => 50,
                'price' => 60000,
                'image_main' => 'https://via.placeholder.com/100x70?text=Tote+Bag',
            ],
        ];

        return view('dashboard.merchandise.index', compact('merchandises'));
    }

    // Menampilkan daftar merchandise
    public function index()
    {
        $merchandises = [
            (object)[
                'id' => 1,
                'name' => 'Gunung Bromo T-Shirt',
                'detail' => 'T-Shirt dengan desain Gunung Bromo yang eksotis.',
                'price' => 350000,
                'location' => 'Probolinggo, Jawa Timur, Indonesia',
                'image' => 'https://example.com/images/bromo-shirt.jpg',
                'stock' => 50,
            ],
            (object)[
                'id' => 2,
                'name' => 'Danau Toba Mug',
                'detail' => 'Mug dengan desain indah Danau Toba.',
                'price' => 300000,
                'location' => 'Sumatera Utara, Indonesia',
                'image' => 'https://example.com/images/toba-mug.jpg',
                'stock' => 100,
            ],
            // Tambah item lainnya sesuai kebutuhan
        ];

        return view('merchandise.index', compact('merchandises'));
    }

    // Menampilkan detail merchandise berdasarkan ID
    public function show($id)
    {
            {
        // Data dummy untuk detail merchandise
        $merchandises = (object)[
            'id' => 1,
            'name' => 'Gunung Bromo T-Shirt',
            'detail' => 'T-Shirt dengan desain Gunung Bromo yang eksotis.',
            'price' => 350000,
            'location' => 'Probolinggo, Jawa Timur, Indonesia',
            'image' => 'https://example.com/images/bromo-shirt.jpg',
            'stock' => 50,
        ];

        return view('merchandise.show', compact('merchandise'));
    }

    }
     // Menampilkan detail merchandise untuk Admin
     public function showAdmin($id)
     {
         // Data dummy untuk Admin
         $merchandise = (object)[
             'id' => 1,
             'name' => 'Kaos Dolan Putih',
             'detail' => 'T-shirt dengan desain Kaos Dolan Putih yang stylish.',
             'price' => 120000,
             'location' => 'Bandung, Indonesia',
             'image' => 'https://via.placeholder.com/400x300?text=Kaos+Putih',
             'stock' => 120,
         ];
 
         return view('dashboard.merchandise.show', compact('merchandise'));
     }
 
}