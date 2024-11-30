<div class="container-fluid mt-4">
    <!-- Welcome Message -->
    <h1 class="mt-4">
        Welcome, 
        <?php 
        // Display the user's name from the session
        echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Guest'; 
        ?>!
    </h1>

    <!-- Dashboard Cards -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-box-open me-2"></i> Total Products
                    </h5>
                    <p class="card-text" id="total-products">120</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-tags me-2"></i> Categories
                    </h5>
                    <p class="card-text" id="categories">8</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-exclamation-triangle me-2"></i> Low Stock
                    </h5>
                    <p class="card-text" id="low-stock">15</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-times-circle me-2"></i> Out of Stock
                    </h5>
                    <p class="card-text" id="out-stock">5</p>
                </div>
            </div>
        </div>
    </div>
</div>
