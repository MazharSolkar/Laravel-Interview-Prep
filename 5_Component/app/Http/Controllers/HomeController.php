<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $flag = true;
        $posts = [
            ['title'=>'samsung', 'desc'=> 'samsung is great Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates est iusto officiis? Facilis ex amet neque nihil praesentium impedit eius..'],
            ['title'=>'apple', 'desc'=> 'apple is great Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolores cum assumenda eveniet vel inventore, optio temporibus ex aut iusto voluptate?.'],
            ['title'=>'vivo', 'desc'=> 'vivo is great Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolores cum assumenda eveniet vel inventore, optio temporibus ex aut iusto voluptate?.'],
        ];

        return view('home', compact('posts', 'flag'));
    }
}
