<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="flex items-center gap-4 p-4 border border-yellow-200 bg-yellow-50 rounded-lg">
  <!-- Icono -->
  <div class="flex-shrink-0">
    <i class="fas fa-triangle-exclamation text-yellow-500 text-xl"></i>
  </div>

  <!-- Texto -->
  <div>
    <h3 class="text-sm font-semibold text-yellow-800">
      Advertencia
    </h3>
    <p class="text-sm text-yellow-700">
     {{ $slot }}
    </p>
  </div>
</div>
