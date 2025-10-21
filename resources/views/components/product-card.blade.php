<!-- Start Single Product -->
<div class="single-product">
    <div class="product-image">
        <img src="{{ $product->image_url }}" alt="#">
        @if ($product->sale_percent)
        <span class="sale-tag">-{{ $product->sale_percent }}%</span>
        @endif
        @if ($product->new)
        <span class="new-tag">New</span>
        @endif
        <div class="button">
            <button data-id="{{$product->id}}" data-quantity="1" class="btn add-to-cart"><i class="lni lni-cart "></i> Add to Cart</button>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name }}</span>
        <h4 class="title">
            <a href="{{ route('front.products.show', $product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">


        </ul>
        <div class="price">
            <span>{{ App\Helpers\Currency::format($product->price) }}</span>
            @if ($product->compare_price)
            <span class="discount-price">{{ app\Helpers\Currency::format($product->compare_price) }}</span>
            @endif
        </div>
    </div>
</div>
<!-- End Single Product -->
