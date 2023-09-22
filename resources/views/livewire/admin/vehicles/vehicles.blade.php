<x-slot:title>
    Create Vehicle
</x-slot:title>

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
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($added_to_list as $item)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->part_no }}</td>
                                <td>{{ $item->nomenclature }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>
                                    <div class="remove">
                                        <button type="button" wire:click="removeListItem({{ $item->id }})" wire:loading.attr="disabled" class="btn btn-danger btn-sm" title="{{__('Remove')}}">
                                            <span wire:loading.remove wire:target="removeListItem({{ $item->id }})">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                            <span wire:loading wire:target="removeListItem({{ $item->id }})">{{__('Removing')}}</span>
                                        </button>
                                    </div>
                                </td>
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
                                <th>Image</th>
                                <th>Parts No.</th>
                                <th>Nomenclature</th>
                                <th>QTY</th>
                                <th>Add</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>...</td>
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
                            <tr data-toggle="modal" data-target="#myModal{{$item['id']}}">
                                <td><img src="{{ $item["image_url"] }}" alt="Part Image" width="200"></td>
                                <td>{{$item['requestedPartNo']}}</td>
                                <td colspan="3">{{$item['requestedNomenclature']}}</td>


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

    @foreach ($parts as $item)
    <div class="modal fade" id="myModal{{$item['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$item['id']}}">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel{{$item['id']}}">{{$item['requestedNomenclature']}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <img style="max-width: 100%; height: auto; max-height: 300px;" src="{{ $item["image_url"] }}" alt="image">
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>NSN:</strong> {{$item['nsn']}}</p>
                                        <p><strong>Part No:</strong> {{$item['requestedPartNo']}}</p>
                                        <p><strong>Nomenclature:</strong> {{$item['requestedNomenclature']}}</p>
                                        <!-- Add more details as needed -->
                                        <p> <strong>Quantity:</strong><input type="qty" class="form-control" id="qty" wire:model.defer="qty" name="qty" placeholder="Insert Quantity...">
                                        </p>
                                        <button type="button" wire:click="vehicleListDynamic({{$item['id']}})" class="btn btn1 rounded btn-success" title="{{__('Add To List')}}">
                                            <span wire:loading.remove wire:target="vehicleListDynamic">
                                                <i class="fa-solid fa-plus fa-bounce"> Add</i>
                                            </span>
                                            <span wire:loading wire:target="vehicleListDynamic">{{__('Adding...')}}</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Add another row for additional details if necessary -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @push('js')
    <script>
        $(document).ready(function() {
            $('tr[data-toggle="modal"]').click(function() {
                var targetModal = $(this).data('target');
                $(targetModal).modal('show');
            });
            $('tr[data-toggle="modal"]').click(function() {
                var targetModal = $(this).data('target');
                $(targetModal).modal('show');
            });

            // Add a click event listener to the "Add To List" button
            $('.btn1').click(function() {
                // Find the closest modal to the clicked button and hide it
                $(this).closest('.modal').modal('hide');
            });
        });
    </script>
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