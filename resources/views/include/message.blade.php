@php
    $type = '';
    $message = '';
    if (session('simpan')) {
        $type = 'success';
        $message = session('simpan');
    } elseif (session('ubah')) {
        $type = 'info';
        $message = session('ubah');
    } elseif (session('hapus')) {
        $type = 'error';
        $message = session('hapus');
    } elseif (session('error')) {
        $type = 'error';
        $message = session('error');
    }
@endphp

@if ($type)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '{{ $type }}',
                title: '{{ $message }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
            });
        });
    </script>
@endif
