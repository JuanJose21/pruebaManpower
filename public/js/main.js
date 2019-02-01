$(document).ready(function(){

  /* baseurl */
  var baseUrl = $("#baseurl").val();

  $( "#productsMenu" ).click(function() {
    $( "#containerCategory" ).hide();
    $( "#containerProduct" ).show();
  })

  $( "#categoryMenu" ).click(function() {
    $( "#containerCategory" ).show();
    $( "#containerProduct" ).hide();
  })

  $( "#form-registerUser" ).submit(function( event ) {
      event.preventDefault();
      var error = false;
      var mensaje = '';
      validarcampos  = validarCampos('#form-registerUser',error,mensaje);
      mensaje = validarcampos.mensaje;
      error=validarcampos.error;
      if(error){
          createAlert('Error', mensaje);
      }else{
          $.ajax({
              type: 'POST',
              dataType: 'json',
              data: $('#form-registerUser').serialize(),
              url: baseUrl + '/api/registerUser',
              success: function(response){
                  if(response.status){
                      createAlert('Exito', 'Se ha creado el usuario');
                      $("#form-registerUser")[0].reset();
                  }else{
                      createAlert('Atención', response.message);
                  }
              },
              error: function(response){
                  console.log('Error');
              }
          })/*end ajax*/
      }
    });

    /*
    * Function Get products
    */
    function getProducts(){
      return $.ajax({
          type: 'GET',
          url: baseUrl + '/api/productos/listar',
          dataType: 'json',
          success: function(response){
            $("#resultGetProduct").empty();
              $.each(response.data,function(index,value){
                  nombre = value['name'];
                  cantidad = value['quantity'];
                  id = value['id'];

                  $("#resultGetProduct").append('<tr><th class="eventoColumn">' + nombre + '</th><td>' + cantidad + '</td><td> <p id="' + id + '">Editar</p></td><td><p id="' + id + '">Eliminar</p></td></tr>');
              })
          },
          error: function(response){
              console.log('error al consultar evento');
          }
      })
    }

    getProducts();


    /*
    * Function Get products
    */
    function getCategories(){
      return $.ajax({
          type: 'GET',
          url: baseUrl + '/api/categoria/listar',
          dataType: 'json',
          success: function(response){
            $("#resultGetCategories").empty();
              $.each(response.data,function(index,value){
                  nombre = value['name'];
                  cantidad = value['quantity'];
                  id = value['id'];

                  $("#resultGetCategories").append('<tr><th class="eventoColumn">' + nombre + '</th><td> <p id="' + id + '">Editar</p></td><td><p id="' + id + '">Eliminar</p></td></tr>');
              })
          },
          error: function(response){
              console.log('error al consultar evento');
          }
      })
    }

    getCategories();


    $( "#form-registerProduct" ).submit(function( event ) {
        event.preventDefault();
        var error = false;
        var mensaje = '';
        validarcampos  = validarCampos('#form-registerProduct',error,mensaje);
        mensaje = validarcampos.mensaje;
        error=validarcampos.error;
        if(error){
            createAlert('Error', mensaje);
        }else{
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: $('#form-registerProduct').serialize(),
                url: baseUrl + '/api/productos/crear',
                success: function(response){
                    if(response.status){
                        createAlert('Exito', 'Se ha creado el producto');
                        $("#form-registerProduct")[0].reset();
                        getProducts();
                    }else{
                        createAlert('Atención', response.message);
                    }
                },
                error: function(response){
                    console.log('Error');
                }
            })/*end ajax*/
        }
      });


    function validarCampos(form, error, mensaje){
        var banderaRadio = true;
            //Valido si los campos que no sean botones, checkbox o radio buttons NO estén vación, y que tengan los carácteres mínimos
        $(form + ' input,' + form + ' select,' + form + ' textarea').not('.novalidate, input[type=button], input[type=reset], input[type=submit], input[type=radio]').each(function(){

            var nombre = $(this).attr('v-name');
            var name = $(this).attr('name')

            //mensaje+='nombre es '+nombre.length;
            var minLenght = $(this).attr('v-min');

            if($(this).val().trim() == ''){
                error = true;
                mensaje += '<div>El campo '+ nombre +' es obligatorio</div>';
                $(this).focus();
            }else{
                if($(this).val().length < minLenght){
                    error = true;
                    mensaje += '<div>El campo '+ nombre +' debe tener mínimo '+ minLenght +' caracteres</div>';
                    $(this).focus();
                }

                if ($(this).attr('v-only')=='text') {
                    var regex = /^[a-z A-Záéíóúñ]+$/;

                    if(!regex.test($(this).val())){
                        error = true;
                        mensaje += '<div>El campo <span>Nombre</span> solo puede contener texto</div>';
                        $(this).focus();
                    }else{
                        $(this).focus();
                    }
                }

                if($(this).attr('v-only')=='number'){
                    if (isNaN($(this).val().trim())) {
                        error = true;
                        mensaje += '<li>El campo <span>edad</span> debe ser numérico</li>';
                        $(this).focus();
                    }

                }
                if ($(this).attr('v-only')=='email') {
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                    if(!regex.test($(this).val())){
                        error = true;
                        mensaje += '<li>Por favor ingrese un <span>Correo Electrónico</span> válido</li>';
                        $(this).focus();
                    }else{
                        $(this).focus();
                    }
                }
                var radio = $(this).attr('v-checkbox');
                if(banderaRadio == true){
                    var radioLast = '';
                    banderaRadio = false;
                }
                if(radio){
                    if(radio != radioLast){
                        if(!$(this).prop('checked')){
                            error=true;
                            mensaje +='<div>'+$(this).attr('v-checkbox')+' es obligatorio</div>';
                            radioLast = radio;
                        }
                    }
                }
                /*if( !$(form+' input[type=radio]:checked').attr('v-radio')){
                    error=true;
                    mensaje+='<div>radio '+$(form+' input[type=radio]').attr('v-radio')+' obligatorio</div>';
                }*/
            }
        });


        var arrError = { error: error, mensaje: mensaje};
        return arrError;
    }/*Fin funcion para validar los campos de un formulario*/

})

/**
 * Crear alert
 */
function createAlert(titulo, texto){
  swal({
    title: '<div class="alert-header">'+titulo+'</div>',
    confirmButtonText: 'Continuar',
    html: '<div class="alert-body">'+texto+'</div>',
    confirmButtonClass: 'btn-verde',
    buttonsStyling: false,
    allowOutsideClick: false
  })
}
