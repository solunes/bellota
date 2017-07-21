<div id="map"></div>
<hr class="invis">
@foreach($items as $item)
  <div class="row">
    <div class="col-md-5">
      <div class="widget">
        <p>{{ $item->text }}</p>
        <hr class="invis">
        <ul class="contact-details">
          <li><i class="fa fa-envelope-o"></i> <a href="mailto:{{ $item->email }}">{{ $item->email }}</a></li>
          <li><i class="fa fa-phone"></i> {{ $item->phone }}</li>
          <li><i class="fa fa-home"></i> {{ $item->address }}</li>
        </ul>
        <hr class="invis">
        <div class="social-icons">
          <ul class="list-inline">
            <li class="facebook"><a data-tooltip="tooltip" data-placement="top" title="Facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li class="google"><a data-tooltip="tooltip" data-placement="top" title="Google Plus" href="#"><i class="fa fa-google-plus"></i></a></li>
            <li class="twitter"><a data-tooltip="tooltip" data-placement="top" title="Twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li class="linkedin"><a data-tooltip="tooltip" data-placement="top" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li class="pinterest"><a data-tooltip="tooltip" data-placement="top" title="Pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
            <li class="skype"><a data-tooltip="tooltip" data-placement="top" title="Skype" href="#"><i class="fa fa-skype"></i></a></li>
            <li class="youtube"><a data-tooltip="tooltip" data-placement="top" title="Youtube" href="#"><i class="fa fa-youtube"></i></a></li>
          </ul>
        </div><!-- end social icons -->
      </div><!-- end widget -->
    </div>   
    <div class="col-md-7">
      <div class="contact_form">
        <div id="message"></div>
        <form id="contactform" class="row" action="{{ url('process/model') }}" name="contactform" method="post">
          <div class="col-md-12">
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre"> 
            <input type="text" name="email" id="email" class="form-control" placeholder="Email"> 
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Teléfono"> 
            <input type="text" name="address" id="address" class="form-control" placeholder="Dirección"> 
            <textarea class="form-control" name="message" id="comments" rows="6" placeholder="Escriba su mensaje aquí"></textarea>
            <button type="submit" value="SEND" id="submit" class="btn btn-primary"> Enviar Mensaje</button>
            <input type="hidden" name="action_form" value="send">
            <input type="hidden" name="model_node" value="contact-form">
            <input type="hidden" name="lang_code" value="es">
          </div>
        </form> 
      </div>
    </div><!-- end col -->
  </div><!-- end row -->   
@endforeach