<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Show customer list
    public function list()
    {
        return view('customers.list');
    }

    // Add new customer form
    public function create()
    {
        return view('customers.add');
    }

    // Show subscriptions page
    public function subscriptions()
    {
        return view('customers.subscriptions');
    }

    

    // Show customer details (history)
    public function show($id)
    {
        return view('customers.view', compact('id'));
    }

    public function preRegistered()
{
    // Later: fetch customers from DB where status = 'pending'
    // For now: just return the frontend view
    return view('customers.pre_registered');
}

public function showPreRegistered($id)
{
    return view('customers.show_pre_registered');
}

    
}
