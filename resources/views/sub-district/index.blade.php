<x-template.default>
    
    @push('extra-style')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
    @endpush
    
    <x-slot name="title">Kecamatan</x-slot>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Data Kecamatan Siduarajo</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @push('extra-script')
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>

        <script>
            $(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('subdistrict.index') !!}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false },
                        { data: 'name', name: 'name' },
                        { data: 'slug', name: 'slug' }
                    ]
                });
            });
        </script>
    @endpush
</x-template.default>