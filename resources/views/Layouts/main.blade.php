<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" as="style"/>
 <link href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('Layouts.Partials.sidebar')
        <div class="body-wrapper">
            @include('Layouts.Partials.navbar')
            <div class="container-fluid">
                <div class="content">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">@yield('sub-title')</h5>
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </div>
                <div class="py-6 px-6 text-center ">
                    <p class="mb-0 fs-4">Design and Developed by <a href="https://www.instagram.com/wdnchill/"
                            target="_blank" class="pe-1 text-primary text-decoration-underline">wildan firdaus</a></p>
                </div>
            </div>
        </div>
    </div>
     <script rel="preload" src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}" as="script"></script>
    <script rel="preload" src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}" as="script"></script>
    <script rel="preload" src="{{ asset('assets/js/sidebarmenu.js') }}" as="script"></script>
    <script  src="{{ asset('assets/js/app.min.js') }}" defer></script>
    <script rel="preload" src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}" as="script"></script>
    <script rel="preload" src="{{ asset('assets/js/dashboard.js') }}" as="script"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
    $('#tabledata').DataTable({
        responsive: true,
        lengthChange: false,
        searching: true,
        paging: true,
        ordering: false,
        info : false,
        dom: 'Bfrtip',
        language: {
            emptyTable: "Data belum di masukan, silahkan input data terlebih dahulu."
        },
        columnDefs:[{
            targets:-1,
            className:'noExport'
        }],
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ":visible:not(.noExport)"
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ":visible:not(.noExport)"
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ":visible:not(.noExport)"
                }
            }
        ]
    });
});
    $(document).ready(function() {
        $(document).on('click', '.show-alert-delete-box', function(event) {
            var form = $(this).closest("form");

            event.preventDefault();
            Swal.fire({
                title: "Peringatan",
                text: "Apakah kamu ingin menghapus data ini jika data ini, data akan terhapus permanen?",
                icon: "warning",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                showCancelButton: true,
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.show-alert-submit-box', function(event) {
            var form = $(this).closest("form");

            event.preventDefault();
            Swal.fire({
                title: "Peringatan",
                text: "Apakah kamu yakin ingin simpan data ini?",
                icon: "info",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                showCancelButton: true,
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    function modal_logout() {
    Swal.fire({
        title: 'Peringatan',
        text: 'Apakah kamu yakin ingin logout?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Iya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            
            window.location.href = "{{ route('logout') }}";
        } else {
           
            return false;
        }
    });
}

function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('preview-image');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

</script>
</body>

</html>
