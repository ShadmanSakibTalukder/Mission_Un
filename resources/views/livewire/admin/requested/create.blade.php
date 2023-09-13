
    <x-slot:title>
        Create Requested Order
    </x-slot:title>
    @if (session()->has('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session()->has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap align-item-center pt-3 pb-2 mb-3 mb-3 border-bottom">
                    <h4 class="h2">Create Requested Order</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-section">
                    <div class="table responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Parts No.</th>
                                    <th>Nomenclature</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Parts No.</td>
                                    <td>Nomenclature</td>
                                    <td>Qty</td>

                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label for="requested_id" class="form-label">Requested Order:</label>
                            <input type="unsignedBigInteger" class="form-control" id="requested_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="part_no" class="form-label">Requested By:</label>
                            <input type="integer" class="form-control" id="part_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomenclature" class="form-label">Issue Date:</label>
                            <input type="string" class="form-control" id="nomenclature" name="nomenclature" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="qty" class="form-label">Qty:</label>
                            <input type="integer" class="form-control" id="qty" name="qty" required>
                        </div> -->
                        <div class="my-5 d-flex justify-content-end p-3">
                            <button type="submit" class="btn btn-md btn-outline-primary px-3 mx-2">
                                <span wire:loading.remove wire:target="codOrder">Save</span>
                                <span wire:loading wire:target="codOrder">Saving Requested Order</span>
                            </button>
                            <a href="#" class="btn btn-md btn-outline-secondary">Back</a>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-6">
                <div class="search-section">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search parts">
                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-search"></i></button>
                    </div>
                </div>
                <div class="listbox-section">
                    <div class="listbox">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Parts No.</th>
                                    <th>Nomenclature</th>
                                    <th>QTY</th>
                                    <th>Add</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Part Number</td>
                                    <td>Nomenclature</td>
                                    <td><input type="qty" class="form-control" id="qty"></td>
                                    <td>
                                        <button type="button" class="btn btn1 rounded mb-5" title="{{__('Add To PO')}}">
                                            <i class="fa fa-plus fa-bounce"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
