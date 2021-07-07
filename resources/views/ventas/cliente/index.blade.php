@extends ('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de clientes</h3>
			<a href="cliente/create"><button class="btn btn-primary">Nuevo</button></a>
			@include('almacen/articulo/search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Tipo Doc.</th>
						<th>Num Doc.</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Opciones</th>
					</thead>
					@foreach($personas as $persona)
					<tr>
						<td>{{$persona->idpersona}}</td>
						<td>{{$persona->nombre}}</td>
						<td>{{$persona->tipo_documento}}</td>
						<td>{{$persona->num_documento}}</td>
						<td>{{$persona->telefono}}</td>
						<td>{{$persona->email}}</td>
						<td>
							<a href="cliente/{{$persona->idpersona}}/edit"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$persona->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('ventas.cliente.modal')
					@endforeach
				</table>
			</div>
			
		</div>
	</div>
@endsection