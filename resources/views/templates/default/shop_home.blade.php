@extends(SITE_THEME.'.shop_layout')

@section('center')
    <div class="h_pHot">
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12 home_title">
                <h2>{{ trans('language.features_items') }}</h2>

                <img src="{{ asset(SITE_THEME_ASSET.'/images/border-bottom.png')}}" alt="Border bottom"/>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">

                <div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi"
                     data-interval="3500">
                    <div class="carousel-inner">
                        @foreach ($products_new as  $key => $product_new)
                            <div class="item  {{ ($key)?'':'active' }} ">
                                <div class="carousel-col">
                                    <div class="h_pHot_child">
                                        <a href="{{ $product_new->getUrl() }}"
                                           title="{{ $product_new->name }}">
                                            <p style="background-image: url({{ asset($product_new->getThumb()) }});">
                                            </p>
                                            <b>{{ $product_new->name }}</b>
                                            <span>Giá: {!! $product_new->showPrice() !!}</span>
                                        </a>
                                        <a href="tel:{{ $configsGlobal['long_phone'] }}" title="Hotline tư vấn"
                                           class="hotline_top">{{ $configsGlobal['long_phone'] }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <div class="left carousel-control">
                        <a href="#carousel" role="button" data-slide="prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </div>
                    <div class="right carousel-control">
                        <a href="#carousel" role="button" data-slide="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="h_pCategory">
        <div class="container">
            @foreach ($categories[0] as $key => $category)
                <div class="col-md-12 col-sm-12 col-xs-12 home_title">
                    <h2>{{$category->name}}</h2>
                    <img data-sizes="100w" src="{{ asset(SITE_THEME_ASSET.'/images/border-bottom.png')}}"
                         data-src="{{ asset(SITE_THEME_ASSET.'/images/border-bottom.png')}}" alt="{{$category->name}}"/>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 home_readmore">
                    <a href="{{$category->getUrl()}}" title="Xem tất cả">Xem tất cả</a>
                </div>

                @foreach ($category->getProductsToCategory($category->id,8) as $product)
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="h_pCategory_child">
                            <a href="{{$product->getUrl()}}">
                                <p style="background-image: url({{ asset($product->getThumb()) }});">
                                </p>
                                <b>{{ $product->name }}</b>
                                <span>{!! $product->showPrice() !!}</span>
                            </a>
                        </div>
                    </div>
                @endforeach

            @endforeach

        </div>
    </div>
@endsection
@section('news')
    <div class="h_news">
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12 home_title">
                <h3>Tin tức & Sự kiện</h3>
                <img data-sizes="100w" src="{{ asset(SITE_THEME_ASSET.'/images/border-bottom.png')}}"
                     data-src="{{ asset(SITE_THEME_ASSET.'/images/border-bottom.png')}}" alt="thu hien store"/>
            </div>
			<?php
			//print_r(count($news)); die();
			$newTotal = count($news);
			?>
			<?php $item = 0; $rowNumber = ceil($newTotal / 4); $columnStt = 1;?>
            @foreach ($news as $newsDetail)
				<?php if($item % $rowNumber === 0):?>
                <div class="col-sm-3 item col-xs-12">
					<?php endif;?>
                    <div class="h_news_child">
                        <a href="{{ $newsDetail->getUrl() }}"
                           title="{{ $newsDetail->title }}">
                            <p style="background-image: url({{ asset($newsDetail->getThumb()) }})"></p>
                            <b>{{ $newsDetail->title }}</b>
                        </a>
                    </div>
					<?php if((($item + 1) % $rowNumber) == 0):?>
					<?php if (($rowNumber > 1) && ($columnStt == $newTotal % 4) && (($item + 1) % $columnStt == 0)) {
						$rowNumber--;
						$item += (($rowNumber - 1) - ($item % $rowNumber));
					}?>
					<?php $columnStt++?>
                </div>
				<?php endif;?>
				<?php $item++?>
            @endforeach
            <div class="col-md-12 col-sm-12 col-xs-12 text_align_center">
                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination">
                        {{ $news->links() }}
                    </div>
                </div>
                <!-- Pagination -->

            </div>
        </div>
    </div>
@endsection


@push('styles')
@endpush

@push('scripts')

@endpush
