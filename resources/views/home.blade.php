@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Zoznam kníh</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="api/json" class="btn btn-info">JSON</a>

            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-primary">
                Pridať knihu
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="books" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Názov knihy</th>
                    <th>ISBN</th>
                    <th>Cena</th>
                    <th>Kategória</th>
                    <th>Autor</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{$book->id}}</td>
                        <td>{{$book->title}}</td>
                        <td>{{$book->isbn}}</td>
                        <td>{{$book->price}}</td>
                        <td>{{$book->category->name}}</td>
                        <td>{{$book->author->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pridanie knihy</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="{{route('create')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="title">Názov knihy</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Názov knihy">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" class="form-control" id="isbn" name="isbn"
                                           placeholder="ISBN">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price">Cena</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                           placeholder="Cena" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Kategória</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="author_id">Autor</label>
                                    <input type="text" class="form-control" id="author_id" name="author_id"
                                           placeholder="Autor">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zavrieť</button>
                        <button type="submit" class="btn btn-primary">Uložiť</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $("#books").DataTable({
                "responsive": true,
                "autoWidth": false,
                'language': {
                    'url': 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Slovak.json',
                },
                "columnDefs": [
                    {"orderable": false, "targets": [0, 1, 2, 4, 5]},
                    {"orderSequence": ["asc"], "targets": [3]},
                ],
                'searching': false,
                "lengthChange": false,
            });
            $("#author_id").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: 'api/author',
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function (data) {
                            console.log(data)
                            response(data);

                        }
                    });
                },
                minLength: 1,
                appendTo: ".modal-body"
            });
        });
        $(function () {
            @if(Session::has('message'))
            var type = "{{Session::get('alert-type','info')}}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
            @endif
        })
    </script>
@endsection

