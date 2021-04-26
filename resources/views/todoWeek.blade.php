@include('layouts.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Developer Weekly Task</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Weekly Task</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php

echo "<pre>";
//print_r($developerTask);
echo "</pre>";
?>
<!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card" style="padding: 20px;">
                <div class="row">
                    <?php

                    foreach ($developerTask as $dtKey => $developer){


                    ?>
                    <div class="col-12 col-sm-6 col-md-4 d-flex_ align-items-stretch"
                         style="min-height: 300px; height: 300px;">
                        <div class="card bg-light">

                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="lead" style="margin-top: 15px;"><b><?php echo $dtKey;?></b></h2>

                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <?php foreach ($developer as $dk => $dv){ ?>
                                            <?php
                                            $jobs = 0;
                                            foreach ($dv["jobs"] as $jKey => $jVal) {
                                                $jobs++;
                                            } ?>
                                            <li style="margin-bottom: 5px;"
                                                data-jobs='<?php echo json_encode($dv["jobs"]); ?>' class="small">
                                                <b><?php echo $dk; ?> </b>: <?php echo $jobs; ?> Task <a
                                                    style="color: #fafafa; padding: .1rem .2rem;"
                                                    class="btn btn-info btn-sm"><span
                                                        class="fas fa-arrow-circle-right"></span> </a></li>

                                            <?php } ?>


                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">


                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div data-modal-content></div>
        </div>
    </div>
</div>
<!-- /.control-sidebar -->
@include('layouts.footer')

<script>
    $(document).ready(function () {

        $("[data-jobs]").click(function () {

            $('#myModal').modal('show');
            let _data = $(this).data("jobs");

            let _table = "<table class='table table-hover'>" +
                "<tr>" +
                "<th>Title</th>" +
                "<th>Duration</th>" +
                "<th>Difficulty</th>" +
                "</tr>";

            $(_data).each(function (index, val) {
                console.log(index + ": " + val);
                _table += "<tr>" +
                    "<td>" + val.title + "</td>" +
                    "<td>" + val.duration + "</td>" +
                    "<td>" + val.difficulty + "</td>" +
                    "</tr>";
            });

            _table += "</table>";

            $('[data-modal-content]').html(_table);
        });


    });
</script>
