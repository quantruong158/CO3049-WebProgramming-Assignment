const dateInput = document.getElementById('datepicker')
const makeAppointmentBtn = document.getElementById('makeAppointmentBtn')
const selectedDateElement = document.getElementById('selectedDate')
const timeSlotContainer = document.getElementById('timeSlotContainer')
const selectDoctor = document.getElementById('selectDoctor')

const tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000)
  .toISOString()
  .split('T')[0]
const nextWeek = new Date(new Date().getTime() + 24 * 60 * 60 * 1000 * 7)
  .toISOString()
  .split('T')[0]

dateInput.min = tomorrow
dateInput.addEventListener('input', () => {
  makeAppointmentBtn.disabled = true
  const selectedDate = dateInput.value
  if (selectedDate < tomorrow || selectedDate > nextWeek) {
    selectedDateElement.textContent = 'Please select an appropriate date'
    timeSlotContainer.innerHTML = ''
  } else {
    const cfmDate = document.getElementById('cfmDate')
    selectedDateElement.textContent = selectedDate
    cfmDate.innerHTML = `Date: ${selectedDate}`
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
    xhr.open(
      'GET',
      `../controllers/time_slots.php?date=${selectedDate}&doctor_id=${selectDoctor.value}`,
      true
    )
    xhr.send()
  }
})

selectDoctor.addEventListener('change', function () {
  const selectedDate = dateInput.value
  if (selectedDate) {
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
    xhr.open(
      'GET',
      `../controllers/time_slots.php?date=${selectedDate}&doctor_id=${selectDoctor.value}`,
      true
    )
    xhr.send()
  }
})

timeSlotContainer.addEventListener('change', function () {
  const radio = document.querySelector('input[name="timeSlot"]:checked').value
  if (radio) {
    const cfmTime = document.getElementById('cfmTime')
    const slotTime = document.querySelector(
      `label[for="radio${radio}"]`
    ).innerHTML
    makeAppointmentBtn.disabled = false
    cfmTime.innerHTML = `Time: ${slotTime}`
  }
})
