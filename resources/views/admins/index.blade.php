@extends ('layouts.admin')

@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Administradores</h3>
			<a href="{{ route('admins.create') }}"><button class="btn btn-primary">Nuevo</button></a>
			@include('almacen/articulo/search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
                @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>

                @endif
				<table class="table table-striped table-bordered table-condensed">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>E-mail</th>
					</thead>
					@foreach($admins as $admin)
					<tr>
						<td>{{$admin->id}}</td>
						<td>{{$admin->name}}</td>
						<td>{{$admin->email}}</td>
						<td>
							<a href="admins/{{$admin->id}}/edit"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$admin->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@endforeach
				</table>
			</div>

		</div>
	</div>
@endsection
