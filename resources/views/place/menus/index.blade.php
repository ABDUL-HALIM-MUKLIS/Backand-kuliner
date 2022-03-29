<x-template.default>
    @push('extra-style')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
    @endpush

    <x-slot name="title">Menu Kuliner {{ $place->name }}</x-slot>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('menu.create', $place) }}" class="btn btn-primary">+ Tambah Menu Kuliner</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped" >
                    <thead>
                        <tr>
                            <th  scope="col">ID</th>
                            <th  scope="col">Name</th>
                            <th  scope="col">Gambar</th>
                            <th  scope="col">Deskripsi</th>
                            <th  scope="col">Harga</th>
                            <th  scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/shield-x -->
	        <svg xmlns="http://www.w3.org/2000/svg" class="mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>
            <h3>Are you sure to delete data ?</h3>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="conformDelete">Delete</button>
            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">Close</button>
        </div>
        </div>
    </div>
    </div>

    @push('extra-script')
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="crossorigin=""></script>
        <script>
            $(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('menu.index',request()->segment(2)) !!}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false },
                        { data: 'name', name: 'name' },
                        { data: 'image', name: 'image' },
                        { data: 'description', name: 'description' },
                        { data: 'price', name: 'price' },
                        { data: 'action', name: 'action' }
                    ]
                });
            });


            $('#dataTable').on('click','a#delete', function(e){
                e.preventDefault()
                var id = $(this).data('id')
                $('#conformDelete').attr('data-id',id)
                $('#deleteModal').modal('show')
            });

            $('#conformDelete').click(function(e){
                e.preventDefault()
                var id = $(this).data('id')
                $.ajax({
                    type: 'DELETE',
                    url: 'place/'+id+'/menu',
                    data: {
                        '_token': "{{csrf_token()}}"
                    },
                    success: function(respone) {
                        window.location.href = '/place'
                    },
                })
            });
        </script>
    @endpush
</x-template.default>