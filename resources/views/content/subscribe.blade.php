<div class="subscribe">
  <h1>Suscríbete</h1>
  <h3>Recibe un 10% de descuento</h3>
  {!! Form::open(['id'=>'filter', 'name'=>'filter', 'url'=>'process/suscribete', 'method'=>'post']) !!}
    <div class="row">
      {!! Field::form_input(NULL, 'edit', ['name'=>'name', 'type'=>'string'], ['label'=>'Nombre y Apellido', 'cols'=>12]) !!}
      {!! Field::form_input(NULL, 'edit', ['name'=>'email', 'type'=>'string'], ['label'=>'Correo Electrónico', 'cols'=>12]) !!}
      <div class="col-sm-6">
        <input type="submit" value="SUSCRÍBETE AHORA" class="btn btn-site btn-full">
      </div>
      <div class="col-sm-6">
        <a href="{{ url('login/facebook') }}" class="btn btn-site btn-facebook btn-full"><i class="fa fa-facebook"></i> HAZLO POR FACEBOOK</a>
      </div>
    </div>
  {!! Form::close() !!}
</div>