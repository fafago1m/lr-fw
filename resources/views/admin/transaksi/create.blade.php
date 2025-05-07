<div class="row p-2">
    <div class="col-md-6">
    <div class="card">
    <div class="card-body">
    <div class="row mt-1">
    <div class="col-md-4">
    <label for="">Kode Produk</label>
    </div>
    <div class="col-md-8">
    <form method="GET">
    <div class="d-flex">
    <select name="produk_id" class="form-
    control" id="">
    <option value="">--{{isset($p_detail) ? $p_detail->name : 'Nama Produk'}}--</option>
    @foreach($produk as $item)
    <option value="{{ $item->id }}">{{$item->id.' - '. $item->name}}</option>
    @endforeach
    </select>
    <button type="submit" class="btn btn-
    primary">Pilih</button>
    </div>
    </form>
    </div>
    </div>
    <form action="/admin/transaksi/detail/create"method="POST">
    @csrf
    <input type="hidden" name="transaksi_id" value="{{Request::segment(3) }}">
    <input type="hidden" name="produk_id" value="{{isset($p_detail) ? $p_detail->id : '' }}">
    <input type="hidden" name="produk_name" value="{{isset($p_detail) ? $p_detail->name : '' }}">
    <input type="hidden" name="subtotal" value="{{$subtotal }}">
    <div class="row mt-1">
    <div class="col-md-4">
    <label for="">Nama Produk</label>
    </div>
    <div class="col-md-8">
    <input type="text" value="{{isset($p_detail) ? $p_detail->name : ''}}" class="form-control" disabled="nama_produk">
    </div>
    </div>
    <div class="row mt-1">
    <div class="col-md-4">
    <label for="">Harga Satuan</label>
    </div>
    <div class="col-md-8">
    <input type="text" value="{{isset($p_detail) ? $p_detail->harga : ''}}" class="form-control" disabled
    name="harga_satuan">
    </div>
    </div>
    <div class="row mt-1">
    <div class="col-md-4">
    <label for="">QTY</label>
    </div>
    <div class="col-md-8">
    <div class="d-flex">
    <a href="?produk_id={{
    request('produk_id') }}&act=min&qty={{ $qty }}" class="btn btn-primary"><i
    class="fas fa-minus"></i></a>
    <input type="number" value="{{ $qty }}"
    id="qty" class="form-control" name="qty">
    <a href="?produk_id={{
    request('produk_id') }}&act=plus&qty={{ $qty }}" class="btn btn-
    primary"><i class="fas fa-plus"></i></a>
    </div>
    </div>
    </div>
    <div class="row mt-1">
    <div class="col-md-4">
    </div>
    <div class="col-md-8">
    <h5>Sub Total : Rp. {{$subtotal}}</h5>
    </div>
    </div>
    <div class="row mt-1">
    <div class="col-md-4">
    </div>
    <div class="col-md-8">
    <a href="/admin/transaksi" class="btn btn-
    info"><i class="fas fa-arrow-left"></i>Kembali</a>
    <button type="submit" class="btn btn-
    primary">Tambah<i class="fas fa-arrow-right"></i></button>
    </div>
    </div>
    </form>
    </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="card">
    <div class="card-body">
    <table class="table">
    <tr>
    <th>No</th>
    <th>Nama Produk</th>
    <th>Qty</th>
    <th>Subtotal</th>
    <th>#</th>
    </tr>
    @foreach ($transaksi_detail as $item)
    <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{$item->produk_name}}</td>
    <td>{{$item->qty}}</td>
    <td>{{$item->subtotal}}</td>
    <td>
    <a href=""><i class="fas fa-times"></i></a>
    </td>
    </tr>
    @endforeach
    </table>
    <a href="" class="btn btn-success"><i class="fas fa-
    check"></i>Selesai</a>
    <a href="" class="btn btn-info"><i class="fas fa-
    file"></i>Pending</a>
    </div>
    </div>
    </div>
    </div>
    <div class="row p-2">
    <div class="col-md-6">
    <div class="card">
    <div class="card-body">
    <form action="" method="GET">
    <div class="form-group">
    <label for="">Total Belanja</label>
    <input type="number" value="{{$transaksi->total}}"
    name="total_belanja" class="form-control" id="">
    </div>
    <div class="form-group">
    <label for="">Dibayarkan</label>
    <input type="number" name="dibayarkan"
    value="{{request('dibayarkan')}}" class="form-control" id="">
    </div>
    <button type="submit" class="btn btn-primary btn-
    block">Hitung</button>
    </form>
    <hr>
    <div class="form-group">
    <label for="">Uang Kembalian</label>
    <input type="number" value="{{ $kembalian }}" disabled
    name="kembalian" class="form-control" id="">
    </div>
    </div>
    </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center" style="font-size: 20px; font-weight: bold;">Bukti Transaksi</h5>
                <div class="receipt" id="receipt" class="p-3 border rounded shadow-sm" style="max-width: 400px; margin: auto; font-family: Arial, sans-serif; background: #fff; padding: 20px;">
                    <h6 class="text-center" style="font-size: 18px; margin-bottom: 5px; font-weight: bold;">Toko Fafa</h6>
                    <p class="text-center" style="font-size: 14px; margin-bottom: 5px;">Jl. Contoh No. 123</p>
                    <p class="text-center" style="font-size: 12px; margin-bottom: 10px;">Telp: 0812-3456-7890</p>
                    <hr style="border-top: 2px dashed #000;">
                    <p><strong>Total Belanja:</strong> Rp. {{$transaksi->total}}</p>
                    <p><strong>Dibayarkan:</strong> Rp. {{request('dibayarkan')}}</p>
                    <p><strong>Uang Kembalian:</strong> Rp. {{ $kembalian }}</p>
                    <hr style="border-top: 2px dashed #000;">
                    <table class="table table-bordered text-center" style="font-size: 14px; border-collapse: collapse; width: 100%;">
                        <thead style="background-color: #f8f9fa; font-weight: bold;">
                            <tr>
                                <th style="padding: 5px;">No</th>
                                <th style="padding: 5px;">Nama Produk</th>
                                <th style="padding: 5px;">Qty</th>
                                <th style="padding: 5px;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi_detail as $item)
                            <tr>
                                <td style="padding: 5px;">{{ $loop->iteration }}</td>
                                <td style="padding: 5px;">{{$item->produk_name}}</td>
                                <td style="padding: 5px;">{{$item->qty}}</td>
                                <td style="padding: 5px;">Rp. {{$item->subtotal}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr style="border-top: 2px dashed #000;">
                    <p class="text-center" style="font-size: 14px; font-weight: bold;">Terima kasih telah berbelanja!</p>
                </div>
                <button onclick="printReceipt()">Cetak Struk</button>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #print-area, #print-area * {
            visibility: visible;
        }
        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background: #fff;
            padding: 20px;
            page-break-before: always;
        }
        @page {
            margin: 10mm;
        }
        a[href]:after {
            content: none !important;
        }
    }
</style>

<script>
    function printReceipt() {
        var printContents = document.getElementById("receipt").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>



    </div>
    
   
        