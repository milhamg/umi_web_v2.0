<!-- Id Field -->
{{-- <div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $business->id }}</p>
</div> --}}

<!-- Id User Field -->
<div class="col-sm-12">
    {!! Form::label('id_user', 'Nama Pemilik:') !!}
    <p>{{ $business->users->name }}</p>
</div>

<!-- Id Master Status Usaha Field -->
<div class="col-sm-12">
    {!! Form::label('id_master_status_usaha', 'Status Usaha:') !!}
    <p>{{ $business->masterStatusBusinesses->nama_status_usaha }}</p>
</div>

<!-- Nama Usaha Field -->
<div class="col-sm-12">
    {!! Form::label('nama_usaha', 'Nama Usaha:') !!}
    <p>{{ $business->nama_usaha }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $business->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $business->updated_at }}</p>
</div>

