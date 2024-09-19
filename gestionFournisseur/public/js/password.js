function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("password_confirmation").value;
    if (password !== confirmPassword) {
      alert("Les mots de passe ne correspondent pas.");
      return false;
    }
    return true;
  }