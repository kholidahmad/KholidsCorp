<!-- Start Contact us Section -->
<section class="bg-contact-us">
    <div class="container">
        <div class="row">
            <div class="contact-us">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li role="presentation" class="active">
                                <a data-toggle="pill" href="#pills-organisasion-chart">Organisasion Chart</a>
                            </li>
                            <li>
                                <a data-toggle="pill" href="#pills-job-detail">Job Details</a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane fade in active" id="pills-organisasion-chart">
                                <h1>Organization Chart</h1>
                                <img src="<?= base_url('assets/upload/image/struktur-organisasi-2022-sept.jpg') ?>" alt="organisasion-chart">
                            </div>

                            <div class="tab-pane fade" id="pills-job-detail">
                                <div class="container" style="margin-top: 50px;">
                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: 20px;">
                                            <?php $no = 1;
                                            foreach ($bagian as $i_bagian) { ?>
                                                <h3 style="color: black;"><?= $no++ ?>. <?= $i_bagian['nama_bagian']; ?></h3>
                                                <p><?= $i_bagian['keterangan']; ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- .row -->
            </div>
            <!-- .contact-us -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- End Contact us Section -->