@extends ('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<a href="categoria/create"><button class="btn btn-primary">Nuevo</button></a>
			@include('almacen/categoria/search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Opciones</th>
					</thead>
					@foreach($categoria as $cat)
					<tr>
						<td>{{$cat->idcategoria}}</td>
						<td>{{$cat->nombre}}</td>
						<td>{{$cat->descripcion}}</td>
						<td>
							<a href="categoria/{{$cat->idcategoria}}/edit"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('almacen.categoria.modal')
					@endforeach
				</table>
			</div>
			
		</div>
	</div>
@endsection