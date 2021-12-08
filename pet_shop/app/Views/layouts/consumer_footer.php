 <!-- Footer Area Start -->
 <div class="footer-area">
   <div class="footer-container">
     <div class="footer-top">
       <div class="container">
         <div class="row">
           <!-- Start single blog -->
           <div class="col-md-6 col-sm-6 col-lg-3 mb-md-30px mb-lm-30px">
             <div class="single-wedge">
               <h4 class="footer-herading">Information</h4>
               <div class="footer-links">
                 <div class="footer-row">
                   <ul class="align-items-center">
                     <!-- <li class="li"><a class="single-link" href="about.html">About us</a></li>
                     <li class="li"><a class="single-link" href="#">Delivery information</a></li>
                     <li class="li"><a class="single-link" href="privacy-policy.html">Privacy
                         Policy</a></li>
                     <li class="li"><a class="single-link" href="#">Sales</a></li>
                     <li class="li"><a class="single-link" href="#">Terms & Conditions</a></li>
                     <li class="li"><a class="single-link" href="#">Shipping Policy</a></li>
                     <li class="li"><a class="single-link" href="#">EMI Payment</a></li> -->
                     <li class="li"><a href="<?= base_url('product'); ?>" class="single-link">Our Products</a></li>
                   </ul>
                 </div>
               </div>
             </div>
           </div>
           <!-- End single blog -->
           <!-- Start single blog -->
           <div class="col-md-6 col-lg-3 col-sm-6 mb-lm-30px">
             <div class="single-wedge">
               <h4 class="footer-herading">Account</h4>
               <div class="footer-links">
                 <div class="footer-row">
                   <ul class="align-items-center">
                     <!-- <li class="li"><a class="single-link" href="my-account.html"> My account</a>
                     </li> -->
                     <?php if (!service('auth')->isLoggedIn()) : ?>
                       <li class="li"><a class="single-link" href="<?= site_url('user/login') ?>">Login / Register</a></li>
                     <?php endif; ?>
                     <?php if (service('auth')->isLoggedIn()) : ?>
                       <li class="li"><a class="single-link" href="<?= site_url('order') ?>">My orders</a></li>
                     <?php endif; ?>
                     <!-- <li class="li"><a class="single-link" href="#">Returns</a></li>
                     <li class="li"><a class="single-link" href="shop-left-sidebar.html">Shipping</a></li>
                     <!-- <li class="li"><a class="single-link" href="wishlist.html">Wishlist</a></li>
                     <li class="li"><a class="single-link" href="#">How Does It Work</a></li>
                     <li class="li"><a class="single-link" href="#">Merchant Sign Up</a></li> -->
                   </ul>
                 </div>
               </div>
             </div>
           </div>
           <!-- End single blog -->
           <!-- Start single blog -->
           <div class="col-md-6 col-lg-2 col-sm-6 mb-sm-30px">
             <div class="single-wedge">
               <h4 class="footer-herading">Store </h4>
               <div class="footer-links">
                 <div class="footer-row">
                   <ul class="align-items-center">
                     <!-- <li class="li"><a class="single-link" href="index.html">Affiliate</a></li>
                     <li class="li"><a class="single-link" href="shop-left-sidebar.html">Bestsellers</a></li>
                     <li class="li"><a class="single-link" href="#">Discount</a></li>
                     <li class="li"><a class="single-link" href="#">Latest products</a></li>
                     <li class="li"><a class="single-link" href="#">Sale</a></li>
                     <li class="li"><a class="single-link" href="#">All Collection</a></li> -->
                     <li class="li"><a class="single-link" href="<?= site_url('contact-us') ?>">Contact Us</a>
                     </li>
                   </ul>
                 </div>
               </div>
             </div>
           </div>
           <!-- End single blog -->
           <!-- Start single blog -->
           <div class="col-md-6 col-lg-4 col-md-6 col-sm-6 pl-120px line-shape">
             <div class="single-wedge ">

               <h4 class="footer-herading">Contact Us</h4>
               <div class="footer-links">
                 <!-- News letter area -->
                 <p class="mail">If you have any question.please <br>
                   contact us at <a href="mailto:queenie@queeniepets.com">queenie@queeniepets.com</a> </p>
                 <p class="address"><i class="pe-7s-map-marker"></i> <span>Unit 2-1, Level 2, The Podium, Tower 3, UOA Business Park, No 1, Jalan Pengaturcara U1/51a, Seksyen U1, 40150 Shah Alam, Selangor.
                     <br>
                   </span> </p>
                 <p class="phone m-0"><i class="pe-7s-phone"></i>
                   <span><a href="tel:016-8120292">+6016-8120292</a></span>
                 </p>

                 <!-- News letter area  End -->
               </div>
             </div>
           </div>
           <!-- End single blog -->
         </div>
       </div>
     </div>
     <div class="footer-bottom">
       <div class="container">
         <div class="line-shape-top">
           <div class="row flex-md-row-reverse align-items-center">
             <div class="col-md-6 text-center text-md-end">
               <!-- <div class="payment-mth"><a href="#"><img class="img img-fluid" src="<?= base_url('assets/assets/images/icons/payment.png') ?>" alt="payment-image"></a></div> -->
             </div>
             <div class="col-md-6 text-center text-md-start">
               <p class="copy-text"> © 2021 <strong>Queenie</strong>
                 <!-- <a class="company-name" href="https://hasthemes.com/"> -->
                 <!-- <strong> HasThemes</strong></a> -->
               </p>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- Footer Area End -->
