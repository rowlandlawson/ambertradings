<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function awards()
    {
        return view('pages.awards');
    }

    public function whyUs()
    {
        return view('pages.why-us');
    }

    public function performance()
    {
        return view('pages.performance');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function termsConditions()
    {
        return view('pages.terms-conditions');
    }

    public function portfolio()
    {
        return view('pages.portfolio');
    }

    public function forex()
    {
        return view('pages.forex');
    }

    public function commodities()
    {
        return view('pages.commodities');
    }

    public function indices()
    {
        return view('pages.indices');
    }

    public function nfp()
    {
        return view('pages.nfp');
    }

    public function stocks()
    {
        return view('pages.stocks');
    }

    public function cryptocurrency()
    {
        return view('pages.cryptocurrency');
    }

    public function investProfessional()
    {
        return view('pages.invest-professional');
    }

    public function protection()
    {
        return view('pages.protection');
    }

    public function deposits()
    {
        return view('pages.deposits');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function register()
    {
        return view('pages.register');
    }
}
