@extends('layouts.partials.app')

@section('title', 'View Dashboard')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ $menu->name }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">{{ $menu->name }}</li>
@endsection

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card" style="border-radius:15px">
                    <div class="card-body">
                        <div class="my-2">

                            <button onclick="exportToPDF();" class="btn btn-outline-light btn-sm txt-dark">Export PDF</button>
                            {{-- <button onclick="exportToCrosstab();"  class="btn btn-outline-light btn-sm txt-dark" > Export To Crosstab</button>
                        <button onclick="exportToWorkbook();"  class="btn btn-outline-light btn-sm txt-dark" >Export To Workbook</button>
                        <button onclick="exportToData();"  class="btn btn-outline-light btn-sm txt-dark" >Export To Data</button>
                        <button onclick="exportToImage();"  class="btn btn-outline-light btn-sm txt-dark" >Export To Image</button> --}}

                        </div>
                        <div id="vizContainer" width='100%' height='1000'>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://idxbidev-portal.idx.co.id/javascripts/api/tableau-2.min.js"></script>
    <!-- <script src="{{ asset('assets/js/tooltip.init.js') }}"></script> -->


    <script>
        var viz

        function initViz() {
            var containerDiv = document.getElementById("vizContainer")
            // url = "https://public.tableau.com/views/DailyContributionMarginAnalysisforManufacturing/ManufacturingDailyAnalysis?:language=en-US&:display_count=n&:origin=viz_share_link";
            // url = document.getElementById('tableau_frame').src;
            viz = new tableau.Viz(containerDiv,
                "{{ $setting->tableauserverexternal }}/trusted/{{ $ticket }}/t/BEI-WAS/views/{{ $menu->urlview }}?:embed=yes&:toolbar=no&:device=desktop"
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
