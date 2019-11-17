<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\ErrorHandler\Collecting;

class MenuController extends Controller
{
    function MenusAvailable(Request $request) {
        return view('menusAvailable');
    }

    function SaveMenu(Request $request) {
        $menuCollection = collect();
        if ($request->input('menus') != null) {
            foreach ($request->input('menus') as $id) {
                $menuCollection->push($id);
            }
        }
        $request->session()->put('menus', $menuCollection);
        return $this->SaveMenuAndRedirectToSelectDecoration($request);
    }

    function SkipMenu(Request $request) {
        return $this->SaveMenuAndRedirectToSelectDecoration($request);
    }

    function SaveMenuAndRedirectToSelectDecoration(Request $request) {
        if (!$request->session()->has('menus')) {
            $request->session()->put('menus',collect());
        }
        $request->session()->save();
        //print($request->session()->get('menus'));
        return view('decorationPrompt');
    }    
}
