@extends ('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de articulos</h3>
			<a href="articulo/create"><button class="btn btn-primary">Nuevo</button></a>
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
						<th>Codigo</th>
						<th>Categoria</th>
						<th>Stock</th>
						<th>Imagen</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
					@foreach($articulos as $articulo)
					<tr>
						<td>{{$articulo->idarticulo}}</td>
						<td>{{$articulo->nombre}}</td>
						<td>{{$articulo->codigo}}</td>
						<td>{{$articulo->categoria}}</td>
						<td>{{$articulo->stock}}</td>
						<td>
							<img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" alt="{{$articulo->nombre}}" width="100px" height="100px" class="img-thumbnail">
						</td>
						<td>{{$articulo->estado}}</td>
						<td>
							<a href="articulo/{{$articulo->idarticulo}}/edit"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$articulo->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('almacen.articulo.modal')
					@endforeach
				</table>
			</div>
			
		</div>
	</div>
@endsection