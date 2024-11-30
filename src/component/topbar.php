      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mt-1">
        <button class="btn btn-primary" id="menu-toggle">
            <i class="fas fa-bars"></i> 
        </button>
        <div class="ms-auto">
          <button  class="btn btn-outline-primary" id="logout">Logout</button>
        </div>
      </nav>
      <script>
  document.getElementById('logout').addEventListener('click', function () {
    window.location.href = '/inventory_v1/src/pages/logout.php'; // Correct relative path from the root
});

</script>