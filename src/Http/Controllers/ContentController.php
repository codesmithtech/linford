<?php
namespace CodeSmithTech\Linford\Http\Controllers;

use Illuminate\Routing\Controller;

class ContentController extends Controller
{
    public function index()
    {
        return redirect()->to('/vendor/linford');
    }
}