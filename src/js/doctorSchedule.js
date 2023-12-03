const dateInput = document.getElementById('datepicker')
const makeAppointmentBtn = document.getElementById('makeAppointmentBtn')
const selectedDateElement = document.getElementById('selectedDate')
const timeSlotContainer = document.getElementById('timeSlotContainer')

const tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000)
  .toISOString()
  .split('T')[0]
const nextWeek = new Date(new Date().getTime() + 24 * 60 * 60 * 1000 * 7)
  .toISOString()
  .split('T')[0]

dateInput.min = tomorrow

dateInput.addEventListener('input', () => {
  makeAppointmentBtn.disabled = false
  const selectedDate = dateInput.value
  if (selectedDate < tomorrow || selectedDate > nextWeek) {
    selectedDateElement.textContent = 'Please select an appropriate date'
    timeSlotContainer.innerHTML = ''
  } else {
    selectedDateElement.textContent = selectedDate
    const xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          timeSlotContainer.innerHTML = xhr.responseText
        } else {
          console.error(
            'Error fetching time slots:',
            xhr.status,
            xhr.statusText
          )
        }
      }
    }
    xhr.open('GET', `../controllers/time_slots.php?date=${selectedDate}`, true)
    xhr.send()
  }
})
