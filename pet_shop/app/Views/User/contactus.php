<?= $this->extend('layouts/consumer_default') ?>

<?= $this->section('title') ?>Contact Us<?= $this->endSection() ?>

<?= $this->section('page') ?>Contact Us<?= $this->endSection() ?>

<?= $this->section('page-module-link') ?><?= site_url('/') ?><?= $this->endSection() ?>

<?= $this->section('page-module') ?>Home<?= $this->endSection() ?>

<?= $this->section('page-active') ?>Contact Us<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Contact Area Start -->
<div class="contact-area pt-100px pb-100px">
    <div class="container">
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-info">
                        <span class="sub-title">Get In Touch</span>
                        <h4 class="heading">Visit Our Shop
                            Contact Us Now</h4>
                        <!-- <div class="single-contact">
                            <div class="icon-box">
                                <i class="pe-7s-clock"></i>
                            </div>
                            <div class="info-box">
                                <h5 class="title">Working Hours:</h5>
                                <p><a href="tel:0123456789">9AM-6PM</a></p>
                            </div>
                        </div> -->
                        <div class="single-contact">
                            <div class="icon-box">
                                <i class="pe-7s-call"></i>
                            </div>
                            <div class="info-box">
                                <h5 class="title">Phone:</h5>
                                <p><a href="tel:0123456789">+6016-812 0292</a></p>
                            </div>
                        </div>
                        <div class="single-contact">
                            <div class="icon-box">
                                <i class="pe-7s-mail"></i>
                            </div>
                            <div class="info-box">
                                <h5 class="title">Email:</h5>
                                <p><a href="mailto:demo@example.com">queenie0292@gmail.com</a></p>
                            </div>
                        </div>
                        <div class="single-contact">
                            <div class="icon-box">
                                <i class="pe-7s-map-marker"></i>
                            </div>
                            <div class="info-box">
                                <h5 class="title">Address:</h5>
                                <p>Unit 2-1, Level 2, The Podium, Tower 3, UOA Business Park, No 1, Jalan Pengaturcara U1/51a, Seksyen U1, 40150 Shah Alam, Selangor</p>
                            </div>
                        </div>
                        <ul class="social">
                            <li class="m-0">
                                <a href="https://www.facebook.com/Queenie-Pets-Malaysia-103288374705872/"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="http://wa.me/60168120292"><i class="fa fa-whatsapp"></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/queeniepetssdnbhd/?hl=en"><i class="fa fa-instagram"></i></a>
                            </li>
                            <!-- <li>
                                <a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
                            </li> -->

                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="contact-form">
                        <div class="contact-title mb-30">
                            <h2 class="title" data-aos="fade-up" data-aos-delay="200">Leave a Message</h2>
                            <p>Leave a message and we will get back to you shortly. </p>
                        </div>
                        <form class="contact-form-style" id="contact-form" action="assets/php/mail.php" method="post">
                            <div class="row">
                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                    <input name="name" placeholder="Name*" type="text" />
                                </div>
                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                    <input name="email" placeholder="Email*" type="email" />
                                </div>
                                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                                    <input name="subject" placeholder="Subject*" type="text" />
                                </div>
                                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                                    <textarea name="message" placeholder="Your Message*"></textarea>
                                    <button class="btn btn-primary mt-4" data-aos="fade-up" data-aos-delay="200" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Area End -->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('layouts/sweetalert') ?>
<?= $this->endSection() ?>