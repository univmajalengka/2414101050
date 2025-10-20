<html lang="en">
    <php?
require_once 'config.php';
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>RzStore</title>
</head>

<body>
    <nav id="nav">
        <div class="navTop">
            <div class="navItem">
                <img src="" alt="">
            </div>
            <div class="navItem">
                <div class="search">
                    <input type="text" placeholder="Search..." class="searchInput">
                    <img src="./img/search.png" width="20" height="20" alt="" class="searchIcon">
                </div>
            </div>
            <div class="navItem">
                <span class="limitedOffer">JAYROSSE</span>
            </div>
        </div>
        <div class="navBottom">
            <h3 class="menuItem">HEDONIST</h3>
            <h3 class="menuItem">STARBOY</h3>
            <h3 class="menuItem">BRUCE</h3>
            <h3 class="menuItem">ROUGE</h3>
            <h3 class="menuItem">GREY</h3>
        </div>
    </nav>
    <div class="slider">
        <div class="sliderWrapper">
            <div class="sliderItem">
                <img src="pict project e/HEDONIST.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">HEDONIST</br>NEW</br></h1>
                <h2 class="sliderPrice">99k</h2>
                <a href="#product">
                    <button class="buyButton">BELI SEKARANG!</button>
                </a>
            </div>
            <div class="sliderItem">
                <img src="pict project e/STARBOY.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">STARBOY</br>NEW</br></h1>
                <h2 class="sliderPrice">99k</h2>
                <a href="#product">
                    <button class="buyButton">BELI SEKARANG!</button>
                </a>
            </div>
            <div class="sliderItem">
                <img src="pict project e/BRUCE.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">BRUCE</br>NEW</br></h1>
                <h2 class="sliderPrice">99k</h2>
                <a href="#product">
                    <button class="buyButton">BELI SEKARANG!</button>
                </a>
            </div>
            <div class="sliderItem">
                <img src="pict project e/ROUGE.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">ROUGE</br>NEW</br></h1>
                <h2 class="sliderPrice">99k</h2>
                <a href="#product">
                    <button class="buyButton">Beli Sekarang!</button>
                </a>
            </div>
            <div class="sliderItem">
                <img src="pict project e/GREY.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">GREY</br> NEW</br></h1>
                <h2 class="sliderPrice">99k</h2>
                <a href="#product">
                    <button class="buyButton">Beli Sekarang!</button>
                </a>
            </div>
        </div>
    </div>
   
    <div class="features">
        <div class="feature">
            <img src="./img/shipping.png" alt="" class="featureIcon">
            <span class="featureTitle">FREE SHIPPING</span>
            <span class="featureDesc">Free worldwide shipping on all orders.</span>
        </div>
        <div class="feature">
            <img class="featureIcon" src="./img/return.png" alt="">
            <span class="featureTitle">30 DAYS RETURN</span>
            <span class="featureDesc">No question return and easy refund in 14 days.</span>
        </div>
        <div class="feature">
            <img class="featureIcon" src="./img/gift.png" alt="">
            <span class="featureTitle">GIFT CARDS</span>
            <span class="featureDesc">Buy gift cards and use coupon codes easily.</span>
        </div>
        <div class="feature">
            <img class="featureIcon" src="./img/contact.png" alt="">
            <span class="featureTitle">CONTACT US!</span>
            <span class="featureDesc">Keep in touch via email and support system.</span>
        </div>
    </div>

    <div class="product" id="product">
        <img src="pict project e/HEDONIST.png" alt="" class="productImg">
        <div class="productDetails">
            <h1 class="productTitle">HEDONIST</h1>
            <h2 class="productPrice">99K</h2>
            <p class="productDesc">Extrait De Parfum</p>
            <div class="colors">
                
            </div>
            <div class="sizes">
            
            </div>
            <button class="productButton">BUY NOW!</button>
        </div>
        <div class="payment">
            <h1 class="payTitle">Personal Information</h1>
            <label>Name and Surname</label>
            <input id="payName" type="text" placeholder="John Doe" class="payInput">
            <label>Phone Number</label>
            <input id="payPhone" type="text" placeholder="+1 234 5678" class="payInput">
            <label>Address</label>
            <input id="payAddress" type="text" placeholder="Elton St 21 22-145" class="payInput">
            <h1 class="payTitle">Card Information</h1>
            <div class="cardIcons">
                <img src="./img/visa.png" width="40" alt="" class="cardIcon">
                <img src="./img/master.png" alt="" width="40" class="cardIcon">
            </div>
            <input type="password" class="payInput" placeholder="Card Number">
            <div class="cardInfo">
                <input type="text" placeholder="mm" class="payInput sm">
                <input type="text" placeholder="yyyy" class="payInput sm">
                <input type="text" placeholder="cvv" class="payInput sm">
            </div>
            <button class="payButton">Checkout!</button>
            <span class="close">X</span>
        </div>
        <!-- Receipt / Struk -->
        <div class="receipt" id="receipt" style="display:none;">
            <h2>Struk Pembayaran</h2>
            <div class="receiptBody">
                <p><strong>Order ID:</strong> <span id="receiptOrderId"></span></p>
                <p><strong>Date:</strong> <span id="receiptDate"></span></p>
                <p><strong>Nama:</strong> <span id="receiptCustomerName"></span></p>
                <p><strong>HP:</strong> <span id="receiptPhone"></span></p>
                <p><strong>Alamat:</strong> <span id="receiptAddress"></span></p>
                <hr>
                <p><strong>Produk:</strong> <span id="receiptProduct"></span></p>
                <p><strong>Harga:</strong> <span id="receiptPrice"></span></p>
            </div>
            <div class="receiptActions">
                <button id="printReceipt">Cetak Struk</button>
                <button id="closeReceipt">Tutup</button>
            </div>
        </div>
    </div>
    <div class="gallery">
        <div class="galleryItem">
            <h1 class="galleryTitle">Be Yourself!</h1>
            <img src="B project tampilan awak/images.jpg"
                alt="" class="galleryImg">
        </div>
        <div class="galleryItem">
            <img src="B project tampilan awak/no_brands_jayrosse_perfume_rouge_30ml_parfum_pria_edp_30_ml_original_pemikat_jayrose_full04_kal99nkr.webp"
                alt="" class="galleryImg">
            <h1 class="galleryTitle">This is the First Day of Your New Life</h1>
        </div>
        <div class="galleryItem">
            <h1 class="galleryTitle">Just Do it!</h1>
            <img src="B project tampilan awak/tidak_ada_merk_jayrosse_perfume_bruce_parfum_pria_edp_jayrose_original_pemikat_tahan_lama_30ml_full03_ujjnzoj9.webp"
                alt="" class="galleryImg">
        </div>
    </div>
    <div class="newSeason">
        <div class="nsItem">
            <img src="B project tampilan awak/no_brands_jayrosse_perfume_rouge_30ml_parfum_pria_edp_30_ml_original_pemikat_jayrose_full04_kal99nkr.webp"
                alt="" class="nsImg">
        </div>
        <div class="nsItem">
            <h3 class="nsTitleSm">WINTER NEW ARRIVALS</h3>
            <h1 class="nsTitle">New Season</h1>
            <h1 class="nsTitle">New Collection</h1>
            <a href="#nav">
                <button class="nsButton">CHOOSE YOUR STYLE</button>
            </a>
        </div>
        <div class="nsItem">
            <img src="B project tampilan awak/no_brands_jayrosse_perfume_bruce_parfum_pria_edp_jayrose_original_pemikat_tahan_lama_30ml_full02_thwmfx3d.webp"
                alt="" class="nsImg">
        </div>
    </div>
    <footer>
        <div class="footerLeft">
            <div class="footerMenu">
                <h1 class="fMenuTitle">About Us</h1>
                <ul class="fList">
                    <li class="fListItem">Company</li>
                    <li class="fListItem">Contact</li>
                    <li class="fListItem">Careers</li>
                    <li class="fListItem">Affiliates</li>
                    <li class="fListItem">Stores</li>
                </ul>
            </div>
            <div class="footerMenu">
                <h1 class="fMenuTitle">Useful Links</h1>
                <ul class="fList">
                    <li class="fListItem">Support</li>
                    <li class="fListItem">Refund</li>
                    <li class="fListItem">FAQ</li>
                    <li class="fListItem">Feedback</li>
                    <li class="fListItem">Stories</li>
                </ul>
            </div>
            <div class="footerMenu">
                <h1 class="fMenuTitle">Products</h1>
                <ul class="fList">
                    <li class="fListItem">Hedonist</li>
                    <li class="fListItem">Starboy</li>
                    <li class="fListItem">Bruce</li>
                    <li class="fListItem">Rouge</li>
                    <li class="fListItem">Grey</li>
                </ul>
            </div>
        </div>
        <div class="footerRight">
            <div class="footerRightMenu">
                <h1 class="fMenuTitle">Subscribe to our RzStore</h1>
                <div class="fMail">
                    <input type="text" placeholder="your@email.com" class="fInput">
                    <button class="fButton">Join!</button>
                </div>
            </div>
            <div class="footerRightMenu">
                <h1 class="fMenuTitle">Follow Us</h1>
                <div class="fIcons">
                    <img src="./img/facebook.png" alt="" class="fIcon">
                    <img src="./img/twitter.png" alt="" class="fIcon">
                    <img src="./img/instagram.png" alt="" class="fIcon">
                    <img src="./img/whatsapp.png" alt="" class="fIcon">
                </div>
            </div>
            <div class="footerRightMenu">
                <span class="copyright">@RzStore Dev. All rights reserved. 2025.</span>
            </div>
        </div>
    </footer>
    <script src="./app.js"></script>
</body>

</html>