<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Product;

class ProductController extends Controller
{
    public function create()
    {
        $data = Product::create(['name' => 'sanpham1']);
        $s = Notification::create([
            'title' => 'thông báo tốt nghiệp 2020',
            'content' => 'ok content',
            'route' => 'route("thong-bao.index")',
            'user_id' => 1,
            'auth_id' => 16,
            'type' => 1,
        ]);
    }
}
