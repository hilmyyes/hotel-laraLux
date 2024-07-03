<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light"
                        data-mdb-ripple-color="light">
                        <img src="{{ asset('img/' . $data->image) }}" class="img-fluid" alt="">
                        <a href="#!">
                            <div class="mask"></div>
                        </a>
                    </div>
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between">
                            <h3>Detail Produk Hotel</h3>
                        </div><br>
                        <div>
                            <h5>Nama Produk: {{ $data->name }}</h5>
                            <h5>Dimiliki Hotel: {{ $data->hotel->name }}</h5>
                            <h5>Tarif: Rp. {{ $data->price }}</h5>
                            @if ($data->facilities && $data->facilities->isNotEmpty())
                                <h5>Fasilitas:</h5>
                                <ul>
                                    @foreach ($data->facilities as $d)
                                        <li>{{ $d->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
