document.addEventListener("keydown", handleEnter);

function handleEnter(e) {
  if(e.keyCode === 13) {
    // alert("hell");
    e.preventDefault();
    login();
  }
}


function login(e) {
  var getUsername = document.querySelector("#username").value;
  var getPassword = document.querySelector("#password").value;
  const username = 'admin';
  const password = 'admin123'



  if(getUsername === '' && getPassword === '') {
    Swal.fire({
      icon: 'warning',
      title: 'Mohon isi form yang tersedia!'
    })
  }

  else if(getUsername !== username || getPassword !== password) {
    Swal.fire({
      icon: 'error',
      title:'Username atau password salah!'
    })
  }

  else {

    Swal.fire({
      icon: 'success',
      title: 'Login berhasil!',
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
        window.location = "main.html";
    });


  }

}

function forgotPass() {
  Swal.fire({
    text: "Your username is admin.",
    confirmButtonColor: '#41545F',
    confirmButtonText: 'OK'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire( {
        text: "Your password is admin123.",
        confirmButtonColor: '#41545F',
        confirmButtonText: 'OK'
      })
    }
  })
}
