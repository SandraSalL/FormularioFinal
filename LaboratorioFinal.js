
function validarFormulario() {
    var nombre = document.getElementsByName('nombre')[0].value;
    var primerApellido = document.getElementsByName('primer_apellido')[0].value;
    var segundoApellido = document.getElementsByName('segundo_apellido')[0].value;
    var email = document.getElementsByName('email')[0].value;
    var login = document.getElementsByName('login1')[0].value;
    var contraseña = document.getElementsByName('contraseña')[0].value;
  
    if (nombre === '' || primerApellido === '' || segundoApellido === '' || email === '' || login === '' || contraseña === '') {
      alert('Por favor, completa todos los campos del formulario.');
      return false;
    }
  
    
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      alert('Por favor, ingresa una dirección de correo electrónico válida.');
      return false;
    }
  
   
    if (contraseña.length < 4 || contraseña.length > 8) {
      alert('La contraseña debe tener entre 4 y 8 caracteres.');
      return false;
    }
    alert('El formulario se ha enviado con exito');
    return true; 
    
  }

        
          

  
 