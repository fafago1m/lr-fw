<div class="container-fluid pt-2">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5><b>{{$title}}</b></h5>
                    <a href="/admin/user/create" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah</a>

                    @if(session()->has('success'))

                        <div class="alert alert-success mt-2"><i class="fas fa-check"></i>
                            @include('sweetalert::alert')
                        </div>
                    @endif


                    <table class="table mt-1">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($user as $item)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->getRoleNames()->implode(', ') }}</td>

                            <td>
                                <div class="d-flex">
                                    <a href="/admin/user/{{$item->id}}/edit" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <!--<a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>-->
                                    <form action="/admin/user/{{$item->id}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-denger btn-sm ml-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>