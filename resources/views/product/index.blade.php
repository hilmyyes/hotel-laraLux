@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Products</h1>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <a class="btn btn-success" href="{{ route('product.create') }}">+ New Product</a>
        <!-- DataTales Example -->
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    @foreach ($rs as $p)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm" id="tr_{{ $p->id }}">
                                @if ($p->filenames)
                                    @foreach ($p->filenames as $filename)
                                        <img src="{{ asset('products/' . $p->id . '/' . $filename) }}" /><br>
                                    @endforeach
                                @endif
                                <img src="{{ asset('img/' . $p->image) }}" alt="">
                                <div class="card-body">
                                    <a href="#" onclick="showProduct({{ $p->id }})">
                                        <h5 class="card-title">{{ $p->name }}</h5>
                                    </a>
                                    <h7>{{ $p->hotel->name }}</h7>
                                    <p class="card-text">{{ $p->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-outline-secondary"
                                                href="{{ route('product.edit', $p->id) }}">Edit</a>

                                            <form method="POST" action="{{ route('product.destroy', $p->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    onclick="return confirm('Are you sure to delete {{ $p->id }} - {{ $p->name }} ? ');">
                                            </form>
                                        </div>
                                        <small class="text-muted">Price: {{ $p->price }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Show Product Modal -->
    <div class="modal fade" id="modalShowProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Konten modal akan diisi melalui AJAX -->
                    <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading..."
                        style="width: 100px;">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        // Fungsi untuk melakukan AJAX request dan menampilkan detail produk dalam modal
        function showProduct(product_id) {
            $.ajax({
                type: 'GET',
                url: '{{ route('product.show', ':id') }}'.replace(':id', product_id),
                success: function(data) {
                    $('#modalContent').html(data); // Mengisi konten modal dengan hasil dari AJAX
                    $('#modalShowProduct').modal('show'); // Menampilkan modal
                }
            });
        }
    </script>
@endsection
