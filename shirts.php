<?php 
require 'includes/header.php'; 
require 'includes/db_connect.php'; 

//  DATABASE AUTO-SYNC 
mysqli_query($conn, "ALTER TABLE products ADD COLUMN IF NOT EXISTS image VARCHAR(255) DEFAULT 'pro_aero.png'");
mysqli_query($conn, "ALTER TABLE products ADD COLUMN IF NOT EXISTS sizes VARCHAR(100) DEFAULT 'S, M, L, XL'");

// CAPTURE THE SEARCH TERM
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
?>

<main style="background-color: #f4f4f4; padding: 40px 20px; min-height: 80vh; font-family: sans-serif;">
    <div class="product-section" style="max-width: 1200px; margin: 0 auto;">
        
        <h2 style="text-align: center; color: #333; margin-bottom: 10px;">Specialist Tennis Collection</h2>
        <p style="text-align: center; color: #666; margin-bottom: 30px;">Premium gear for the modern player.</p>
        
        <section style="text-align: center; margin-bottom: 50px;">
            <form action="shirts.php" method="GET" id="searchForm" style="display: inline-flex; gap: 10px; justify-content: center;">
                <input type="text" name="search" id="searchInput" placeholder="Search (e.g. Pro, Clay, Grass)..." 
                       value="<?php echo htmlspecialchars($search); ?>"
                       style="padding: 12px; width: 300px; border: 1px solid #ccc; border-radius: 5px;">
                
                <button type="submit" style="background-color: #004d40; color: white; border: none; padding: 12px 25px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                    Search
                </button>
                
                <?php if ($search !== ""): ?>
                    <a href="shirts.php" style="padding: 12px; color: #666; text-decoration: none; font-weight: bold;">Clear</a>
                <?php endif; ?>
            </form>
        </section>
        
        <div class="product-grid" style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: center; gap: 30px;">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM products");

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    
                    // MANUAL OVERRIDES 
                    $id = $row['id'];
                    $img = 'pro_aero.png'; 
                    $desc = $row['description'];
                    $name = $row['name']; 

                    if($id == 1) { $name = "Pro Aero Shirt"; $img = 'pro_aero.png'; }
                    if($id == 2) { $name = "Clay Pro Performance Tee"; $img = 'clay_pro.png'; }
                    if($id == 3) { $name = "Classic Grass Court Polo"; $img = 'grass_court.png'; $desc = "Ultra-lightweight mesh shirt for maximum speed."; }

                    // SEARCH FILTER 
                    $showProduct = false;
                    if ($search == "" || stripos($name, $search) !== false || stripos($desc, $search) !== false) {
                        $showProduct = true;
                    }

                    // DISPLAY 
                    if ($showProduct) {
                        echo "<article class='product-card' style='background: white; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); width: 300px; padding: 25px; text-align: center;'>";
                            
                            echo "<img src='images/" . $img . "' alt='Tennis Shirt' style='width: 100%; height: auto; border-radius: 8px; margin-bottom: 20px;'>";
                            
                            echo "<h3 style='font-size: 1.25rem; color: #004d40; margin: 0 0 15px 0;'>" . htmlspecialchars($name) . "</h3>";
                            
                            echo "<p style='color: #777; font-size: 0.9rem; min-height: 60px; line-height: 1.4; margin-bottom: 20px;'>" . htmlspecialchars($desc) . "</p>";
                            
                            echo "<form action='basket.php' method='POST' style='border-top: 1px solid #eee; padding-top: 20px;'>";
                                echo "<div style='margin-bottom: 15px;'>";
                                    echo "<label style='font-size: 0.85rem; font-weight: bold; color: #555;'>Size: </label>";
                                    echo "<select name='size' style='padding: 6px; border-radius: 4px; border: 1px solid #ddd; margin-left: 5px;'>";
                                        echo "<option value='S'>S</option><option value='M'>M</option><option value='L'>L</option><option value='XL'>XL</option>";
                                    echo "</select>";
                                echo "</div>";
                                
                                echo "<p style='font-size: 1.4rem; font-weight: bold; color: #222; margin-bottom: 20px;'>£" . number_format($row['price'], 2) . "</p>";
                                
                                echo "<input type='hidden' name='product_id' value='".$row['id']."'>";
                                echo "<input type='hidden' name='product_name' value='".htmlspecialchars($name)."'>";
                                
                                echo "<button type='submit' name='add_to_cart' style='background-color: #004d40; color: white; border: none; padding: 14px; border-radius: 8px; cursor: pointer; font-weight: bold; width: 100%;'>Add to Basket</button>";
                            echo "</form>";
                        echo "</article>";
                    }
                }
            } else {
                echo "<p style='text-align: center; width: 100%; color: #999;'>No products match your search.</p>";
            }
            ?>
        </div>
    </div>
</main>

<script>
document.getElementById('searchForm').onsubmit = function() {
    var searchVal = document.getElementById('searchInput').value;
    if (searchVal.trim() === "") {
        alert("Please enter a term to search.");
        return false;
    }
    return true;
};
</script>

<?php require 'includes/footer.php'; ?>