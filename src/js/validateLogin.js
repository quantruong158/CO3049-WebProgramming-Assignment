function validateForm() {
  const email = document.getElementById('email').value

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

  if (!emailRegex.test(email)) {
    alert('Invalid email format')
    return false
  }

  const password = document.getElementById('pwd').value

  if (password === '') {
    alert('Password cannot be empty')
    return false
  }

  return true
}
