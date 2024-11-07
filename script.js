function goBack() {
  window.history.back();
}
let currentIndex = 0;
  const items = document.querySelectorAll('.carousel-item');
  const totalItems = items.length;

  function autoScrollCarousel() {
    items[currentIndex].classList.remove('active'); // Menghilangkan class aktif pada item saat ini
    currentIndex = (currentIndex + 1) % totalItems; // Pindah ke item berikutnya
    items[currentIndex].classList.add('active'); // Menambahkan class aktif pada item berikutnya
  }

  // Auto-scroll interval (3 detik)
  setInterval(autoScrollCarousel, 3000);


  const checkboxes = document.querySelectorAll('.filter-checkbox');
  const selectedCount = document.getElementById('selected-count');
  const resetButton = document.getElementById('reset-button');

  // Function to update the count of selected items 
  function updateSelectedCount() {
    const checkedItems = document.querySelectorAll('.filter-checkbox:checked').length;
    selectedCount.textContent = `${checkedItems} Terpilih`;
  }

  // Add event listeners to checkboxes to update count on change
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedCount);
  });

  // Reset button functionality
  resetButton.addEventListener('click', () => {
    checkboxes.forEach(checkbox => {
      checkbox.checked = false; // Uncheck all checkboxes
    });
    updateSelectedCount(); // Update the count display
  });

  // Initialize with default count (0)
  updateSelectedCount();
    const settingsButton = document.getElementById('settingsButton');
    const settingsContent = document.getElementById('settingsContent');

    // Tambahkan event listener untuk mendeteksi klik pada tombol pengaturan
    settingsButton.addEventListener('click', () => {
        // Toggle visibility (tampilkan/sembunyikan)
        if (settingsContent.classList.contains('hidden')) {
            settingsContent.classList.remove('hidden');
            settingsContent.classList.add('visible');
        } else {
            settingsContent.classList.remove('visible');
            settingsContent.classList.add('hidden');
        }
    });


    // Page edit profile
    function toggleEdit(field) {
      const display = document.getElementById(`${field}-display`);
      const input = document.getElementById(`${field}-input`);
      const button = document.getElementById(`${field}-edit`);
  
      if (input.classList.contains('hidden')) {
        // Switch to editing mode
        display.classList.add('hidden');
        input.classList.remove('hidden');
        button.innerHTML = 'Submit';
        button.classList.remove('bg-[#D23D2D]');
        button.classList.add('bg-[#31603D]');
      } else {
        // Switch to display mode and save changes
        display.classList.remove('hidden');
        input.classList.add('hidden');
        display.innerHTML = input.value;
        button.innerHTML = 'Beli';
        button.classList.remove('bg-[#31603D]');
        button.classList.add('bg-[#D23D2D]');
      }
    }

    //jual produk

  document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.querySelector('input[type="file"]');
    const imagePreview = document.querySelector('.relative img');

    fileInput.addEventListener('change', function (event) {
      const file = event.target.files[0];

      if (file && (file.type === 'image/jpeg' || file.type === 'image/png')) {
        const reader = new FileReader();

        reader.onload = function (e) {
          imagePreview.src = e.target.result;
        };

        reader.readAsDataURL(file);
      } else {
        alert('Format gambar harus JPG atau PNG');
        fileInput.value = '';
      }
    });
  });

  // profile preview

 
