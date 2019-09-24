@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="mb-5 text-center mt-5">Picture Recognition Application</h1>

            <button data-toggle="collapse" style="display: block; width: 100%; margin-bottom: 1rem" data-target="#addItem" aria-expanded="false" type="button" class="btn btn-outline-primary">Add New Item</button>

            <div class="collapse" id="addItem">
                <div class="container register z-elevation-2">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-center">Add Item Details Below.</h1>
                            <br />
                            <form enctype="multipart/form-data" action="/storeitem" method="POST">
                                @csrf
                                <div class="input-group form-group">
                                    <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-exchange"></i></span>
                                    <input name="itemNumber" type="number" placeholder="Item Number" required class="form-control" id="itemNumber" />
                                </div>
                                <div class="input-group form-group">
                                    <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-wrench"></i></span>
                                    <input name="itemCode" type="number" placeholder="Item Code" required class="form-control" id="itemCode" />
                                </div>
                                <div class="input-group form-group">
                                    <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-book"></i></span>
                                    <input type="text" required class="form-control" id="itemName" name="itemName" placeholder="Item Name" />
                                </div>
                                <div class="input-group form-group">
                                    <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-pie-chart"></i></span>
                                    <input type="text" required class="form-control" id="itemCategory" name="itemCategory" placeholder="Item Category" />
                                </div>
                                <div class="input-group form-group">
                                    <span class="input-group-addon icon d-flex justify-content-center align-items-center pr-3"><i class="fa fa-italic"></i></span>
                                    <textarea type="text" required class="form-control" id="itemDescription" placeholder="Item Description" name="itemDescription" rows="4"></textarea>
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
                        </div>
                    </div>
                </div>
            </div>



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

        });
    </script>
    @endsection