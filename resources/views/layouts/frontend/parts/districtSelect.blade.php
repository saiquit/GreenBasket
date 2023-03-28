<!-- Modal -->
<div class="modal fade" id="selectDistrict" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="selectDistrictLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectDistrictLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="cart-total mb-3">
                    <h3>Estimate shipping</h3>
                    <p>Enter your destination to get a shipping estimate</p>
                    <form action="{{ route('cart.calculateDelivery') }}" method="POST" id="estimate_delivery"
                        class="info">
                        @csrf
                        <div class="form-group">
                            <label for="country">District</label>
                            <select name="district" id="" class="form-control left-left px-3">
                                @foreach (request()->districts as $district)
                                    <option value="{{ $district->id }}" @selected($district->id == session('cart.district_id'))>
                                        {{ $district['name_' . app()->getLocale()] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" id="estimate_btn" class="btn btn-primary text-white py-3 px-4">Select
                            District</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
