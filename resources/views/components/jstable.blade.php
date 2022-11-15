<table
    data-toggle="table"
    data-pagination="true"
    data-search="true">
    <thead>
    <tr>
        <th data-sortable="true" data-field="id">ID</th>
        <th data-sortable="true" data-field="name">Name</th>
        <th data-sortable="true" data-field="Description">Description</th>
        <th data-sortable="true" data-field="Url">Url address</th>
        <th>Action</th>

    </tr>
    </thead>
    <tbody>
    {{ $slot }}
    </tbody>
</table>
