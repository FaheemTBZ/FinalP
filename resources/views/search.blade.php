@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!--==========================
                    Intro Section
            ============================-->
            <section id="intro" class="clearfix sec">
                <div class="container">

                    <div class="intro-info">
                        <h2>Search for the Items Below by selecting any Criteria...</h2>
                    </div>

                    <br />

                    <form action="/searchpicture" method="POST" id="theItemForm" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="itemSelect">Search By:</label>
                            <select class="form-control" id="itemSelect">
                                <option value="0">Select</option>
                                <option value="1">Item Code</option>
                                <option value="2">Item Name</option>
                                <option value="3">Item Picture</option>
                                <option value="4">Item Category</option>
                            </select>
                        </div>
                        <div class="collapse" id="itemCodeContainer">
                            <div class="form-group">
                                <label for="itemCode">Item Code</label>
                                <input type="number" id="itemCode" name="itemCode" class="form-control" />
                            </div>
                        </div>
                        <div class="collapse" id="itemNameContainer">
                            <div class="form-group">
                                <label for="itemName">Item Name</label>
                                <input type="text" id="itemName" name="itemName" class="form-control" />
                            </div>
                        </div>
                        <div class="collapse" id="itemCategoryContainer">
                            <div class="form-group">
                                <label for="itemCategory">Item Category</label>
                                <input type="text" id="itemCategory" class="form-control" name="itemCategory" />
                            </div>
                        </div>
                        <input type="hidden" id="itemUnit" name="itemUnit" />
                        <button type="submit" class="btn btn-outline-light btn-get-started btn-lg" id="btnSubmit" disabled>Search</button>

                    </form>

                </div>
            </section>

            <footer class="footer p-4" style="background: #eee">
                <div class="text-center">All Rights Reserved &copy 2019</div>
            </footer>

            <button type="button" class="btn btnTop">
                <i class="fa fa-arrow-up"></i>
            </button>



            @if( isset($itemData) )
            <hr />
            <h4>{{ $itemData['item_name'] }}</h4>
            <h6>{{ $itemData['item_code'] }}</h6>
            <p>{{ $itemData['item_description'] }}</p>

            @foreach( explode('|', $itemData['item_images']) as $pic )
            <div class="row">
                <div class="col">
                    <img style="width: 100%; height: 400px; margin-top: 1rem" src="/image/{{ $pic }}" alt="" />
                </div>
            </div>
            @endforeach

            @endif

            @if( isset($pictures) )
            <hr />
            @foreach( $pictures as $picture )
            <div class="row">
                <div class="col">
                    <img style="width: 100%; height: 400px; margin-top: 1rem" src="/image/{{ $picture }}" alt="" />
                </div>
            </div>
            @endforeach

            @endif

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#itemSelect').change(function() {

            $('#btnSubmit').attr('disabled', false);
            $('.collapse').collapse('hide');
            var option = $(this).val();

            if (option === '1') {
                $('#itemCodeContainer').collapse('show');
                $('#itemUnit').val('itemCode');
            } else if (option === '2') {
                $('#itemNameContainer').collapse('show');
                $('#itemUnit').val('itemName');
            } else if (option === '3') {
                $('#itemUnit').val('itemPicture');
                $('#theItemForm').submit();
            } else if (option === '4') {
                $('#itemUnit').val('itemCategory');
                $('#itemCategoryContainer').collapse('show');
            }
        });

        $('.btnTop').on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        });

    });
</script>
@endsection