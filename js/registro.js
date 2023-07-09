const registrarUsuario= async()=>{
    var nombre = document.querySelector('#name').value;
    var apellido = document.querySelector('#last_name').value;
    var empleado = document.querySelector('#empleado').value;
    var password = document.querySelector('#password').value;
    var rol = document.querySelector('#rol').value;

    if(nombre.trim()==='' || apellido.trim()==='' ||
    empleado.trim()==='' || password.trim()===''|| rol.trim()===''){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Faltan llenar campos'
          })
          return;
    }else{
        Swal.fire({
            icon: 'success',
            title: 'Felicidades!',
            text: 'Los datos se guardaron de manera correcta',
            timer: 10000
          })
          return;
    }

}
