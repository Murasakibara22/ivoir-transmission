<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">États financiers</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tableau de bord</a></li>
                                <li class="breadcrumb-item active">États financiers</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>






            <div class="row project-wrapper">
                    {{-- Add un select filter by year --}}
                        <div class="col-4 float-end">
                            <div class="mb-3">
                                <select class="form-control" wire:model.live="filter_year">
                                    <option value="">Selectionnez une année</option>
                                    @if($list_years)
                                        @foreach($list_years as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($filter_year)
                        <div class="col-4">
                            <button class="btn btn-secondary btn-sm ms-2 mt-3" wire:click="resetFilter">Rafraichir</button>
                        </div>
                        @endif

                        <div class="col-xxl-12">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="card card-animate bg-primary">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-2 fs-2">
                                                        <i data-feather="dollar-sign" class="text-primary"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                    <p class="text-uppercase fw-medium text-white text-truncate mb-3">Gains Total</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 text-white mb-0"><span class="counter-value" data-target="{{$gains_total}}">{{ number_format($gains_total, 0, ',', '.') }}</span> fcfa</h4>
                                                    </div>
                                                    <p class="text-white text-truncate mb-0">Commande terminer</p>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card card-animate bg-success">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-light text-warning rounded-2 fs-2">
                                                        <i class="text-success ri-wallet-fill"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-medium text-white mb-3">Gains obtenue</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 text-white mb-0"><span class="counter-value" data-target="{{$gains_obtenu}}">{{ number_format($gains_obtenu, 0, ',', '.') }}</span> fcfa</h4>
                                                    </div>
                                                    <p class="text-white mb-0">Commande Terminer</p>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card card-animate bg-info">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-light text-warning rounded-2 fs-2">
                                                        <i class="text-info ri-wallet-fill"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-medium text-white mb-3">Gains à avoir</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 text-white mb-0"><span class="counter-value" data-target="{{$gains_a_avoir}}">{{number_format($gains_a_avoir, 0, ',', '.')}}</span> fcfa</h4>
                                                    </div>
                                                    <p class="text-white mb-0">Commande valider</p>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card card-animate bg-danger">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-light text-info rounded-2 fs-2">
                                                        <i  class="text-info ri-wallet-fill"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                    <p class="text-uppercase fw-medium text-white text-truncate mb-3">Gains Perdu</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 mb-0 text-white">{{ number_format($gains_perdu, 0, ',', '.')}} fcfa</h4>
                                                    </div>
                                                    <p class="text-white text-truncate mb-0">Commande Annuler</p>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card card-animate bg-warning">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-light text-warning rounded-2 fs-2">
                                                        <i class="text-warning ri-wallet-fill"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-medium text-white mb-3">Gains en attente</p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 text-white mb-0"><span class="counter-value" data-target="{{$gains_en_attente}}">{{ number_format($gains_en_attente, 0, ',', '.') }}</span> fcfa</h4>
                                                    </div>
                                                    <p class="text-white mb-0">Commande en attente</p>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div><!-- end col -->

                            </div><!-- end row -->

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header border-0 align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Statistiques de Gains</h4>
                                        </div><!-- end card header -->


                                        <div class="card-body p-0 pb-2">
                                            <div>
                                                <div id="projects-overview-chart2" data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' dir="ltr" class="apex-charts"></div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end col -->


            </div><!-- end row -->

            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1 py-1">Listes des Réservations éffectuées</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted">All Tasks <i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">All Tasks</a>
                                        <a class="dropdown-item" href="#">Completed </a>
                                        <a class="dropdown-item" href="#">Inprogress</a>
                                        <a class="dropdown-item" href="#">Pending</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-nowrap table-centered align-middle mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col">Utilisateur</th>
                                            <th scope="col">Dedline</th>
                                            <th scope="col">Montant</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Assignee</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @if($list_commandes && count($list_commandes)>0)
                                        @foreach($list_commandes as $commande)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label ms-1" for="checkTask1">
                                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mary Stoner">
                                                            <img src="{{ $commande->user()->first()->photo_url ?? "https://ui-avatars.com/api/?name=".$commande->user()->first()->username }}" alt="" class="rounded-circle avatar-xxs">
                                                        </a>
                                                        {{$commande->user()->first()->username}}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-muted">{{ $commande->date_fin->format('d, M Y h:i') }}</td>
                                            <td>{{ number_format($commande->montant , 0, ',', '.') }} fcfa</td>
                                            <td>
                                                @if($commande->status == "en attente")
                                                <span class="badge badge-soft-warning">{{$commande->status}}</span>
                                                @elseif($commande->status == "TERMINEE")
                                                <span class="badge badge-soft-success">Completed</span>
                                                @elseif($commande->status == "ANNULER")
                                                <span class="badge badge-soft-danger">Annuler</span>
                                                @elseif($commande->status == "VALIDEE")
                                                <span class="badge badge-soft-info">Valider</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-soft-primary">
                                                    <i class="ri-user-2-line me-1"></i>
                                                    détails</button>
                                            </td>
                                        </tr><!-- end -->
                                        @endforeach
                                        @endif
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                            <div class="mt-3 text-center">

                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->


            </div><!-- end row -->




        </div>
    </div>
</div>


@push('scripts')
 <!-- apexcharts -->
 <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

 <!-- projects js -->
 <script src="{{ asset('assets/js/pages/dashboard-projects.init.js') }}"></script>
@endpush







@push('scripts')


<script>


var graph_all_order = @json($stats_by_all_month);
var graph_finish_order = @json($stats_by_month_effectuer);
var graph_pending_order = @json($stats_by_month_pending);



    //Formate moi ce code JS ci dessous
    function getChartColorsArray(e) {
  if (null !== document.getElementById(e)) {
    var t = document.getElementById(e).getAttribute('data-colors');
    if (t)
      return (t = JSON.parse(t)).map(function (e) {
        var t = e.replace(' ', '');
        return -1 === t.indexOf(',')
          ? getComputedStyle(document.documentElement).getPropertyValue(t) || t
          : 2 == (e = e.split(',')).length
          ? 'rgba(' +
            getComputedStyle(document.documentElement).getPropertyValue(e[0]) +
            ',' +
            e[1] +
            ')'
          : t;
      });
    console.warn('data-colors Attribute not found on:', e);
  }
}
var options,
  chart,
  linechartcustomerColors = getChartColorsArray('projects-overview-chart2'),
  isApexSeriesData =
    (linechartcustomerColors &&
      ((options = {
        series: [
          {
            name: 'Gains Générale',
            type: 'bar',
            data: [
                graph_all_order.janvier,
                graph_all_order.fevrier,
                graph_all_order.mars,
                graph_all_order.avril,
                graph_all_order.mai,
                graph_all_order.juin,
                graph_all_order.juillet,
                graph_all_order.aout,
                graph_all_order.septembre,
                graph_all_order.octobre,
                graph_all_order.novembre,
                graph_all_order.decembre,
            ],
          },
          {
            name: 'En Attente',
            type: 'area',
            data: [
                graph_pending_order.janvier,
                graph_pending_order.fevrier,
                graph_pending_order.mars,
                graph_pending_order.avril,
                graph_pending_order.mai,
                graph_pending_order.juin,
                graph_pending_order.juillet,
                graph_pending_order.aout,
                graph_pending_order.septembre,
                graph_pending_order.octobre,
                graph_pending_order.novembre,
                graph_pending_order.decembre,
            ],
          },
          {
            name: 'Terminer',
            type: 'bar',
            data: [
                graph_finish_order.janvier,
                graph_finish_order.fevrier,
                graph_finish_order.mars,
                graph_finish_order.avril,
                graph_finish_order.mai,
                graph_finish_order.juin,
                graph_finish_order.juillet,
                graph_finish_order.aout,
                graph_finish_order.septembre,
                graph_finish_order.octobre,
                graph_finish_order.novembre,
                graph_finish_order.decembre,
            ],
          },
        ],
        chart: { height: 374, type: 'line', toolbar: { show: !1 } },
        stroke: { curve: 'smooth', dashArray: [0, 3, 0], width: [0, 1, 0] },
        fill: { opacity: [1, 0.1, 1] },
        markers: { size: [0, 4, 0], strokeWidth: 2, hover: { size: 4 } },
        xaxis: {
          categories: [
            'Jan',
            'Fev',
            'Mar',
            'Avr',
            'Mai',
            'Jun',
            'Jul',
            'Aou',
            'Sep',
            'Oct',
            'Nov',
            'Dec',
          ],
          axisTicks: { show: !1 },
          axisBorder: { show: !1 },
        },
        grid: {
          show: !0,
          xaxis: { lines: { show: !0 } },
          yaxis: { lines: { show: !1 } },
          padding: { top: 0, right: -2, bottom: 15, left: 10 },
        },
        legend: {
          show: !0,
          horizontalAlign: 'center',
          offsetX: 0,
          offsetY: -5,
          markers: { width: 9, height: 9, radius: 6 },
          itemMargin: { horizontal: 10, vertical: 0 },
        },
        plotOptions: { bar: { columnWidth: '30%', barHeight: '70%' } },
        colors: linechartcustomerColors,
        tooltip: {
          shared: !0,
          y: [
            {
              formatter: function (e) {
                return void 0 !== e ? e.toFixed(0) : e;
              },
            },
            {
              formatter: function (e) {
                return void 0 !== e ?  e.toFixed(2)  : e;
              },
            },
            {
              formatter: function (e) {
                return void 0 !== e ? e.toFixed(0) : e;
              },
            },
          ],
        },
      }),
      (chart = new ApexCharts(
        document.querySelector('#projects-overview-chart2'),
        options
      )).render()),
    {}),
  isApexSeries = document.querySelectorAll('[data-chart-series]'),
  donutchartProjectsStatusColors =
    (isApexSeries &&
      Array.from(isApexSeries).forEach(function (e) {
        var t,
          e = e.attributes;
        e['data-chart-series'] &&
          ((isApexSeriesData.series = e['data-chart-series'].value.toString()),
          (t = getChartColorsArray(e.id.value.toString())),
          (t = {
            series: [isApexSeriesData.series],
            chart: {
              type: 'radialBar',
              width: 36,
              height: 36,
              sparkline: { enabled: !0 },
            },
            dataLabels: { enabled: !1 },
            plotOptions: {
              radialBar: {
                hollow: { margin: 0, size: '50%' },
                track: { margin: 1 },
                dataLabels: { show: !1 },
              },
            },
            colors: t,
          }),
          new ApexCharts(
            document.querySelector('#' + e.id.value.toString()),
            t
          ).render());
      }),
    getChartColorsArray('prjects-status1')),
  currentChatId =
    (donutchartProjectsStatusColors &&
      ((options = {
        series: [125, 42, 58, 89],
        labels: ['Completed', 'In Progress', 'Yet to Start', 'Cancelled'],
        chart: { type: 'donut', height: 230 },
        plotOptions: {
          pie: {
            size: 100,
            offsetX: 0,
            offsetY: 0,
            donut: { size: '90%', labels: { show: !1 } },
          },
        },
        dataLabels: { enabled: !1 },
        legend: { show: !1 },
        stroke: { lineCap: 'round', width: 0 },
        colors: donutchartProjectsStatusColors,
      }),
      (chart = new ApexCharts(
        document.querySelector('#prjects-status1'),
        options
      )).render()),
    'users-chat');
function scrollToBottom(r) {
  setTimeout(function () {
    var e = document
        .getElementById(r)
        .querySelector('#chat-conversation .simplebar-content-wrapper')
        ? document
            .getElementById(r)
            .querySelector('#chat-conversation .simplebar-content-wrapper')
        : '',
      t = document.getElementsByClassName('chat-conversation-list')[0]
        ? document
            .getElementById(r)
            .getElementsByClassName('chat-conversation-list')[0].scrollHeight -
          window.innerHeight +
          850
        : 0;
    t && e.scrollTo({ top: t, behavior: 'smooth' });
  }, 100);
}
scrollToBottom(currentChatId);


</script>

@endpush
