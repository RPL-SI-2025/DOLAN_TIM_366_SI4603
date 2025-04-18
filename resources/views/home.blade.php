<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Dolan - Destinasi Wisata Nusantara</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-image: url('https://placehold.co/1920x1080/EEE4F4/EEE4F4'); /* Background gambar */
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      position: relative;
    }

    /* Styling untuk promo */
    #promo {
      background-color:rgba(116, 110, 123, 0.39);
      color: black;
      font-weight: bold;
      padding: 15px 30px;
      border-radius: 30px;
      display: inline-block;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      font-size: 1.2rem;
      text-align: center;
      width: auto;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-top: -30px;
      margin-bottom: 30px;
    }

    #promo i {
      margin-right: 10px;
    }

    /* Hover effect untuk promo */
    #promo:hover {
      transform: scale(1.05); /* Memberikan efek pembesaran saat hover */
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }
  </style>
</head>
<body class="text-gray-800">

  <!-- Navbar -->
  <div class="w-full flex justify-center pt-6">
    <div class="bg-white glass rounded-full px-10 py-4 flex items-center justify-between shadow-lg max-w-3xl w-full">
      <div class="text-2xl font-bold text-purple-600">Dolan</div>
      <nav class="hidden md:flex gap-6 text-gray-800 font-medium">
        <a href="#" class="hover:text-purple-600">Home</a>
        <a href=destination class="hover:text-purple-600">Tours</a>
        <a href="#gallery" class="hover:text-purple-600">Gallery</a>
        <a href="#review" class="hover:text-purple-600">Review</a>
        <a href="#contribute" class="hover:text-purple-600">Contribute</a>
      </nav>
      <a href=register class="ml-4 bg-purple-600 text-white px-5 py-2 rounded-full hover:bg-purple-700 transition">
        Sign In
      </a>
    </div>
  </div>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-16 text-center">
    <!-- Promo Section -->
    <div id="promo">
      <i class="fas fa-tag"></i> <!-- Ikon promo untuk menunjukkan ini adalah promo -->
      Loading Promo...
    </div>

    <h1 class="text-4xl font-bold mb-4">Destinasi Wisata Nusantara</h1>
    <p class="text-gray-600 mb-8">Jelajahi keindahan Nusantara! Temukan destinasi wisata terbaik di Indonesia, dari pantai eksotis</br>
    hingga pegunungan menakjubkan. Rencanakan petualangan impianmu sekarang!</p>
    <button class="bg-purple-600 text-white px-6 py-3 rounded-full text-lg">Explore Indonesia Tours</button>

    <div id="destinations" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-12">
      <!-- Destinasi akan dimuat di sini dengan AJAX -->
    </div>

    <!-- Supported By -->
    <div class="mt-16">
      <h2 class="text-xl font-semibold mb-4">Supported By:</h2>
      <div class="flex justify-center space-x-8">
        <img class="h-20" src="images/Kemenparekraf.webp" alt="Supporter 1"/>
        <img class="h-16" src="images/Pesona-Indonesia-Logo.png" alt="Pesona Indonesia"/>
      </div>
    </div>

    <!-- Rating Section -->
    <div class="mt-8 flex justify-center space-x-8">
      <div class="text-center">
        <i class="fas fa-star text-yellow-500 text-2xl"></i>
        <p class="text-gray-600">Rating 4.8/5</p>
        <p class="text-gray-400">62 users</p>
      </div>
      <div class="text-center">
        <i class="fab fa-google text-red-500 text-2xl"></i>
        <p class="text-gray-600">On Google Review</p>
        <p class="text-gray-400">82 users</p>
      </div>
    </div>
  </main>

  <!-- JavaScript -->
  <script>
  $(document).ready(function() {
  // Load Promo
  function loadPromo() {
    $.ajax({
      url: '{{ route('promo.get') }}', // Pastikan rutenya benar
      method: 'GET',
      success: function(data) {
        var promo = data; // Data promo yang diterima
        // Menampilkan promo
        $('#promo').html(`
          <i class="fas fa-tag"></i> <!-- Ikon promo -->
          <strong>${promo.title}</strong>
        `);
      }
    });
  }

  // Load Destinations
  function loadDestinations() {
    $.ajax({
      url: '{{ route('destinations.get') }}', // Pastikan rutenya benar
      method: 'GET',
      success: function(data) {
        var destinations = data; // Data destinasi yang diterima
        var displayedDestinations = []; // Menyimpan destinasi yang sudah ditampilkan
        var htmlContent = '';
        var count = 0; // Menyimpan jumlah destinasi yang ditampilkan

        // Membuat card untuk setiap destinasi
        destinations.forEach(function(destination) {
          // Mengecek apakah destinasi sudah ditampilkan
          if (!displayedDestinations.includes(destination.id)) {
            htmlContent += `
              <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img class="w-full h-48 object-cover" src="/storage/images/${destination.image}" alt="${destination.name}"/>
                <div class="p-4">
                  <h3 class="text-lg font-semibold">${destination.name}</h3>
                  <p>${destination.description}</p>
                </div>
              </div>
            `;

            // Menambahkan ID destinasi ke array displayedDestinations
            displayedDestinations.push(destination.id);

            count++;

            // Jika sudah menampilkan 4 destinasi, berhenti
            if (count >= 4) {
              return false;
            }
          }
        });

        // Menambahkan card ke dalam kontainer jika ada destinasi
        if (htmlContent) {
          $('#destinations').html(htmlContent);
        }
      }
    });
  }

  // Memanggil fungsi untuk memuat promo dan destinasi pertama kali saat halaman dimuat
  loadPromo();
  loadDestinations();

  // Atur interval untuk mengambil data baru setiap 5 detik
  setInterval(function() {
    loadPromo();
    loadDestinations();
  }, 5000); // 5 detik
});

  </script>
</body>
</html>
