@if ($discount != 0)
    <span class="text-muted">{{ number_format($discount, 0, ",", ".") }}đ <del class="del"><i> {{ number_format($price, 0, ",", ".") }}đ</i></del></span>
@else
    <span class="text-muted">{{ number_format($price, 0, ",", ".") }}đ</span>
@endif
