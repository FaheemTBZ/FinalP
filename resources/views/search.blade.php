@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!--==========================
                    Intro Section
            ============================-->
            <section class="clearfix">
                <div class="container">

                    <div class="intro-info">
                        <h1 class="text-center">Search for the Items Below by selecting any Criteria...</h1>
                    </div>

                    <br />

                    <form action="/searchpicture" method="POST" id="theItemForm" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="itemSelect">Search By:</label>
                            <select class="form-control form-control-lg" id="itemSelect">
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
                        <div class="text-center">
                            <button type="submit" class="btn rounded btn-cyan btn-lg" id="btnSubmit" disabled>Search</button>
                        </div>
                    </form>

                </div>
            </section>
            <br />
            <br />

            <section class="row">
                <article class="col">
                    @if( isset($itemData) && strpos($itemData['item_images'], '|') === false )
                    <div class="card card-item rounded-lg">
                        <div class="card-body">
                            <h4 class="card-title"><a>{{ $itemData['item_name'] }}</a></h4>
                            <h6 class="card-subtitle">Code: {{ $itemData['item_code'] }} | Category: {{ $itemData['item_category'] }}</h6>
                            <p class="card-text mt-2">{{ $itemData['item_description'] }}</p>
                            <div class="itemPicCat">
                                <img src="/image/{{ $itemData['item_images'] }}" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                    @endif

                    @if( isset($itemData) && strpos($itemData['item_images'], '|') !== false )
                    <div class="card card-item rounded-lg">
                        <div class="card-body">
                            <h4 class="card-title"><a>{{ $itemData['item_name'] }}</a></h4>
                            <h6 class="card-subtitle">Code: {{ $itemData['item_code'] }} | Category: {{ $itemData['item_category'] }}</h6>
                            <p class="card-text mt-2">{{ $itemData['item_description'] }}</p>
                            <hr />
                            <section class="img-container d-flex">
                                @foreach( explode('|', $itemData['item_images']) as $pic )
                                <img src="/image/{{ $pic }}" alt="{{ $itemData['item_name'] }}" />
                                @endforeach
                            </section>
                        </div>
                    </div>
                    @endif

                    @if( isset($pictures))
                    <section class="row">
                        @foreach( $pictures as $picture )
                        <article class="col itemPic">
                            <form action="/showitemcategories" method="POST" class="itemPicForm">
                                @csrf
                                <input type="hidden" name="picItemCategory" value="{{ array_key_exists('category', $picture) ? $picture['category'] : 'No Category' }}" />
                                <div class="itemPic shadow">
                                    <img src="/image/{{ array_key_exists('pic', $picture) ? $picture['pic'] : 'No Image'  }}" alt="{{ array_key_exists('category', $picture) ? $picture['category'] : 'Picture Item Details' }}" />
                                </div>
                            </form>
                        </article>
                        @endforeach
                    </section>
                    @endif

                    @if( isset($allCategories) )
                    <section class="row">
                        @foreach( $allCategories as $cat )
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title">{{ $cat['item_category'] }}</h1>
                                    <h4 class="card-subtitle">Code: {{ $cat['item_code'] }} | Name: {{ $cat['item_name'] }}</h4>
                                    <br />
                                    <p class="card-text">{{ $cat['item_description'] }}</p>
                                    @if( strpos($cat['item_images'], '|') === false )
                                    <div class="itemPicCat d-flex">
                                        <img src="/image/{{ $cat['item_images'] }}" alt="">
                                    </div>
                                    @else
                                    <div class="itemPicCat d-flex">
                                        @foreach( explode('|', $cat['item_images']) as $pic )
                                        <img src="/image/{{ $pic }}" alt="">
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </section>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </article>
            </section>

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

        $('.itemPicForm').on('click', function() {
            this.submit();
        });

    });
</script>
@endsection