<?php
        
        namespace App\Http\Controllers;

        use App\Models\Promo;
        
        class PromoController extends Controller
        {
            public function getPromo()
            {
                // Mengambil 1 promo secara acak
                $promo = Promo::inRandomOrder()->first();
        
                return response()->json($promo);  // Mengembalikan data dalam format JSON
            }
        }
        