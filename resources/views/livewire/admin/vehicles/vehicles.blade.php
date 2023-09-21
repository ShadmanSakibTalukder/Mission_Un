<x-slot:title>
    Create Vehicle
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
                <h4 class="h2">Create Vehicle</h4>
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
                            @forelse ($added_to_list as $item)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->part_no }}</td>
                                <td>{{ $item->nomenclature }}</td>
                                <td>{{ $item->qty }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No items added yet.</td>
                            </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>

                <form wire:submit.prevent="vehicleOrder">
                    
                    <div class="mb-3">
                        <label for="vin_no" class="form-label">VIN No:</label>
                        <input type="text" class="form-control" id="vin_no" wire:model.defer="vin_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="captain" class="form-label">Captain:</label>
                        <input type="text" class="form-control" id="captain" wire:model.defer="captain" required>
                    </div>
                    <div class="mb-3">
                        <label for="vin_date" class="form-label">Date</label>
                        <input type="date" id="vin_date" name="vin_date" wire:model.defer="vin_date" class="form-control" required>
                    </div>
                    <div class="my-5 d-flex justify-content-end p-3">
                        <button type="button" wire:click="vehicleOrder()" wire:loading.attr="disabled" wire:target="vehicleOrder" class="btn btn-md btn-outline-primary px-3 mx-2">
                            <span wire:loading.remove wire:target="vehicleOrder">Save</span>
                            <span wire:loading wire:target="vehicleOrder">Saving Vehicles</span>
                        </button>
                        <a href="#" class="btn btn-md btn-outline-secondary">Back</a>
                    </div>
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
                        <tbody>
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
                                <td><button type="button" wire:click="vehicleListStatic()" wire:loading.attr="disabled" wire:target="vehicleListStatic({{ $part_no }})" class="btn btn1 rounded mb-5" title="{{__('Add To Vehicle')}}">
                                    <span wire:loading.remove wire:target="vehicleListStatic({{ $part_no }})">
                                        <i class="fa fa-plus fa-bounce"></i>
                                    </span>
                                    <span wire:loading wire:target="vehicleListStatic({{ $part_no }})">{{__('Adding...')}}</span>
                                </button></td>
                            </tr>
                            @forelse ($parts as $item)
                            <tr>
                                <td>{{$item['requestedPartNo']}}</td>
                                <td>{{$item['requestedNomenclature']}}</td>
                                <td><input type="qty" class="form-control" id="qty" wire:model.defer="qty" name="qty"></td>

                                <td>
                                    <button type="button" wire:click="vehicleListDynamic({{$item['id']}})" class="btn btn1 rounded" title="{{__('Add To List')}}">
                                        <span wire:loading.remove wire:target="vehicleListDynamic">
                                            <i class="fa-solid fa-plus fa-bounce"></i>
                                        </span>
                                        <span wire:loading wire:target="vehicleListDynamic">{{__('Adding...')}}</span>
                                    </button>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td>No Parts Available</td>
                            </tr>
                            @endforelse


                        </tbody>
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