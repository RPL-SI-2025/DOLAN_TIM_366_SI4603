<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

  
<x-mega-menu/>

<x-sidebar/>

<div class="p-4 sm:ml-64 min-h-screen overflow-auto">
   <div class="p-4 rounded-lg mt-14">
      {{ $slot }}
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
