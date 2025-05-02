<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Grace Creations')</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
</head>
<style>
    .page-body-wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      width: 100%;
      padding-top: 50px;
      margin-top: 10px;
  }

  .table-img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 5px;
  }

  .btn-sm {
      padding: 4px 8px;
      font-size: 14px;
  }
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table th,
    .table td {
    white-space: normal; /* Laisse le contenu aller à la ligne */
    }
    .main-panel{
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    width: 100%;
    padding-top: 50px;
    margin-top: 10px;
  }
  .pagination {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 5px;
    margin-top: 20px;
  }

  .pagination a,
  .pagination span {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    border: 1px solid #ddd;
    margin: 0 4px;
    border-radius: 4px;
  }

  .pagination .active span {
    background-color:rgb(113, 187, 169);
    color: white;
    border: 1px solid rgb(113, 187, 169);
  }

  .pagination a:hover:not(.active) {
    background-color: #ddd;
  }
</style>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

     <!-- Wrapper pour sidebar et contenu principal -->
     <div class="layout-wrapper" style="display: flex;">
        <!-- Sidebar -->
        <div class="sidebar" style="flex: 0 0 250px;">
            @include('partials.sidebar')
        </div>

        <!-- Contenu principal -->
        <div class="main-content" style="flex: 1; padding: 20px;">
            @yield('content')
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    
    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!-- JavaScript de Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#produits_associes').select2({
                placeholder: "Choisissez un ou plusieurs produits associés",
                allowClear: true
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const promotionSelect = document.getElementById('promotion');
            const promoPriceContainer = document.getElementById('promo_price_container');
            const promoPriceInput = document.getElementById('promo_price');

            function togglePromoPriceField() {
                if (promotionSelect.value === '1') {
                    promoPriceContainer.style.display = 'block';
                    promoPriceInput.removeAttribute('disabled');
                } else {
                    promoPriceContainer.style.display = 'none';
                    promoPriceInput.setAttribute('disabled', 'disabled');
                    promoPriceInput.value = ''; // Clear the input if disabled
                }
            }

            // Attach event listener to toggle the field on change
            promotionSelect.addEventListener('change', togglePromoPriceField);

            // Initialize the field on page load
            togglePromoPriceField();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const packSelect = document.getElementById('pack');
            const produitsAssociesContainer = document.getElementById('produits_associes_container');

            function toggleProduitsAssociesField() {
                if (packSelect.value === '1') {
                    produitsAssociesContainer.style.display = 'block';
                } else {
                    produitsAssociesContainer.style.display = 'none';
                }
            }

            // Attach event listener to toggle the field on change
            packSelect.addEventListener('change', toggleProduitsAssociesField);

            // Initialize the field on page load
            toggleProduitsAssociesField();
        });
    </script>
    <script>
        // Initialisation de selectpicker
        $(document).ready(function() {
            $('.selectpicker').selectpicker();
        });

        // Gestion des produits sélectionnés
        $('#add-to-pack').on('click', function() {
            const selectedProducts = $('#produits_associes').val(); // Récupération des IDs sélectionnés
            const productNames = $('#produits_associes option:selected').map(function() {
                return $(this).text();
            }).get(); // Récupération des noms sélectionnés

            $('#product-list').empty(); // Nettoyer la liste avant d'ajouter de nouveaux éléments
            selectedProducts.forEach((id, index) => {
                $('#product-list').append(`<li>${productNames[index]}</li>`);
            });

            // Mettre à jour l'input caché avec les IDs sélectionnés
            $('#hidden-pack-products').val(selectedProducts.join(','));
        });
    </script>

</body>
</html>
