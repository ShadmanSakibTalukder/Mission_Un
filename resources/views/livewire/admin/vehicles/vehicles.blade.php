<x-slot:title>
    Create Requested Order
</x-slot:title>
{{-- @if (session()->has('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif (session()->has('success_message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success_message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between flex-wrap align-item-center pt-3 pb-2 mb-3 mb-3 border-bottom">
                <h4 class="h2">Create Vehicles</h4>
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
                                <th> SL</th>
                                <th>Parts No.</th>
                                <th>Nomenclature</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>



                        </tbody>
                    </table>
                </div>

                <form wire:submit.prevent="">
                    
                    <div class="mb-3">
                        <label for="requested_order_no" class="form-label">VIN No:</label>
                        <input type="text" class="form-control" id="requested_order_no" wire:model.defer="requested_order_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="requested_by" class="form-label">Captain:</label>
                        <input type="text" class="form-control" id="requested_by" wire:model.defer="requested_by" required>
                    </div>
                    <div class="mb-3">
                        <label for="requested_date" class="form-label">Date</label>
                        <input type="date" id="requested_date" name="requested_date" wire:model.defer="requested_date" class="form-control" required>
                    </div>
                    {{-- <div class="my-5 d-flex justify-content-end p-3">
                        <button type="button" wire:click="quotationOrder()" wire:loading.attr="disabled" wire:target="quotationOrder" class="btn btn-md btn-outline-primary px-3 mx-2">
                            <span wire:loading.remove wire:target="quotationOrder">Save</span>
                            <span wire:loading wire:target="quotationOrder">Saving Vehicles</span>
                        </button>
                        <a href="#" class="btn btn-md btn-outline-secondary">Back</a>
                    </div> --}}
                </form>

            </div>
        </div>
        <div class="col-md-6">
            <div class="search-section">
                <div class="input-group">
                    <input type="text" class="form-control search" id="search" wire:model="searchTerm" placeholder="Search Parts">
                </div>
            </div>
            <div class="listbox-section">
                <div class="listbox">
                    <table class="table table-bordered tableData">
                        <thead>
                            <tr>
                                <th>Parts No.</th>
                                <th>Nomenclature</th>
                                <th>QTY</th>
                                <th>Add</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" id="part_no" wire:model.defer="part_no" name="part_no">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="nomenclature" wire:model.defer="nomenclature" name="nomenclature">
                                </td>
                                <td>
                                    <input type="qty" class="form-control" id="qty" wire:model.defer="qty" name="qty">
                                </td>
                                <td><button type="button" wire:click="addToListStatic()" wire:loading.attr="disabled" wire:target="addToListStatic({{ $part_no }})" class="btn btn1 rounded mb-5" title="{{__('Add To Quotation')}}">
                                    <span wire:loading.remove wire:target="addToListStatic({{ $part_no }})">
                                        <i class="fa fa-plus fa-bounce"></i>
                                    </span>
                                    <span wire:loading wire:target="addToListStatic({{ $part_no }})">{{__('Adding...')}}</span>
                                </button></td>
                            </tr>
                            @forelse ($parts as $item)
                            <tr>
                                <td>{{$item['requestedPartNo']}}</td>
                                <td>{{$item['requestedNomenclature']}}</td>
                                <td><input type="qty" class="form-control" id="qty" wire:model.defer="qty" name="qty"></td>

                                <td>
                                    <button type="button" wire:click="addToListDynamic({{$item['id']}})" class="btn btn1 rounded" title="{{__('Add To List')}}">
                                        <span wire:loading.remove wire:target="addToListDynamic">
                                            <i class="fa-solid fa-plus fa-bounce"></i>
                                        </span>
                                        <span wire:loading wire:target="addToListDynamic">{{__('Adding...')}}</span>
                                    </button>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td>No Parts Available</td>
                            </tr>
                            @endforelse


                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        
    <script>
        const searchInput = document.getElementById('search');
        const tableRows = document.querySelectorAll('#tableData tr');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();

            tableRows.forEach((row) => {
                const rowData = row.textContent.toLowerCase();
                if (rowData.includes(searchTerm) || searchTerm === '') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
    @endpush
</div>