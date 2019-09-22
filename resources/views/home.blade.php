@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="mb-5 text-center mt-5">Picture Recognition Application</h1>

            <button data-toggle="modal" style="display: block; width: 100%; margin-bottom: 1rem" data-target="#addItem" aria-expanded="false" type="button" class="btn btn-outline-primary">Add New Item</button>

            <div class="modal fade" tabindex="-1" role="dialog" id="addItem">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/storeitem" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="itemNumber">Item Number</label>
                                    <input name="itemNumber" type="number" required class="form-control" id="itemNumber" />
                                </div>
                                <div class="form-group">
                                    <label for="itemCode">Item Code</label>
                                    <input name="itemCode" type="number" required class="form-control" id="itemCode" />
                                </div>
                                <div class="form-group">
                                    <label for="itemName">Item Name</label>
                                    <input type="text" required class="form-control" id="itemName" name="itemName" />
                                </div>
                                <div class="form-group">
                                    <label for="itemCategory">Item Category</label>
                                    <input type="text" required class="form-control" id="itemCategory" name="itemCategory" />
                                </div>
                                <div class="form-group">
                                    <label for="itemDescription">Item Description</label>
                                    <textarea type="text" required class="form-control" id="itemDescription" name="itemDescription" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="itemImages">Attach Images</label> <br />
                                    <input multiple type="file" id="itemPictures" name="itemPictures[]" required />
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <button style="width: 100%; display: block" data-toggle="modal" data-target="#addSupplier" aria-expanded="false" type="button" class="btn btn-outline-primary">Supplier Details</button>

            <div class="modal fade" tabindex="-1" role="dialog" id="addSupplier">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Supploer Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/storeitem" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="itemNumber">Item Number</label>
                                    <input name="itemNumber" type="number" required class="form-control" id="itemNumber" />
                                </div>
                                <div class="form-group">
                                    <label for="itemCode">Item Code</label>
                                    <input name="itemCode" type="number" required class="form-control" id="itemCode" />
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection