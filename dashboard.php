<?php

session_start();

if (isset($_SESSION['id'])):
    require('sections/navigation.php');

?>
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">1,504</div>
                    <div class="cardName">Daily views</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers">80</div>
                    <div class="cardName">Sales</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers">284</div>
                    <div class="cardName">Comments</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="chatbubbles-outline"></ion-icon>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers">$7,842</div>
                    <div class="cardName">Earning</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
            </div>
        </div>

        <div class="details">
            <div class="recentActivities">
                <div class="cardHeader">
                    <h2>Recent Activities</h2>
                    <a href="#" class="btn">View all</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Payment</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status delivered">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status pending">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status return">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status inprogress">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status return">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status return">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status delivered">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status pending">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status return">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status inprogress">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status return">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>Star refrigerator</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td><span class="status return">Delivered</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

<?php

require('sections/footer.php');

else:
    header("Location: /login.php");

endif;

?>