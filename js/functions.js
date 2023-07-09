
$(document).ready(function(){

   //Modal Form Add Product

   $('.add_product').click(function(e){
        e.preventDefault();
        var producto = $(this).attr('product');
        var action = 'infoProducto';

      $.ajax({
         url: '../ajax.php',
         type: 'POST',
         async: true,
         data: {action:action,producto:producto},

         success: function(response){
            
            if(response != 'error'){

               var info = JSON.parse(response);

               $('#producto_id').val(info.num_pro);
               $('.nameProducto').html(info.producto);
            }
         },

         error: function(error){
            console.log(error);
         }

      });

      $('.modal').fadeIn();
   });
   

   //Activa Campos para Registrar Cliente
   $('.btn_new_cliente').click(function(e){
      e.preventDefault();
      $('#nom_cliente').removeAttr('disabled');
      $('#tel_cliente').removeAttr('disabled');
      $('#dir_cliente').removeAttr('disabled');

      $('#div_registro_cliente').slideDown();
   });

   //Buscar Cliente
   $('#nit_cliente').keyup(function(e){
      e.preventDefault();

      var cl=$(this).val();
      var action = 'searchCliente';

      $.ajax({
         url: '../ajax.php',
         type: "POST",
         async: true,
         data: {action:action, cliente:cl},

         success: function(response){
            if(response==0){
               $('#idCliente').val('');
               $('#nom_cliente').val('');
               $('#tel_cliente').val('');
               $('#dir_cliente').val('');

               //Mostrar Boton Agregar
               $('.btn_new_cliente').slideDown();
            }else{
               var data = $.parseJSON(response);
               $('#idcliente').val(data.idcliente);
               $('#nom_cliente').val(data.nombre);
               $('#tel_cliente').val(data.telefono);
               $('#dir_cliente').val(data.direccion);

               //Ocultar Boton Agregar
               $('.btn_new_cliente').slideUp();

               //Bloqueo de campos
               $('#nom_cliente').attr('disabled','disabled');
               $('#tel_cliente').attr('disabled','disabled');
               $('#dir_cliente').attr('disabled','disabled');

               //Ocultar Boton Guardar
               $('#div_registro_cliente').slideUp();
            }
         },
         error: function(error){
         }
      });
   });

   //Crear Cliente-Venta
   $('#form_new_cliente_venta').submit(function(e){
      e.preventDefault();

      $.ajax({
         url: '../ajax.php',
         type: "POST",
         async: true,
         data: $('#form_new_cliente_venta').serialize(),

         success: function(response){
            if(response!='error'){

               //Agregar ID a Input hidden
               $("#idCliente").val(response);
               //Bloqueo de campos
               $('#nom_cliente').attr('disabled','disabled');
               $('#tel_cliente').attr('disabled','disabled');
               $('#dir_cliente').attr('disabled','disabled');

               //Ocultar Boton Agregar
               $('.btn_new_cliente').slideUp();
               //Ocultar Boton Guardar
               $('#div_registro_cliente').slideUp();
            }
         },
         error:function(error){

         }
      });
   });

   //Buscar Producto
   $('#txt_cod_producto').keyup(function(e){
      e.preventDefault();

      var producto = $(this).val();
      var action = 'infoProductos';

      if(producto != ''){
      $.ajax({
         url: '../ajax.php',
         type: "POST",
         async: true,
         data: {action:action, producto:producto},

         success: function(response){
            if(response != 'error'){
               var info = JSON.parse(response);
               $('#text_nombre').html(info.producto);
               $('#text_categoria').html(info.categoria);
               $('#text_existencia').html(info.total_stock);
               $('#txt_cant_producto').val('1');
               $('#txt_precio').html(info.precio_venta);
               $('#txt_precio_total').html(info.precio);

               //Activar cantidad
               $('#txt_cant_producto').removeAttr('disabled');

               //Mostrar botón agregar
               $('#add_product_venta').slideDown();
            }else{
               $('#text_nombre').html('-');
               $('#text_existencia').html('-');
               $('#txt_cant_producto').val('0');
               $('#txt_precio').html('0.00');
               $('#txt_precio_total').html('0.00');

               //Bloquear Cantidad
               $('#txt_cant_producto').attr('disabled','disabled');

               //Ocultar boton agregar
               $('#add_product_venta').slideUp();
            }
         },
         error: function(error){
         }
      });
   }
});

   //Validar cantidad del producto
   $('#txt_cant_producto').keyup(function(e){
      e.preventDefault();
      var precio_total = $(this).val() * $('#txt_precio').html();
      var existencia = parseInt($('#text_existencia').html());
      $('#txt_precio_total').html(precio_total);

      //Oculta el boton agregar si la cantidad es menor a 1
      if(($(this).val() < 1 || isNaN($(this).val())) || ( $(this).val() > existencia)  ){
         $('#add_product_venta').slideUp();
      }else{
         $('#add_product_venta').slideDown();
      }
   });

   //Agregar producto a la tabla de detalle temporal
   $('#add_product_venta').click(function(e){
      e.preventDefault();

      if($('#txt_cant_producto').val()>0){
         var codproducto = $('#txt_cod_producto').val();
         var cantidad = $('#txt_cant_producto').val();
         var categoria = $('#text_categoria').html();
         var action = 'addProductoDetalle';

         $.ajax({
            url: '../ajax.php',
            type: "POST",
            async: true,
            data: {action:action, producto:codproducto, cantidad:cantidad, categoria:categoria},

            success : function(response){
               if(response != 'error'){
                  var info = JSON.parse(response);
                  $('#detalle_venta').html(info.detalle);
                  $('#detalle_totales').html(info.totales);

                  $('#txt_cod_producto').val('');
                  $('#text_nombre').html('-');
                  $('#text_categoria').html(' ');
                  $('#text_existencia').html('-');
                  $('#txt_cant_producto').val('0');
                  $('#txt_precio').html('0.00');
                  $('#txt_precio_total').html('0.00');

                   //Bloquear Cantidad
                   $('#txt_cant_producto').attr('disabled','disabled');
                   //Ocultar boton agregar
                  $('#add_product_venta').slideUp();

               }else{
                  console.log('no data');
               }
               viewProcesar();
            },
            error: function(error){
               console.log(error);
            }
         });
      }
   });

   //Boton anular venta
   $('#btn_anular_venta').click(function(e){
      e.preventDefault();

      var rows = $('#detalle_venta tr').length;
      if(rows>0){
         var action = 'anularVenta';

         $.ajax({
            url: '../ajax.php',
            type: "POST",
            async: true,
            data: {action:action},

            success : function(response){
               console.log(response);
               if(response != 'error'){
                  location.reload();
               }
            },
            error : function(error){
               
            }
         });
      }
   });

   //Facturar Venta
   $('#btn_facturar_venta').click(function(e){
      e.preventDefault();

      var rows = $('#detalle_venta tr').length;
      if(rows > 0){
         var action = 'procesarVenta';
         var codcliente = $('#nit_cliente').val();

         $.ajax({
            url: '../ajax.php',
            type: "POST",
            async: true,
            data: {action:action, codcliente:codcliente},

            success: function(response){
               console.log(response);
               if(response != 'error'){
                  //var info = JSON.parse(response);
                  //console.log(info);
                  location.reload();
               }else{
                  console.log("no data");
               }
            },
            error: function(error){

            }
         });
}     
   });

   //Ver factura
   $('.view_factura').click(function(e){
         e.preventDefault();

         var codcliente = $(this).attr('cl');
         var nofactura = $(this).attr('f');

         generarPDF(codcliente,nofactura);
   });

}); //End ready

