@extends('layouts.app')

@section('content')
<div class="container home-page-container" id="containerMain">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!--==========================
                    Intro Section
            ============================-->
            <section id="intro" class="clearfix sec">
                <div class="container">

                    <div class="intro-info">
                        <h2>We provide<br><span>solutions</span><br>for your business!</h2>
                        <div>
                            <button type="button" id="btnGetStarted" class="btn rounded btn-get-started btn-lg btn-outline-light">Get Started</button>
                        </div>
                    </div>

                </div>
            </section>

            <!--==========================
      Services Section
    ============================-->
            <section id="services" class="section-bg">
                <div class="container">

                    <header class="section-header">
                        <h1 class="text-center">Services.</h1>
                    </header>
                    <br />
                    <div class="row">

                        <div class="col-md-6 col-lg-5 offset-lg-1">
                            <div class="box">
                                <div class="icon"><i class="ion-ios-analytics-outline" style="color: #ff689b;"></i></div>
                                <h4 class="title"><span>Search by Name</span></h4>
                                <p class="description">Search any type of item by providing its name.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-5">
                            <div class="box">
                                <div class="icon"><i class="ion-ios-bookmarks-outline" style="color: #e9bf06;"></i></div>
                                <h4 class="title"><span>Search by Code</span></h4>
                                <p class="description">Search any type of item by providing its code.</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-5 offset-lg-1">
                            <div class="box">
                                <div class="icon"><i class="ion-ios-paper-outline" style="color: #3fcdc7;"></i></div>
                                <h4 class="title"><span>Search by Category</span></h4>
                                <p class="description">Get items of any type by providing category.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-5">
                            <div class="box">
                                <div class="icon"><i class="ion-ios-speedometer-outline" style="color:#41cf2e;"></i></div>
                                <h4 class="title"><span>Search by Picture</span></h4>
                                <p class="description">Search all the Items of same categories by picture.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </section><!-- #services -->

            <!--==========================
                    Intro Section
            ============================-->
            <section class="clearfix sec" id="addDetails">
                <div class="container">

                    <div class="intro-info">
                        <h2 class="text-center">Add Items or Supplier Details Here!</h2>
                        <div class="text-center">
                            <button data-toggle="modal" data-target="#addItem" aria-expanded="false" type="button" class="btn btn-outline-light btn-get-started rounded">Add Item Details</button>
                            <button id="btnSupplier" data-toggle="modal" data-target="#addItem" aria-expanded="false" type="button" class="btn ml-2 mt-1 rounded btn-outline-light btn-get-started">Add Supplier Details</button>
                        </div>
                    </div>

                </div>
            </section>
        
            <section class="footer p-4" style="background-color: #eee">
                <div class="text-center">All Rights Reserved &copy; 2019</div>
            </section>
            
            <!-- Item Dialog -->
            <aside class="modal fade" id="addItem">
                <section class="modal-dialog modal-dialog-centered is-rounded">
                    <article class="modal-content p-4 shadow-lg">
                        <h2 class="text-center">Add New Item Detail Below</h2>
                        <br />
                        <form enctype="multipart/form-data" action="/storeitem" method="POST">
                            @csrf
                            <div class="input-group form-group">
                                <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-exchange"></i></span>
                                <input name="itemNumber" type="number" placeholder="Item Number" required class="form-control @error('ItemNumber') is-invalid @enderror" id="itemNumber" />
                                @error('ItemNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-wrench"></i></span>
                                <input name="itemCode" type="number" placeholder="Item Code" required class="form-control @error('ItemCode') is-invalid @enderror" id="itemCode" />
                                @error('ItemCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-book"></i></span>
                                <input type="text" required class="form-control @error('ItemName') is-invalid @enderror" id="itemName" name="itemName" placeholder="Item Name" />
                                @error('ItemName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-pie-chart"></i></span>
                                <input type="text" required class="form-control @error('ItemCategory') is-invalid @enderror" id="itemCategory" name="itemCategory" placeholder="Item Category" />
                                @error('ItemCategory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-italic"></i></span>
                                <textarea type="text" required class="form-control @error('ItemDescription') is-invalid @enderror" id="itemDescription" placeholder="Item Description" name="itemDescription" rows="4"></textarea>
                                @error('ItemDescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-link"></i></span>
                                <input multiple type="file" id="itemPictures" name="itemPictures[]" required />
                            </div>
                            <div class="preview" id="previewImages"></div>
                            <div class="input-group form-group">
                                <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i></i></span>
                                <button type="submit" class="btn btn-block btn-primary" id="btnSubmit1">Submit Data</button>
                            </div>
                        </form>
                    </article>
                </section>
            </aside>

        </div>
    </div>


    <script>
        $(document).ready(function() {

            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#itemPictures').change(function() {
                imagesPreview(this, '#previewImages');
            });
            
            $('#btnTop').on('click', function(){
                $('html, body').animate({
                    scrollTop: 0
                }, 'slow');
            });
            
            $('#btnGetStarted').on('click', function(){
                $('html, body').animate({
                    scrollTop: 1000
                }, 'slow');
            });

            $('#itemNumber').tooltip({'trigger':'hover', 'title': 'Enter Item Number, Numbers only'});
            $('#itemCode').tooltip({'trigger':'hover', 'title': 'Enter Item code, Numbers only'});
            $('#itemName').tooltip({'trigger':'hover', 'title': 'Enter Item name'});
            $('#itemCategory').tooltip({'trigger':'hover', 'title': 'Enter Item Category'});
            $('#itemDescription').tooltip({'trigger':'hover', 'title': 'Enter Items Description'});


        });
    </script>
    @endsection