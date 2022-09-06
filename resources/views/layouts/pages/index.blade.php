@extends('layouts.partials.app')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('style')
@endsection


@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

{{-- @section('breadcrumb-items')
<li class="breadcrumb-item active">Dashboard</li>
@endsection --}}

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-12 xl-100">
                <div class="card" style="border-radius:15px">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-bottom" id="bottom-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                    href="#dashboard" role="tab" aria-controls="dashboard"
                                    aria-selected="true">Dashboard</a></li>
                        </ul>
                        <div class="tab-content" id="bottom-tabContent">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel"
                                aria-labelledby="dashboard-tab">
                                <div class="card-body row pricing-content">
                                <div id="vizContainer" width='100%' height='1000'>
                        </div>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection

@section('script')
<script src="http://localhost/javascripts/api/tableau-2.min.js"></script>

<script>

        var viz

        function initViz() {
            var containerDiv = document.getElementById("vizContainer")
            // url = "https://public.tableau.com/views/DailyContributionMarginAnalysisforManufacturing/ManufacturingDailyAnalysis?:language=en-US&:display_count=n&:origin=viz_share_link";
            // url = document.getElementById('tableau_frame').src;
            viz = new tableau.Viz(containerDiv,
                "{{ $setting->tableauserverexternal }}/trusted/{{ $ticket }}/views/Superstore/Overview?:embed=yes&:toolbar=no&:device=desktop"
                );
                // string(140) "https://idxbidev-portal.idx.co.id/trusted/giuZFpobT8eiTT0i4dSCng==:12FW5NKKJnXMbU3pw4i8RnXe/t/BEI-WAS/views/IDXBoard_16390364269560/IDXBoard"
                // https://idxbidev-portal.idx.co.id/trusted/pBTNGtOUSSWYKmfj3H1K7Q==:8rodz38SvAdsymtXF1xhq4KG/t/BEI-WAS/views/IDXBoard_16390364269560/IDXBoard?:embed=yes&:toolbar=no&:device=desktop
            }

        initViz();

        function exportToPDF() {
            viz.showExportPDFDialog();
        }

        function exportToWorkbook() {
            viz.showDownloadWorkbookDialog();
        }

        function exportToImage() {
            viz.showExportImageDialog();
        }

        function exportToData() {
            viz.showExportDataDialog();
        }

        function exportToCrosstab() {
            viz.showExportCrossTabDialog();
        }
    </script>
@endsection
