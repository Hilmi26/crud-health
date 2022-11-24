@include('layouts.app')

<div class="container py-5">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formtambah">
        Tambah artikel
    </button>
    {{-- Model Form Tambah --}}
    <div class="modal fade" id="formtambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="formtambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formUpdate">artikel</h5>
                    <button type="button" class="rounded" style="width: 34px; border: 1px solid"
                        data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="/artikel" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="col mb-2">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control ">
                        </div>
                        <div class="col mb-2">
                            <label>foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="col mb-2">
                            <label>isi</label>
                            <textarea type="text" name="isi" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col mb-2">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary me-2">Tambah artikel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Foto</th>
                <th>Isi</th>
                <th>Kategori</th>
                <th>Tanggal Artikel</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artikel as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td><img src="{{ asset('/') }}storage/{{ $item->foto }}" alt="" style="width:100px"></td>
                    <td>{{ $item->isi }}</td>
                    <td>{{ $item->Kategori->kategori }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <button type="button" class="btn btn-md btn-dark" style="width: 80px" data-bs-toggle="modal"
                            data-bs-target="#formUpdate{{ $item->id }}">
                            Edit
                        </button>
                        <form action="/artikel/{{ $item->id }}" method="post" style="display: inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-md btn-danger" style="width: 80px"
                                onclick="return confirm ('Yakin akan menghapus data?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Model Form Update --}}
                <div class="modal fade" id="formUpdate{{ $item->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="formUpdate" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="formUpdate">Edit artikel</h5>
                                <button type="button" class="rounded" style="width: 34px; border: 1px solid"
                                    data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <form action="/artikel/{{ $item->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="col mb-2">
                                        <label>Judul</label>
                                        <input type="text" name="judul" class="form-control "
                                            value="{{ $item->judul }}">
                                    </div>
                                    <div class="col mb-2">
                                        <label>Gambar</label>
                                        <br>
                                        <img src="{{ asset('/') }}storage/{{ $item->foto }}" alt="" width="100px" class="mb-2">
                                        <input type="file" name="foto" class="form-control"
                                            >
                                    </div>
                                    <div class="col mb-2">
                                        <label>Isi</label>
                                        <textarea name="isi" id="" cols="30" rows="10" class="form-control">{{ $item->isi }}</textarea>
                                    </div>
                                    <div class="col mb-2">
                                        <label for="">Kategori</label>
                                        <select name="kategori_id" id="" class="form-control">
                                            <option value="{{ $item->id }}">{{ $item->Kategori->kategori }}</option>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $data)
                                                <option value="{{ $data->id }}">{{ $data->kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
