<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Repositories\TestingRepository;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    protected $repository;

    public function __construct(TestingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function datatable(Request $request)
    {
        return $this->repository->datatable($request);
    }

    public function index()
    {
        $roles = Roles::get();
        $datas = $this->repository->getData();
        return view('layouts.pages.testing.index', compact('datas', 'roles'));
    }
}
