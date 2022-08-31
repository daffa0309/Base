<?php

namespace App\Http\Controllers;

use App\Repositories\LogRepository;
use Illuminate\Http\Request;

class LogController extends Controller
{
    protected $repository;

    public function __construct(LogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function datatable(Request $request)
    {
        return $this->repository->datatable($request);
    }

    public function index()
    {
        $datas = $this->repository->getData();

        return view('layouts.pages.logs.index', compact('datas'));
    }
}
