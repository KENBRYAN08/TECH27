// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

const modal = document.getElementById('myModal');
const openModalButton = document.getElementById('openModal');
const closeModal = document.querySelector('.close');

// Open modal
openModalButton.addEventListener('click', () => {
    modal.style.display = 'block';
});

// Close modal when 'X' is clicked
closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Close modal when clicking outside the content
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

function searchCenters() {
  let input = document.getElementById('search').value.toLowerCase();
  let rows = document.querySelectorAll('table tbody tr');
  
  rows.forEach(row => {
      let centerName = row.cells[0].textContent.toLowerCase();
      let location = row.cells[1].textContent.toLowerCase();
      let manager = row.cells[2].textContent.toLowerCase();
      
      if (centerName.includes(input) || location.includes(input) || manager.includes(input)) {
          row.style.display = '';
      } else {
          row.style.display = 'none';
      }
  });
}