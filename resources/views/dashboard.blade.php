@extends('layouts.main')

@section('title', 'Tableau de bord')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Tableau de bord
            </h3>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="assets/imgs/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Total Des Produits <i class="mdi mdi-chart-line mdi-24px float-end"></i></h4>
                            <h2 class="mb-5">{{ number_format($totalProducts) }}</h2> 
                            <h6 class="card-text">Total Des Produits Disponibles En Stock</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">
                            <img src="assets/imgs/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Total Des Commandes <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i></h4>
                            <h2 class="mb-5">{{ number_format($totalOrders) }}</h2> 
                            <h6 class="card-text">Mise à jour en temps réel</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <img src="assets/imgs/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Total Des Clients <i class="mdi mdi-diamond mdi-24px float-end"></i></h4>
                            <h2 class="mb-5">{{ number_format($totalClients) }}</h2>
                            <h6 class="card-text">Nombre De Clients Enregistrés</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Statistiques des Commandes</h4>
                            <canvas id="orders-chart" class="mt-4"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Statistiques des Produits</h4>
                            <div class="d-flex justify-content-center">
                                <canvas id="products-chart"></canvas>
                            </div>
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
  .dashboard-content {
    transition: margin-left 0.3s ease;
  }
  .navbar-visible .dashboard-content {
    margin-left: 15%;
  }
  .navbar-hidden .dashboard-content {
    margin-left: 5%;
  }
  @media (max-width: 768px) {
    .grid-margin {
        margin-bottom: 15px;
    }
    .navbar-visible .dashboard-content, .navbar-hidden .dashboard-content {
        margin-left: 0;
    }
  }
</style>
<script>
    function adjustDashboardPosition() {
        let dashboard = document.querySelector('.dashboard-content');
        let navbar = document.querySelector('.navbar');
        if (navbar && window.getComputedStyle(navbar).display !== 'none') {
            dashboard.classList.add('navbar-visible');
            dashboard.classList.remove('navbar-hidden');
        } else {
            dashboard.classList.add('navbar-hidden');
            dashboard.classList.remove('navbar-visible');
        }
    }
    
    document.addEventListener("DOMContentLoaded", adjustDashboardPosition);
    window.addEventListener("resize", adjustDashboardPosition);
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctxorder = document.getElementById('orders-chart').getContext('2d');
    var chart = new Chart(ctxorder, {
        type: 'bar',
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
