function validateForm() {
  const name = document.getElementById('name').value
  const email = document.getElementById('email').value

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

  if (!emailRegex.test(email)) {
    alert('Invalid email format')
    return false
  }

  const password = document.getElementById('pwd').value
  const cfmpassword = document.getElementById('cfmpwd').value

  if (password.length < 8 || password.length > 20) {
    alert('Password length should be between 8 and 20')
    return false
  }
  if (cfmpassword !== password) {
    alert('Confirm password does not match')
    return false
  }

  return true
}
