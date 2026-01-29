<footer style="background-color: #1a1a1a; color: #ffffff; padding: 40px 20px; font-family: sans-serif; margin-top: 50px;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;">

        <div>
            <h3 style="color: #ff9900;">ShopLogo</h3>
            <p style="font-size: 14px; line-height: 1.6; color: #ccc;">
                Your one-stop shop for the latest trends. Quality products, fast delivery, and 24/7 support.
            </p>
        </div>

        <div>
            <h4>Quick Links</h4>
            <ul style="list-style: none; padding: 0; font-size: 14px;">
                <li style="margin-bottom: 10px;"><a href="products.php" style="color: #ccc; text-decoration: none;">All Products</a></li>
                <li style="margin-bottom: 10px;"><a href="account.php" style="color: #ccc; text-decoration: none;">My Account</a></li>
                <li style="margin-bottom: 10px;"><a href="cart.php" style="color: #ccc; text-decoration: none;">View Cart</a></li>
            </ul>
        </div>

        <div>
            <h4>Help & Support</h4>
            <ul style="list-style: none; padding: 0; font-size: 14px;">
                <li style="margin-bottom: 10px;"><a href="shipping.php" style="color: #ccc; text-decoration: none;">Shipping Policy</a></li>
                <li style="margin-bottom: 10px;"><a href="returns.php" style="color: #ccc; text-decoration: none;">Returns & Refunds</a></li>
                <li style="margin-bottom: 10px;"><a href="contact.php" style="color: #ccc; text-decoration: none;">Contact Us</a></li>
            </ul>
        </div>

        <div>
            <h4>Newsletter</h4>
            <p style="font-size: 12px; color: #ccc;">Get updates on new sales!</p>
            <form action="subscribe.php" method="POST">
                <input type="email" placeholder="Email address" style="padding: 8px; width: 80%; border: none; border-radius: 4px;">
                <button type="submit" style="background-color: #ff9900; border: none; padding: 8px 12px; margin-top: 5px; border-radius: 4px; cursor: pointer; color: white;">Join</button>
            </form>
        </div>
    </div>

    <hr style="border: 0; border-top: 1px solid #333; margin: 30px 0;">

    <div style="text-align: center; font-size: 13px; color: #888;">
        <p>&copy; <?php echo date("Y"); ?> YourShopName. All rights reserved.</p>
        <p>💳 We accept: Visa, MasterCard, PayPal, Crypto</p>
    </div>
</footer>