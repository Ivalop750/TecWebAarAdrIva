<?php
  add_filter("the_content", "mfp_Fix_Text_Spacing");
  // Automatically correct double spaces from any post
  function mfp_Fix_Text_Spacing($the_Post)
  {
  $the_New_Post = str_replace("a mano", " A MANO ", $the_Post);
  return $the_New_Post;
  }
  /*
  Plugin Name: my_Plugin_Widget1
  Description: Este plugin añade un widget que pone un título y una descripción.
  Author: dllido
  Author Email: dllido@uji.es
  Version: 1.0
  License: GPLv3
  License URI: http://www.gnu.org/licenses/gpl-3.0.html
  */
  function shortcode_juego() {
  return '<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>MiJuego</title>
</head>
  <style>

    .boton {
      background: #eb94d0;

      /* Crear degradados */
      
      background-image: -webkit-linear-gradient(top, #eb94d0, #2079b0);
      background-image: -moz-linear-gradient(top, #eb94d0, #2079b0);
      background-image: -ms-linear-gradient(top, #eb94d0, #2079b0);
      background-image: -o-linear-gradient(top, #eb94d0, #2079b0);
      background-image: linear-gradient(to bottom, #eb94d0, #2079b0);
      
      /* Dar bordes curvados */
      
      -webkit-border-radius: 15;
        -moz-border-radius: 15;
        border-radius: 15px;
        -webkit-box-shadow: 6px 5px 24px #666666;
        -moz-box-shadow: 6px 5px 24px #666666;
        box-shadow: 6px 5px 24px #666666;font-family: Arial;
        color: #fafafa;
        font-size: 19px;
        padding: 10px;
        text-decoration: none;
}

/* Al poner el curso encima (hover) */

.boton:hover {  background: #2079b0;  background-image: -webkit-linear-gradient(top, #2079b0, #eb94d0);
  background-image: -moz-linear-gradient(top, #2079b0, #eb94d0);
  background-image: -ms-linear-gradient(top, #2079b0, #eb94d0);
  background-image: -o-linear-gradient(top, #2079b0, #eb94d0);
  background-image: linear-gradient(to bottom, #2079b0, #eb94d0);  text-decoration: none;
}
    </style>

<body>
    <H1>P4 - Ejercicio 8 - Grupo 3</H1>
    <canvas id="sketchpad" width="500" height="500" style="background-color: pink;"></canvas>
    <p>  <span class= "boton" id="dibujar"> Dibujar </span>
        <span class="boton" id="limpiar"> Limpiar</span>
    </p>


    <script type="text/javascript" charset="utf-8">
      	  var misCuadrados={};
		  var xC={};
		  var yC={};
          var coor1;
          var coor2;
          var tam1;
          var tam2;
		  var datos;
        function getMousePos(canvas, evt) {
                var rect = canvas.getBoundingClientRect();
                return {
                    x: evt.clientX - rect.left,
                    y: evt.clientY - rect.top
                };
            }
        function limpiar(context) {
            canvas = document.querySelector("#sketchpad");
            context = canvas.getContext("2d");
            context.clearRect(0, 0, canvas.width, canvas.height);
        }
        function dibuja(context) {
            context.fillStyle = "rgb(0,0,255)";
            var tam=Math.random()*100;
            c1=(Math.floor(Math.random()*420));
            c2=(Math.floor(Math.random()*420));
            coor1=c1;
            coor2=c2;
            tam1=tam2=tam;


            context.fillRect(c1, c2, tam, tam);


        }
		
        function DibujaEnRaton(context, coors) {
 
			  if (coors.x>=c1 && coors.x <=c1+tam1 
			&& coors.y>=c2 && coors.y <=c2+tam2){
				  context.fillStyle = "rgb(250,0,0)";
				  context.fillRect(c1, c2, tam1, tam2);
			  }

           

                
         }
        function ready() {
            var canvas = document.querySelector("#sketchpad");
            context = canvas.getContext("2d");
            canvas.addEventListener("click",function(evt){
                coors=getMousePos(canvas, evt);
                DibujaEnRaton(context, coors) ;
            })
            document.querySelector("#dibujar").addEventListener("click", function () {
                dibuja(context);
            });
 
            document.querySelector("#limpiar").addEventListener("click", function () {
                limpiar(context);
            });

        }
        ready();
    </script>
</body>

</html>';
}
add_shortcode('juego0', 'shortcode_juego');
  // Registramos el widget
  function load_my_widget() {
    register_widget( 'my_widget1' );
  }
  add_action( 'widgets_init', 'load_my_widget' );
  // Creamos el widget 
  class my_widget1 extends WP_Widget {
  public function __construct() {
      $widget_ops = array( 
        'classname' => 'my_widget',
        'description' => 'My Widget is awesome',
      );
      parent::__construct( 'my_widget1', 'My Widget1', $widget_ops );
    }	
  // Creamos la parte pública del widget
  public function widget( $args, $instance ) {
  $title = apply_filters( 'widget_title', $instance['title'] );
  // los argumentos del antes y después del widget vienen definidos por el tema
  echo $args['before_widget'];
  if ( ! empty( $title ) )
  echo $args['before_title'] . $title . $args['after_title'];
  // Aquí es donde debemos introducir el código que queremos que se ejecute
  echo 'Esta tienda es 100% responsable con el medio ambiente' ;
  echo $args['after_widget'];
  }
  // Backend  del widget
  public function form( $instance ) {
  if ( isset( $instance[ 'title' ] ) ) {
  $title = $instance[ 'title' ];
  }
  else {
  $title = __( 'Titulo', 'my_widget_domain' );
  }
  // Formulario del backend
   ?>
  <p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Nombre y dirección de tu tienda:' ); ?></label> 
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
  </p>
  <?php	
  }
  // Actualizamos el widget reemplazando las viejas instancias con las nuevas
  public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
  return $instance;
  }
  } // La clase wp_widget termina aquí
?>
