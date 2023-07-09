const loginUsuario = ()=>{
    var empleado = document.querySelector('#empleado').value;
    var password = document.querySelector('#password').value;

    if(empleado.trim()==='' || password.trim()===''){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Faltan llenar campos'
          })
          return;
    }
}