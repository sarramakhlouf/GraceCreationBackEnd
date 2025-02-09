@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/imgs/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Products <i class="mdi mdi-chart-line mdi-24px float-end"></i></h4>
                        <h2 class="mb-5">{{ number_format($totalProducts) }}</h2> <!-- Display total products -->
                        <h6 class="card-text">Total available products in stock</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/imgs/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Orders <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i></h4>
                        <h2 class="mb-5">{{ number_format($totalOrders) }}</h2> <!-- Display the total orders -->
                        <h6 class="card-text">Updated in real-time</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/imgs/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Clients <i class="mdi mdi-diamond mdi-24px float-end"></i></h4>
                        <h2 class="mb-5">{{ number_format($totalClients) }}</h2> <!-- Display total distinct clients -->
                        <h6 class="card-text">Number of registered clients</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Statistiques des Commandes</h4>
                        <canvas id="orders-chart" class="mt-4"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Statistiques des Produits</h4>
                        <div class="doughnutjs-wrapper d-flex justify-content-center">
                            <canvas id="products-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
  .main-panel{
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    width: 100%;
    padding-top: 50px;
    margin-top: 10px;
  }
  .content-wrapper {
    width: 100%;
    padding-top: 50px;
    margin-top: 10px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctxorder = document.getElementById('orders-chart').getContext('2d');
    var chart = new Chart(ctxorder, {
        type: 'bar', // Type de graphique : 'pie', 'bar', 'line'...
        data: {
            labels: ['Validées', 'Annulées', 'En attente'],
            datasets: [{
                label: 'Nombre de Commandes',
                data: [{{ $validatedOrders }}, {{ $canceledOrders }}, {{ $pendingOrders }}],
                backgroundColor: ['#ff69b4', '#8a2be2', '#00bfff'],
                borderColor: ['#ffffff', '#ffffff', '#ffffff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique des produits en stock et en rupture
    var ctxProducts = document.getElementById('products-chart').getContext('2d');
    var productsChart = new Chart(ctxProducts, {
        type: 'doughnut',
        data: {
            labels: ['En Stock', 'Rupture de Stock'],
            datasets: [{
                label: 'Nombre de Produits',
                data: [{{ $productsInStock }}, {{ $productsOutOfStock }}],
                backgroundColor: ['#17a2b8', '#dc3545'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
