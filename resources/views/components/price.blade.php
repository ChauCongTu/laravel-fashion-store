@if ($discount != $price)
    <span class="text-danger fw-bold">{{ number_format($discount, 0, ",", ".") }}đ</span> <del class="del text-muted small"><i> {{ number_format($price, 0, ",", ".") }}đ</i></del>
@else
    <span class="text-muted fw-bold">{{ number_format($price, 0, ",", ".") }}đ</span>
@endif
