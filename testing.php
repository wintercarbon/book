
                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title">Frequently Purchased</h4>
                        <div class="table-responsive dataview">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Book ID</th>
                                        <th>Book Name</th>
                                        <th>Author</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $frequentBook = $inventory->getFrequentlyPurchasedBook();
                                    if (is_null($frequentBook)) {
                                        echo "No frequently purchased books.";
                                    } else {
                                        foreach ($frequentBook as $frequentBooks) {
                                            echo '<tr>';
                                            echo '<td>' . $frequentBooks['BOOKID'] . '</td>';
                                            echo '<td class="productimgname">';
                                            echo '<a class="product-img" href="productlist.php?bookid=' . $frequentBooks['BOOKID'] . '">';
                                            echo '<img src=" ' . $frequentBooks['IMAGE_URL'] . '" alt="product">';
                                            echo '</a>';
                                            echo '<a href="productlist.php?bookid=' . $frequentBooks['BOOKID'] . '">' . $frequentBooks['BOOK_NAME'] . '</a>';
                                            echo '</td>';
                                            echo '<td>' . $frequentBooks['BOOK_AUTHOR'] . '</td>';
                                            echo '<td>' . $frequentBooks['BOOK_PRICE'] . '</td>';
                                            echo '<td>' . $frequentBooks['PURCHASE_COUNT'] . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                    <!--
                                    <tr>
                                        <td><a href="javascript:void(0);">1234</a></td>
                                        <td class="productimgname">
                                            <a class="product-img" href="productlist.php">
                                                <img src="assets/img/product/Jujutsu_kaisen.png" alt="product">
                                            </a>
                                            <a href="productlist.php">Jujutsu Kaisen</a>
                                        </td>
                                        <td>Mr Lee</td>
                                        <td>40.00</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>