<div class="products-grid row gap-2">

    @foreach ($products as $product)
        <div class="product-card col-sm-12 col-md-3 col-lg-3" onclick="toggleProduct(this)">
            <label for="" style="cursor: pointer; display: flex; align-items: center;">
                <input type="checkbox" id="" name="produits[]" value="{{ $product->CodeProduit ?? '' }}" hidden>
                <div>
                    <strong class="text-uppercase">{{ $product->MonLibelle ?? '' }}</strong>
                    <p style="font-size: 12px; color: #666; margin-top: 5px;">
                        <strong>Age Min</strong>
                        <span>{{ $product->AgeMiniAdh ?? '' }} ans</span> - <strong>Age Max</strong>
                        <span>{{ $product->AgeMaxiAdh ?? '' }}</span>
                    </p>
                </div>
            </label>
        </div>
    @endforeach
</div>