function generarPDF(cliente,factura){
   var ancho = 1000;
   var alto = 800;

   //Calcular posicion x,y para generar la ventana
   var x = parseInt((window.screen.width/2) - (ancho/2));
   var y = parseInt((window.screen.height/2) - (alto/2));

   $url = 'generaFactura.php?cl='+cliente+'&f='+factura;
   window.open($url,"Factura","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}

function del_product_detalle(num){
   var action = 'delProductoDetalle';
   var id_detalle = num;

   $.ajax({
      url: '../ajax.php',
      type: "POST",
      async: true,
      data: {action:action, id_detalle:id_detalle},

      success : function(response){
         if(response != 'error'){
            var info = JSON.parse(response);
            var info = JSON.parse(response);
                  $('#detalle_venta').html(info.detalle);
                  $('#detalle_totales').html(info.totales);

                  $('#txt_cod_producto').val('');
                  $('#text_nombre').html('-');
                  $('#text_categoria').html(' ');
                  $('#text_existencia').html('-');
                  $('#txt_cant_producto').val('0');
                  $('#txt_precio').html('0.00');
                  $('#txt_precio_total').html('0.00');

                   //Bloquear Cantidad
                   $('#txt_cant_producto').attr('disabled','disabled');
                   //Ocultar boton agregar
                  $('#add_product_venta').slideUp();


         }else{
            $('#detalle_venta').html('');
            $('#detalle_totales').html('');
         }
         viewProcesar();
      },
      error: function(error){
      }
   });
}

//Ocultar o mostrar boton procesar
function viewProcesar(){
   if($('#detalle_venta tr').length > 0){
      $('#btn_facturar_venta').show();
   }else{
      $('#btn_facturar_venta').hide();
   }
}


function sendDataProduct(){
   
   $('.alertAddProduct').html('');

   $.ajax({
      url: '../ajax.php',
      type: 'POST',
      async: true,
      data: $('#form_add_product').serialize(),

      success: function(response){
         console.log(response);
           if(response == 'error'){
               $('.alertAddProduct').html('<p style="color: red;">Error al agregar el producto.</p>');
            }else{
               var info = JSON.parse(response);
               $('.row'+info.ID_producto+' .celExistencia').html(info.total_stock);
               $('#txtCantidad').val('');
               $('.alertAddProduct').html('<p>Producto agregado correctamente.</p>');
            }
         
      },

      error: function(error){
         console.log(error);
      }

   });
}

function closerModal(){
   $('.alertAddProduct').html('');
   $('#txtCantidad').val('');
   $('#txtPrecio').val('');
   $('.modal').fadeOut();
}